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

        $order         = $request->getPost('order');
        $orderColumnIdx = $order[0]['column'] ?? 4; // default: position
        $orderDir       = $order[0]['dir'] ?? 'asc';

        $columns = [
            0 => 'id',         // index virtual
            1 => 'image',      // gambar
            2 => 'title',      // judul
            3 => 'status',     // status
            4 => 'position',   // urutan
            5 => 'updated_at', // diperbarui
        ];
        $orderColumn = $columns[$orderColumnIdx] ?? 'position';

        $builder = $this->bannerModel->builder();
        $builder->where('deleted_at', null);

        $recordsTotal = $builder->countAllResults(false);

        if ($search) {
            $builder->groupStart()
                ->like('title', $search)
                ->orLike('subtitle', $search)
                ->groupEnd();
        }

        $recordsFiltered = $builder->countAllResults(false);

        $builder->orderBy($orderColumn, $orderDir)
            ->orderBy('updated_at', 'desc')
            ->limit($length, $start);

        $data = $builder->get()->getResultArray();

        return $this->response->setJSON([
            'draw'            => $draw,
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
        ]);
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
