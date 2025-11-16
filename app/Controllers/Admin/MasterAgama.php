<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MasterAgamaModel;

class MasterAgama extends BaseController
{
    protected $model;
    protected $validation;

    public function __construct()
    {
        $this->model      = new MasterAgamaModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        return view('admin/master_agama/index', [
            'pageTitle'  => 'Master Agama',
            'activeMenu' => 'master_agama',
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

        $columns = [
            0 => 'id',
            1 => 'nama_agama',
            2 => 'kode_agama',
            3 => 'urut',
            4 => 'is_active',
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
                ->like('nama_agama', $search)
                ->orLike('kode_agama', $search)
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
            'nama_agama' => [
                'label' => 'Nama agama',
                'rules' => 'required|min_length[2]|max_length[100]',
            ],
            'kode_agama' => [
                'label' => 'Kode agama',
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
            'nama_agama' => $this->request->getPost('nama_agama'),
            'kode_agama' => $this->request->getPost('kode_agama') ?: null,
            'urut'       => $this->request->getPost('urut') !== '' ? (int) $this->request->getPost('urut') : 0,
            'is_active'  => (int) $this->request->getPost('is_active'),
        ];

        if ($id) {
            $this->model->update($id, $data);
            $msg = 'Data agama berhasil diperbarui.';
        } else {
            $this->model->insert($data);
            $msg = 'Data agama berhasil ditambahkan.';
        }

        return redirect()->to('admin/master-agama')
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
            'message'  => 'Data agama berhasil dihapus',
            'newToken' => csrf_hash(),
        ]);
    }
}
