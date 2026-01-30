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
        // builder dengan join (alias rt hanya sekali!)
        $builder = $this->db->table('rt rt');
        $builder->select('rt.id, rt.id_dusun, rt.no_rt, rt.is_active, d.nama_dusun, d.kode_dusun');
        $builder->join('dusun d', 'd.id = rt.id_dusun', 'left');
        $builder->where('rt.deleted_at', null);

        return $this->processDataTable(
            $builder,
            [
                0 => 'rt.id',
                1 => 'd.nama_dusun',
                2 => 'rt.no_rt',
                3 => 'rt.is_active',
            ],
            ['rt.no_rt', 'd.nama_dusun', 'd.kode_dusun'],
            function ($row) {
                // Format RT
                $noRt = $row['no_rt'] ?? '-';
                
                // Format Dusun + Kode
                $namaDusun = $row['nama_dusun'] ?? '-';
                if (!empty($row['kode_dusun'])) {
                    $namaDusun .= ' <span class="text-[11px] text-slate-400">(' . esc($row['kode_dusun']) . ')</span>';
                }

                // Status Badge
                $status = ((int)$row['is_active'] === 1)
                    ? '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-900/40 dark:text-emerald-200 dark:border-emerald-700">Aktif</span>'
                    : '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-rose-50 text-rose-700 border border-rose-200 dark:bg-rose-900/40 dark:text-rose-200 dark:border-rose-700">Nonaktif</span>';

                // Action Buttons (Manual Edit + Helper Delete)
                $btnEdit = '<button type="button" class="btnEdit inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-sky-200 bg-sky-50 text-[11px] font-medium text-sky-700 hover:bg-sky-100 focus:outline-none focus:ring-1 focus:ring-sky-400/70 dark:border-sky-500/40 dark:bg-sky-500/10 dark:text-sky-200 dark:hover:bg-sky-500/20" 
                    data-id="' . $row['id'] . '" 
                    data-id_dusun="' . $row['id_dusun'] . '" 
                    data-no_rt="' . $row['no_rt'] . '" 
                    data-active="' . $row['is_active'] . '">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687 1.688a1.875 1.875 0 0 1 0 2.652L8.21 19.167A4.5 4.5 0 0 1 6.678 20l-2.135.534A.75.75 0 0 1 4 19.808l.534-2.135a4.5 4.5 0 0 1 1.334-2.531l10.338-10.338a1.875 1.875 0 0 1 2.652 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 4.5 19.5 7.5" /></svg>
                    <span>Edit</span>
                </button>';

                $btnDelete = btn_delete($row['id']);

                $action = '<div class="flex items-center gap-1.5">' . $btnEdit . $btnDelete . '</div>';

                return [
                    'id'         => $row['id'],
                    'nama_dusun' => $namaDusun,
                    'no_rt'      => $noRt,
                    'is_active'  => $status,
                    'action'     => $action,
                ];
            },
            ['rt.no_rt' => 'asc'],
            function ($builder) {
                $request = \Config\Services::request();
                $filterStatus = $request->getPost('filter_status');
                if ($filterStatus !== null && $filterStatus !== '') {
                    $builder->where('rt.is_active', (int)$filterStatus);
                }
            }
        );
    }


    /**
     * Insert / Update
     */
    public function save()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'id_dusun' => [
                'label' => 'Dusun',
                'rules' => 'required|integer',
            ],
            'no_rt' => [
                'label' => 'Nomor RT',
                'rules' => 'required|integer',
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
            'id_dusun' => (int) $this->request->getPost('id_dusun'),
            'no_rt'    => $this->request->getPost('no_rt'),
            'is_active' => (int) $this->request->getPost('is_active'),
        ];

        if ($id) {
            $this->model->update($id, $data);
            $msg = 'Data RT berhasil diperbarui.';
        } else {
            $this->model->insert($data);
            $msg = 'Data RT berhasil ditambahkan.';
        }

        return redirect()->to('admin/master-rt')
            ->with('success', $msg);
    }

    /**
     * Delete (AJAX)
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
            'message'  => 'Data RT berhasil dihapus',
            'newToken' => csrf_hash(),
        ]);
    }
}
