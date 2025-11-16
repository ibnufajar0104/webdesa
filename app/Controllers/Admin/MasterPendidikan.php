<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MasterPendidikanModel;

class MasterPendidikan extends BaseController
{
    protected $model;
    protected $validation;

    public function __construct()
    {
        $this->model      = new MasterPendidikanModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        return view('admin/master_pendidikan/index', [
            'pageTitle'  => 'Master Pendidikan',
            'activeMenu' => 'master_pendidikan',
        ]);
    }

    /**
     * DataTables server-side
     */
    public function datatable()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $request = $this->request;

        $draw   = (int) $request->getPost('draw');
        $start  = (int) $request->getPost('start');
        $length = (int) $request->getPost('length');
        $search = $request->getPost('search')['value'] ?? '';

        $order = $request->getPost('order') ?? [];
        if (! empty($order[0]['column'])) {
            $orderColumnIdx = (int) $order[0]['column'];
            $orderDir       = ($order[0]['dir'] === 'desc') ? 'desc' : 'asc';
        } else {
            $orderColumnIdx = 3; // default urut
            $orderDir       = 'asc';
        }

        // mapping index kolom DataTables -> field database
        $columns = [
            0 => 'id',              // index #
            1 => 'nama_pendidikan', // Nama
            2 => 'kode_pendidikan', // Kode
            3 => 'urut',            // Urut
            4 => 'is_active',       // Status
        ];
        $orderColumn = $columns[$orderColumnIdx] ?? 'urut';

        // total tanpa filter/search
        $recordsTotal = $this->model
            ->where('deleted_at', null)
            ->countAllResults();

        // base builder
        $builder = $this->model->builder();
        $builder->where('deleted_at', null);

        // filter status (opsional)
        $filterStatus = $request->getPost('filter_status');
        if ($filterStatus !== null && $filterStatus !== '') {
            $builder->where('is_active', (int) $filterStatus);
        }

        // search global
        if ($search !== '') {
            $builder->groupStart()
                ->like('nama_pendidikan', $search)
                ->orLike('kode_pendidikan', $search)
                ->groupEnd();
        }

        // hitung filtered
        $recordsFiltered = $builder->countAllResults(false);

        // order & limit
        $builder->orderBy($orderColumn, $orderDir)
            ->limit($length, $start);

        $data = $builder->get()->getResultArray();

        return $this->response->setJSON([
            'draw'            => $draw,
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
        ]);
    }

    /**
     * Insert / Update dari modal
     */
    public function save()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'nama_pendidikan' => [
                'label' => 'Nama pendidikan',
                'rules' => 'required|min_length[2]|max_length[100]',
            ],
            'kode_pendidikan' => [
                'label' => 'Kode pendidikan',
                'rules' => 'permit_empty|max_length[20]',
            ],
            'urut' => [
                'label' => 'Urut',
                'rules' => 'permit_empty|integer',
            ],
            'is_active' => [
                'label' => 'Status aktif',
                'rules' => 'required|in_list[0,1]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors())
                ->with('error', 'Data gagal disimpan.');
        }

        $data = [
            'nama_pendidikan' => $this->request->getPost('nama_pendidikan'),
            'kode_pendidikan' => $this->request->getPost('kode_pendidikan') ?: null,
            'urut'            => $this->request->getPost('urut') !== '' ? (int) $this->request->getPost('urut') : 0,
            'is_active'       => (int) $this->request->getPost('is_active'),
        ];

        if ($id) {
            $this->model->update($id, $data);
            $msg = 'Data pendidikan berhasil diperbarui.';
        } else {
            $this->model->insert($data);
            $msg = 'Data pendidikan berhasil ditambahkan.';
        }

        return redirect()->to('admin/master-pendidikan')
            ->with('success', $msg);
    }

    /**
     * Hapus (AJAX + JSON) untuk SweetAlert
     */
    public function delete()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $id = $this->request->getPost('id');

        if (! $id) {
            return $this->response->setJSON([
                'status'   => false,
                'message'  => 'ID tidak valid',
                'newToken' => csrf_hash(),
            ]);
        }

        $row = $this->model->find($id);
        if (! $row) {
            return $this->response->setJSON([
                'status'   => false,
                'message'  => 'Data tidak ditemukan',
                'newToken' => csrf_hash(),
            ]);
        }

        $this->model->delete($id);

        return $this->response->setJSON([
            'status'   => true,
            'message'  => 'Data pendidikan berhasil dihapus',
            'newToken' => csrf_hash(),
        ]);
    }
}
