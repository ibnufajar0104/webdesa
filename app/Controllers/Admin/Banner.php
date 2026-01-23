<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BannerModel;

class Banner extends BaseController
{
    protected $bannerModel;
    protected $validation;

    public function __construct()
    {
        $this->bannerModel = new BannerModel();
        $this->validation  = \Config\Services::validation();
    }

    public function index()
    {
        return view('admin/banner/index', [
            'pageTitle'  => 'Banner',
            'activeMenu' => 'banner',
        ]);
    }

    /**
     * DataTables server-side
     */
    /**
     * DataTables server-side
     */
    public function datatable()
    {
        return $this->processDataTable(
            $this->bannerModel->builder()->where('deleted_at', null),
            [
                0 => 'id',
                1 => 'image',
                2 => 'title',
                3 => 'status',
                4 => 'position',
                5 => 'updated_at',
            ],
            ['title', 'subtitle'],
            function ($row) {
                // Image
                $imgHtml = '<div class="w-20 h-10 rounded-md bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-[10px] text-slate-400">No Img</div>';
                if (!empty($row['image'])) {
                    $url = base_url('file/banner/' . $row['image']);
                    $imgHtml = '<div class="w-24 h-12 rounded-md overflow-hidden bg-slate-100 dark:bg-slate-800">
                                    <img src="' . $url . '" alt="banner" class="w-full h-full object-cover" loading="lazy">
                                </div>';
                }

                // Action
                $editUrl = base_url('admin/banner/edit/' . $row['id']);
                $action = '<div class="flex items-center gap-1.5">' .
                    btn_edit($editUrl) .
                    btn_delete($row['id']) .
                    '</div>';

                return [
                    'id'       => $row['id'],
                    'image'    => $imgHtml,
                    'title'    => esc($row['title']),
                    'status'   => status_badge($row['status']),
                    'position' => $row['position'] ?: '-',
                    'action'   => $action,
                ];
            },
            ['updated_at' => 'desc']
        );
    }

    public function create()
    {
        return view('admin/banner/form', [
            'pageTitle'  => 'Tambah Banner',
            'activeMenu' => 'banner',
            'mode'       => 'create',
            'banner'     => [
                'id'          => '',
                'title'       => old('title'),
                'subtitle'    => old('subtitle'),
                'description' => old('description'),
                'button_text' => old('button_text'),
                'button_url'  => old('button_url'),
                'position'    => old('position') ?? 1,
                'status'      => old('status') ?? 'active',
                'image'       => old('image'),
            ],
            'errors' => session('errors') ?? [],
        ]);
    }

    public function edit($id)
    {
        $banner = $this->bannerModel->find($id);

        if (!$banner) {
            return redirect()->to('admin/banner')
                ->with('error', 'Data tidak ditemukan');
        }

        return view('admin/banner/form', [
            'pageTitle'  => 'Edit Banner',
            'activeMenu' => 'banner',
            'mode'       => 'edit',
            'banner'     => [
                'id'          => $banner['id'],
                'title'       => old('title', $banner['title']),
                'subtitle'    => old('subtitle', $banner['subtitle']),
                'description' => old('description', $banner['description']),
                'button_text' => old('button_text', $banner['button_text']),
                'button_url'  => old('button_url', $banner['button_url']),
                'position'    => old('position', $banner['position']),
                'status'      => old('status', $banner['status']),
                'image'       => old('image', $banner['image']),
            ],
            'errors' => session('errors') ?? [],
        ]);
    }

    public function save()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'title'    => 'required|min_length[3]',
            'position' => 'permit_empty|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        $title       = $this->request->getPost('title');
        $subtitle    = $this->request->getPost('subtitle');
        $description = $this->request->getPost('description');
        $buttonText  = $this->request->getPost('button_text');
        $buttonUrl   = $this->request->getPost('button_url');
        $position    = $this->request->getPost('position') ?: 1;
        $status      = $this->request->getPost('status') ?? 'active';

        // handle image upload
        $imageFile = $this->request->getFile('image');
        $imageName = null;

        if ($id) {
            $row = $this->bannerModel->find($id);
            if ($row && !empty($row['image'])) {
                $imageName = $row['image'];
            }
        }

        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $mime    = $imageFile->getMimeType();
            $allowed = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/webp'];

            if (!in_array($mime, $allowed, true)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['image' => 'Format gambar tidak didukung']);
            }

            $uploadPath = WRITEPATH . 'uploads/banner/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // hapus file lama
            if (!empty($imageName) && is_file($uploadPath . $imageName)) {
                @unlink($uploadPath . $imageName);
            }

            $newName  = $imageFile->getRandomName();
            $imageFile->move($uploadPath, $newName);
            $imageName = $newName;
        }

        $data = [
            'title'       => $title,
            'subtitle'    => $subtitle,
            'description' => $description,
            'button_text' => $buttonText,
            'button_url'  => $buttonUrl,
            'position'    => $position,
            'status'      => $status,
            'image'       => $imageName,
        ];

        if ($id) {
            $this->bannerModel->update($id, $data);
            $msg = 'Banner berhasil diperbarui';
        } else {
            $this->bannerModel->insert($data);
            $msg = 'Banner berhasil ditambahkan';
        }

        return redirect()->to('admin/banner')
            ->with('success', $msg);
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

        $banner = $this->bannerModel->find($id);
        if (!$banner) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }

        $this->bannerModel->delete($id);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Banner berhasil dihapus',
        ]);
    }
}
