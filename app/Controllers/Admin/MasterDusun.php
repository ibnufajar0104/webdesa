<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DusunModel;
use App\Models\MasterJabatanModel;

class MasterDusun extends BaseController
{
    protected $model;
    protected $validation;

    public function __construct()
    {
        $this->model      = new DusunModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        return view('admin/master_dusun/index', [
            'pageTitle'  => 'Master Dusun',
            'activeMenu' => 'master_dusun',
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
            1 => 'nama_dusun',
            2 => 'kode_dusun',
            3 => 'is_active',
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
                ->like('nama_jabatan', $search)
                ->orLike('kode_jabatan', $search)
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
     * Insert / Update dari modal (MASTER DUSUN)
     */
    public function save()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'nama_dusun' => [
                'label' => 'Nama dusun',
                'rules' => 'required|min_length[2]|max_length[150]',
            ],
            'kode_dusun' => [
                'label' => 'Kode dusun',
                'rules' => 'permit_empty|max_length[30]',
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
            'nama_dusun' => $this->request->getPost('nama_dusun'),
            'kode_dusun' => $this->request->getPost('kode_dusun') ?: null,
            'is_active'  => (int) $this->request->getPost('is_active'),
        ];

        if ($id) {
            $this->model->update($id, $data);
            $msg = 'Data dusun berhasil diperbarui.';
        } else {
            $this->model->insert($data);
            $msg = 'Data dusun berhasil ditambahkan.';
        }

        return redirect()->to('admin/master-dusun')
            ->with('success', $msg);
    }

    /**
     * Hapus (AJAX + JSON) untuk SweetAlert (MASTER DUSUN)
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
            'message'  => 'Data dusun berhasil dihapus',
            'newToken' => csrf_hash(),
        ]);
    }
}
