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
        $row = $this->model->orderBy('id', 'ASC')->first();

        return view('admin/jam_pelayanan/index', [
            'pageTitle'  => 'Jam Pelayanan',
            'activeMenu' => 'jam_pelayanan',
            'data'       => $row,
        ]);
    }

    public function save()
    {
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

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors())
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
            $this->model->update($id, $data);
            $msg = 'Jam pelayanan berhasil diperbarui.';
        } else {
            $this->model->insert($data);
            $msg = 'Jam pelayanan berhasil disimpan.';
        }

        return redirect()->to('admin/jam-pelayanan')->with('success', $msg);
    }
}
