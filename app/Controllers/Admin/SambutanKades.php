<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SambutanKadesModel;

class SambutanKades extends BaseController
{
    protected $model;
    protected $validation;

    public function __construct()
    {
        $this->model      = new SambutanKadesModel();
        $this->validation = \Config\Services::validation();
    }

    /**
     * Single entry: tampilkan form saja (tanpa tabel).
     */
    public function index()
    {
        // Ambil satu-satunya data sambutan (kalau ada)
        $row = $this->model->orderBy('id', 'ASC')->first();

        return view('admin/sambutan_kades/index', [
            'pageTitle'  => 'Sambutan Kepala Desa',
            'activeMenu' => 'sambutan_kades',
            'data'       => $row,
        ]);
    }

    /**
     * Simpan / update single entry + upload foto kades.
     */
    public function save()
    {
        $id   = $this->request->getPost('id');
        $file = $this->request->getFile('foto_kades');

        $rules = [
            'judul' => [
                'label' => 'Judul sambutan',
                'rules' => 'required|min_length[3]|max_length[150]',
            ],
            'isi' => [
                'label' => 'Isi sambutan',
                'rules' => 'required|min_length[10]',
            ],
            'is_active' => [
                'label' => 'Status tampil',
                'rules' => 'required|in_list[0,1]',
            ],
            'foto_kades' => [
                'label' => 'Foto Kepala Desa',
                'rules' => 'permit_empty|is_image[foto_kades]|max_size[foto_kades,3072]|mime_in[foto_kades,image/jpg,image/jpeg,image/png,image/webp]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors())
                ->with('error', 'Sambutan gagal disimpan. Periksa kembali form Anda.');
        }

        // Ambil data lama (kalau ada) untuk keperluan replace foto
        $existing = $id ? $this->model->find($id) : null;

        $fotoName   = $existing['foto_kades'] ?? null;
        $uploadPath = WRITEPATH . 'uploads/pages';

        // Pastikan folder ada
        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Jika ada upload foto baru
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $ext      = $file->getExtension();
            $newName  = 'kades_' . time() . '.' . $ext;
            $filePath = rtrim($uploadPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $newName;

            // Pindahkan file
            $file->move($uploadPath, $newName);

            // Hapus foto lama jika ada dan berbeda
            if (! empty($fotoName)) {
                $oldPath = rtrim($uploadPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fotoName;
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $fotoName = $newName;
        }

        $data = [
            'judul'      => $this->request->getPost('judul'),
            'isi'        => $this->request->getPost('isi'),
            'foto_kades' => $fotoName,
            'is_active'  => (int) $this->request->getPost('is_active'),
        ];

        if ($id) {
            $this->model->update($id, $data);
            $msg = 'Sambutan berhasil diperbarui.';
        } else {
            $this->model->insert($data);
            $msg = 'Sambutan berhasil disimpan.';
        }

        return redirect()->to('admin/sambutan-kades')
            ->with('success', $msg);
    }
}
