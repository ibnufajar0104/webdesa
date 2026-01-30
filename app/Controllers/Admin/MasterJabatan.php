<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MasterJabatanModel;

class MasterJabatan extends BaseController
{
    protected $model;
    protected $validation;

    public function __construct()
    {
        $this->model      = new MasterJabatanModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        return view('admin/master_jabatan/index', [
            'pageTitle'  => 'Master Jabatan',
            'activeMenu' => 'master_jabatan',
        ]);
    }

    /**
     * DataTables server-side
     */
    public function datatable()
    {
        return $this->processDataTable(
            $this->model->builder()->where('deleted_at', null),
            [
                0 => 'id',
                1 => 'nama_jabatan',
                2 => 'kode_jabatan',
                3 => 'urut',
                4 => 'is_active',
            ],
            ['nama_jabatan', 'kode_jabatan'], // Searchable columns
            function ($row) {
                // Formatting data
                $kode = $row['kode_jabatan'] ?: '-';
                $urut = $row['urut'] ?? 0;
                
                // Status badge
                $status = ((int)$row['is_active'] === 1)
                    ? '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-900/40 dark:text-emerald-200 dark:border-emerald-700">Aktif</span>'
                    : '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-rose-50 text-rose-700 border border-rose-200 dark:bg-rose-900/40 dark:text-rose-200 dark:border-rose-700">Nonaktif</span>';

                // Action Buttons
                $btnEdit = '<button type="button" class="btnEdit inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-sky-200 bg-sky-50 text-[11px] font-medium text-sky-700 hover:bg-sky-100 focus:outline-none focus:ring-1 focus:ring-sky-400/70 dark:border-sky-500/40 dark:bg-sky-500/10 dark:text-sky-200 dark:hover:bg-sky-500/20" 
                    data-id="' . $row['id'] . '" 
                    data-nama="' . esc($row['nama_jabatan']) . '" 
                    data-kode="' . esc($row['kode_jabatan']) . '" 
                    data-urut="' . $row['urut'] . '" 
                    data-active="' . $row['is_active'] . '">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687 1.688a1.875 1.875 0 0 1 0 2.652L8.21 19.167A4.5 4.5 0 0 1 6.678 20l-2.135.534A.75.75 0 0 1 4 19.808l.534-2.135a4.5 4.5 0 0 1 1.334-2.531l10.338-10.338a1.875 1.875 0 0 1 2.652 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 4.5 19.5 7.5" /></svg>
                    <span>Edit</span>
                </button>';

                $btnDelete = btn_delete($row['id']); // Helper standard delete button

                $action = '<div class="flex items-center gap-1.5">' . $btnEdit . $btnDelete . '</div>';

                return [
                    'id'           => $row['id'],
                    'nama_jabatan' => esc($row['nama_jabatan']),
                    'kode_jabatan' => $kode,
                    'urut'         => $urut,
                    'is_active'    => $status,
                    'action'       => $action,
                ];
            },
            ['urut' => 'asc'], // Default Order
            function ($builder) {
                // Additional filter logic if needed (e.g. from POST)
                $request = \Config\Services::request(); // or $this->request
                $filterStatus = $request->getPost('filter_status');
                if ($filterStatus !== null && $filterStatus !== '') {
                    $builder->where('is_active', (int)$filterStatus);
                }
            }
        );
    }

    /**
     * Insert / Update dari modal
     */
    public function save()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'nama_jabatan' => [
                'label' => 'Nama jabatan',
                'rules' => 'required|min_length[2]|max_length[150]',
            ],
            'kode_jabatan' => [
                'label' => 'Kode jabatan',
                'rules' => 'permit_empty|max_length[30]',
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
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
            'kode_jabatan' => $this->request->getPost('kode_jabatan') ?: null,
            'urut'         => $this->request->getPost('urut') !== '' ? (int) $this->request->getPost('urut') : 0,
            'is_active'    => (int) $this->request->getPost('is_active'),
        ];

        if ($id) {
            $this->model->update($id, $data);
            $msg = 'Data jabatan berhasil diperbarui.';
        } else {
            $this->model->insert($data);
            $msg = 'Data jabatan berhasil ditambahkan.';
        }

        return redirect()->to('admin/master-jabatan')
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
            'message'  => 'Data jabatan berhasil dihapus',
            'newToken' => csrf_hash(),
        ]);
    }
}
