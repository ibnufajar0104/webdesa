<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KontakModel;

class Kontak extends BaseController
{
    protected $model;
    protected $validation;

    public function __construct()
    {
        $this->model      = new KontakModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $row = $this->model->orderBy('id', 'ASC')->first();

        return view('admin/kontak/index', [
            'pageTitle'  => 'Kontak Desa',
            'activeMenu' => 'kontak',
            'data'       => $row,
        ]);
    }

    public function save()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required|min_length[10]',
            ],
            'telepon' => [
                'label' => 'Telepon',
                'rules' => 'permit_empty|max_length[50]',
            ],
            'whatsapp' => [
                'label' => 'WhatsApp',
                'rules' => 'permit_empty|max_length[50]',
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'permit_empty|valid_email|max_length[120]',
            ],
            'website' => [
                'label' => 'Website',
                'rules' => 'permit_empty|max_length[150]',
            ],
            'link_maps' => [
                'label' => 'Link Maps',
                'rules' => 'permit_empty',
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
                ->with('error', 'Data kontak gagal disimpan.');
        }

        $data = [
            'alamat'    => $this->request->getPost('alamat'),
            'telepon'   => $this->request->getPost('telepon'),
            'whatsapp'  => $this->request->getPost('whatsapp'),
            'email'     => $this->request->getPost('email'),
            'website'   => $this->request->getPost('website'),
            'link_maps' => $this->request->getPost('link_maps'),
            'is_active' => (int) $this->request->getPost('is_active'),
        ];

        if ($id) {
            $this->model->update($id, $data);
            $msg = 'Data kontak berhasil diperbarui.';
        } else {
            $this->model->insert($data);
            $msg = 'Data kontak berhasil disimpan.';
        }

        return redirect()->to('admin/kontak')->with('success', $msg);
    }
}
