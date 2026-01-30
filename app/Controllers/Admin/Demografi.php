<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DemografiModel;

class Demografi extends BaseController
{
    protected $demografiModel;
    protected $validation;

    public function __construct()
    {
        $this->demografiModel = new DemografiModel();
        $this->validation     = \Config\Services::validation();
    }

    public function index()
    {
        // Ambil data pertama, jika tidak ada kirim null/array kosong
        $data = $this->demografiModel->first();

        return view('admin/demografi/index', [
            'pageTitle'  => 'Demografi Desa',
            'activeMenu' => 'demografi',
            'data'       => $data
        ]);
    }

    public function save()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'jarak_ke_kabupaten' => [
                'label' => 'Jarak ke Kabupaten',
                'rules' => 'required|decimal'
            ],
            'luas_wilayah' => [
                'label' => 'Luas Wilayah',
                'rules' => 'required|decimal'
            ],
            'kepadatan' => [
                'label' => 'Kepadatan Penduduk',
                'rules' => 'required|decimal'
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        $saveData = [
            'jarak_ke_kabupaten' => $this->request->getPost('jarak_ke_kabupaten'),
            'luas_wilayah'       => $this->request->getPost('luas_wilayah'),
            'kepadatan'          => $this->request->getPost('kepadatan'),
        ];

        if ($id) {
            $this->demografiModel->update($id, $saveData);
            $msg = 'Data demografi berhasil diperbarui.';
        } else {
            // Cek lagi apakah benar-benar kosong (cegah duplikasi jika button diklik 2x cepat di kondisi kosong)
            $exist = $this->demografiModel->first();
            if ($exist) {
                $this->demografiModel->update($exist['id'], $saveData);
            } else {
                $this->demografiModel->insert($saveData);
            }
            $msg = 'Data demografi berhasil disimpan.';
        }

        return redirect()->to('admin/demografi')->with('success', $msg);
    }
}
