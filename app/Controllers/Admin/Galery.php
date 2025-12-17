<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GaleryModel;

class Galery extends BaseController
{
    protected GaleryModel $galeryModel;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->galeryModel  = new GaleryModel();
        $this->db           = \Config\Database::connect();
        $this->validation   = \Config\Services::validation();
    }

    public function index()
    {
        return view('admin/galery/index', [
            'pageTitle'  => 'Galery',
            'activeMenu' => 'galery',
        ]);
    }

    public function datatable()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $req    = $this->request;
        $draw   = (int) $req->getPost('draw');
        $start  = (int) $req->getPost('start');
        $length = (int) $req->getPost('length');
        $search = $req->getPost('search')['value'] ?? '';

        $order = $req->getPost('order') ?? [];
        if (!empty($order[0]['column'])) {
            $orderColumnIdx = (int) $order[0]['column'];
            $orderDir       = ($order[0]['dir'] === 'desc') ? 'desc' : 'asc';
        } else {
            $orderColumnIdx = 5; // default urut
            $orderDir       = 'asc';
        }

        $columns = [
            0 => 'id',
            1 => 'file_path',
            2 => 'judul',
            3 => 'caption',
            4 => 'is_active',
            5 => 'urut',
            6 => 'created_at',
        ];
        $orderColumn = $columns[$orderColumnIdx] ?? 'urut';

        $filterStatus = $req->getPost('filter_status');

        $builder = $this->db->table('galery');
        $builder->select('galery.*');
        $builder->where('galery.deleted_at', null);

        // total soft delete only
        $recordsTotal = $this->galeryModel
            ->where('deleted_at', null)
            ->countAllResults();

        if ($filterStatus !== null && $filterStatus !== '') {
            $builder->where('galery.is_active', (int) $filterStatus);
        }

        if ($search !== '') {
            $builder->groupStart()
                ->like('galery.judul', $search)
                ->orLike('galery.caption', $search)
                ->orLike('galery.file_path', $search)
                ->groupEnd();
        }

        $recordsFiltered = $builder->countAllResults(false);

        $builder->orderBy('galery.' . $orderColumn, $orderDir)
            ->limit($length, $start);

        $data = $builder->get()->getResultArray();

        return $this->response->setJSON([
            'draw'            => $draw,
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
            'newToken'        => csrf_hash(),
        ]);
    }

    public function create()
    {
        $row = [
            'id'        => '',
            'judul'     => old('judul'),
            'caption'   => old('caption'),
            'urut'      => old('urut') ?? 0,
            'is_active' => old('is_active') ?? 1,
            'file_path' => null,
        ];

        return view('admin/galery/form', [
            'pageTitle'  => 'Tambah Galery',
            'activeMenu' => 'galery',
            'mode'       => 'create',
            'row'        => $row,
            'errors'     => session('errors') ?? [],
        ]);
    }

    public function edit($id)
    {
        $row = $this->galeryModel->find($id);

        if (!$row) {
            return redirect()->to('admin/galery')->with('error', 'Data galery tidak ditemukan');
        }

        foreach ($row as $k => $v) {
            $row[$k] = old($k, $v);
        }

        return view('admin/galery/form', [
            'pageTitle'  => 'Edit Galery',
            'activeMenu' => 'galery',
            'mode'       => 'edit',
            'row'        => $row,
            'errors'     => session('errors') ?? [],
        ]);
    }

    public function save()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'judul'     => 'permit_empty|max_length[200]',
            'caption'   => 'permit_empty',
            'urut'      => 'required|integer',
            'is_active' => 'required|in_list[0,1]',
        ];

        // create wajib upload file
        if (!$id) {
            $rules['foto_file'] = [
                'label' => 'Foto',
                'rules' => 'uploaded[foto_file]|max_size[foto_file,5120]',
            ];
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $data = [
            'judul'     => $this->request->getPost('judul'),
            'caption'   => $this->request->getPost('caption'),
            'urut'      => (int) $this->request->getPost('urut'),
            'is_active' => (int) $this->request->getPost('is_active'),
        ];

        $file = $this->request->getFile('foto_file');

        // kalau upload baru
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $mime    = $file->getMimeType();
            $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

            if (!in_array($mime, $allowed, true)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['File harus berupa JPG, PNG, atau WEBP']);
            }

            $uploadPath = WRITEPATH . 'uploads/galery/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);

            $data['file_path'] = 'galery/' . $newName;
            $data['mime']      = $mime;
            $data['ukuran']    = $file->getSize();
        }

        // update: jika tidak upload baru, pertahankan file lama
        if ($id) {
            if (empty($data['file_path'])) {
                $data['file_path'] = $this->request->getPost('file_path_old') ?: null;
            }

            $this->galeryModel->update($id, $data);
            return redirect()->to('admin/galery')->with('success', 'Galery berhasil diperbarui');
        }

        $this->galeryModel->insert($data);
        return redirect()->to('admin/galery')->with('success', 'Galery berhasil ditambahkan');
    }

    public function delete()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $id = $this->request->getPost('id');

        if (!$id) {
            return $this->response->setJSON([
                'status'   => false,
                'message'  => 'ID tidak valid',
                'newToken' => csrf_hash(),
            ]);
        }

        $row = $this->galeryModel->find($id);
        if (!$row) {
            return $this->response->setJSON([
                'status'   => false,
                'message'  => 'Data galery tidak ditemukan',
                'newToken' => csrf_hash(),
            ]);
        }

        $this->galeryModel->delete($id);

        return $this->response->setJSON([
            'status'   => true,
            'message'  => 'Data galery berhasil dihapus',
            'newToken' => csrf_hash(),
        ]);
    }
}
