<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MasterRtModel;
use App\Models\DusunModel;

class MasterRt extends BaseController
{
    protected $model;
    protected $validation;
    protected $dusunModel;

    public function __construct()
    {
        $this->model      = new MasterRtModel();
        $this->dusunModel = new DusunModel();
        $this->validation = \Config\Services::validation();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('admin/master_rt/index', [
            'pageTitle'  => 'Master RT',
            'activeMenu' => 'master_rt',
        ]);
    }

    /**
     * Options dusun untuk select (AJAX)
     */
    public function dusunOptions()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $rows = $this->dusunModel
            ->select('id, nama_dusun, kode_dusun')
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->orderBy('nama_dusun', 'asc')
            ->findAll();

        return $this->response->setJSON([
            'status'   => true,
            'data'     => $rows,
            'newToken' => csrf_hash(),
        ]);
    }

    /**
     * DataTables server-side (JOIN dusun)
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
        if (isset($order[0]['column'])) {
            $orderColumnIdx = (int) $order[0]['column'];
            $orderDir       = (($order[0]['dir'] ?? 'asc') === 'desc') ? 'desc' : 'asc';
        } else {
            $orderColumnIdx = 2;
            $orderDir       = 'asc';
        }

        // mapping kolom datatable (sesuai urutan kolom yang tampil)
        $columns = [
            0 => 'rt.id',
            1 => 'd.nama_dusun',
            2 => 'rt.no_rt',
            3 => 'rt.is_active',
        ];
        $orderColumn = $columns[$orderColumnIdx] ?? 'rt.no_rt';

        // total tanpa filter/search (soft delete)
        $recordsTotal = $this->model
            ->where('deleted_at', null)
            ->countAllResults();

        // builder dengan join (alias rt hanya sekali!)
        $builder = $this->db->table('rt rt');
        $builder->select('rt.id, rt.id_dusun, rt.no_rt, rt.is_active, d.nama_dusun, d.kode_dusun');
        $builder->join('dusun d', 'd.id = rt.id_dusun', 'left');
        $builder->where('rt.deleted_at', null);

        // filter status RT
        $filterStatus = $request->getPost('filter_status');
        if ($filterStatus !== null && $filterStatus !== '') {
            $builder->where('rt.is_active', (int) $filterStatus);
        }

        // search global
        if ($search !== '') {
            $builder->groupStart()
                ->like('rt.no_rt', $search)
                ->orLike('d.nama_dusun', $search)
                ->orLike('d.kode_dusun', $search)
                ->groupEnd();
        }

        // hitung filtered (pakai false supaya builder tidak di-reset)
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


    // save() & delete() tetap seperti sebelumnya
}
