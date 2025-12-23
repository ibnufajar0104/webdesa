<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JamPelayananModel;

class JamPelayanan extends BaseController
{
    protected $model;
    protected $validation;

    public function __construct()
    {
        $this->model      = new JamPelayananModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        return view('admin/jam_pelayanan/index', [
            'pageTitle'  => 'Jam Pelayanan',
            'activeMenu' => 'jam_pelayanan',
        ]);
    }

    /**
     * DataTables server-side
     */
    public function datatable()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $request = $this->request;

        $draw   = (int) $request->getPost('draw');
        $start  = (int) $request->getPost('start');
        $length = (int) $request->getPost('length');
        $search = $request->getPost('search')['value'] ?? '';

        $order  = $request->getPost('order');
        $orderColumnIdx = $order[0]['column'] ?? 5; // default updated_at
        $orderDir       = $order[0]['dir'] ?? 'desc';

        // index DT -> field db (tanpa kolom #)
        $columns = [
            0 => 'id',          // virtual
            1 => 'hari',
            2 => 'jam_mulai',
            3 => 'jam_selesai',
            4 => 'is_active',
            5 => 'updated_at',
        ];
        $orderColumn = $columns[$orderColumnIdx] ?? 'updated_at';

        $builder = $this->model->builder();

        $recordsTotal = $builder->countAllResults(false);

        if ($search) {
            $builder->groupStart()
                ->like('hari', $search)
                ->orLike('jam_mulai', $search)
                ->orLike('jam_selesai', $search)
                ->orLike('keterangan', $search)
                ->groupEnd();
        }

        $recordsFiltered = $builder->countAllResults(false);

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
     * Save (insert/update) via modal (AJAX friendly)
     */
    public function save()
    {
        // boleh AJAX / non-AJAX, tapi kita utamakan AJAX
        $id = $this->request->getPost('id');

        $rules = [
            'hari' => [
                'label' => 'Hari Pelayanan',
                'rules' => 'required|min_length[3]|max_length[150]',
            ],
            'jam_mulai' => [
                'label' => 'Jam Mulai',
                'rules' => 'permit_empty|max_length[20]',
            ],
            'jam_selesai' => [
                'label' => 'Jam Selesai',
                'rules' => 'permit_empty|max_length[20]',
            ],
            'keterangan' => [
                'label' => 'Keterangan',
                'rules' => 'permit_empty|max_length[500]',
            ],
            'is_active' => [
                'label' => 'Status',
                'rules' => 'required|in_list[0,1]',
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validation->getErrors();

            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Validasi gagal',
                    'errors'  => $errors,
                ]);
            }

            return redirect()->back()
                ->withInput()
                ->with('errors', $errors)
                ->with('error', 'Jam pelayanan gagal disimpan.');
        }

        $data = [
            'hari'        => $this->request->getPost('hari'),
            'jam_mulai'   => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai'),
            'keterangan'  => $this->request->getPost('keterangan'),
            'is_active'   => (int) $this->request->getPost('is_active'),
        ];

        if ($id) {
            $row = $this->model->find($id);
            if (!$row) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
            $this->model->update($id, $data);
            $msg = 'Jam pelayanan berhasil diperbarui.';
        } else {
            $this->model->insert($data);
            $msg = 'Jam pelayanan berhasil ditambahkan.';
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => true,
                'message' => $msg,
            ]);
        }

        return redirect()->to('admin/jam-pelayanan')->with('success', $msg);
    }

    public function delete()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $id = $this->request->getPost('id');

        if (!$id) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'ID tidak valid',
            ]);
        }

        $row = $this->model->find($id);
        if (!$row) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }

        $this->model->delete($id); // hard delete (karena useSoftDeletes=false)

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Jam pelayanan berhasil dihapus.',
        ]);
    }
}
