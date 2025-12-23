<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DokumenKategoriModel;

class KategoriDokumen extends BaseController
{
    protected $modelKategori;
    protected $validation;

    public function __construct()
    {
        $this->modelKategori = new DokumenKategoriModel();
        $this->validation    = \Config\Services::validation();
        helper(['text', 'url']);
    }

    private function generateSlug(string $nama, $ignoreId = null): string
    {
        $slug = url_title($nama, '-', true);
        if ($slug === '') {
            $slug = random_string('alnum', 8);
        }

        $original = $slug;
        $i = 1;

        while ($this->slugExists($slug, $ignoreId)) {
            $slug = $original . '-' . ($i++);
        }

        return $slug;
    }

    private function slugExists(string $slug, $ignoreId = null): bool
    {
        $builder = $this->modelKategori->where('slug', $slug);
        if ($ignoreId !== null) {
            $builder->where('id !=', $ignoreId);
        }
        return $builder->countAllResults() > 0;
    }

    public function index()
    {
        return view('admin/dokumen_kategori/index', [
            'pageTitle'  => 'Kategori Dokumen',
            'activeMenu' => 'dokumen_kategori',
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
        $orderColumnIdx = $order[0]['column'] ?? 4; // default: updated_at
        $orderDir       = $order[0]['dir'] ?? 'desc';

        // index DT -> field db
        $columns = [
            0 => 'id',         // index (virtual)
            1 => 'nama',
            2 => 'slug',
            3 => 'is_active',
            4 => 'urutan',
            5 => 'updated_at',
        ];
        $orderColumn = $columns[$orderColumnIdx] ?? 'updated_at';

        $builder = $this->modelKategori->builder();
        $builder->where('deleted_at', null);

        $recordsTotal = $builder->countAllResults(false);

        if ($search) {
            $builder->groupStart()
                ->like('nama', $search)
                ->orLike('slug', $search)
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

    public function create()
    {
        return view('admin/dokumen_kategori/form', [
            'pageTitle'  => 'Tambah Kategori Dokumen',
            'activeMenu' => 'dokumen_kategori',
            'mode'       => 'create',
            'row'        => [
                'id'        => '',
                'nama'      => old('nama'),
                'slug'      => old('slug'),
                'deskripsi' => old('deskripsi'),
                'urutan'    => old('urutan') ?? 0,
                'is_active' => old('is_active') ?? 1,
            ],
            'errors'     => session('errors') ?? [],
        ]);
    }

    public function edit($id)
    {
        $row = $this->modelKategori->find($id);

        if (!$row) {
            return redirect()->to('admin/kategori-dokumen')
                ->with('error', 'Data tidak ditemukan');
        }

        return view('admin/dokumen_kategori/form', [
            'pageTitle'  => 'Edit Kategori Dokumen',
            'activeMenu' => 'dokumen_kategori',
            'mode'       => 'edit',
            'row'        => [
                'id'        => $row['id'],
                'nama'      => old('nama', $row['nama']),
                'slug'      => old('slug', $row['slug']),
                'deskripsi' => old('deskripsi', $row['deskripsi'] ?? ''),
                'urutan'    => old('urutan', $row['urutan'] ?? 0),
                'is_active' => old('is_active', $row['is_active'] ?? 1),
            ],
            'errors'     => session('errors') ?? [],
        ]);
    }

    public function save()
    {
        $id        = $this->request->getPost('id');
        $nama      = trim((string) $this->request->getPost('nama'));
        $deskripsi = $this->request->getPost('deskripsi');
        $urutan    = (int) ($this->request->getPost('urutan') ?? 0);
        $isActive  = (int) ($this->request->getPost('is_active') ?? 1);

        $rules = [
            'nama'   => 'required|min_length[3]',
            'urutan' => 'permit_empty|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        $slug = $this->generateSlug($nama, $id ?: null);

        $data = [
            'nama'      => $nama,
            'slug'      => $slug,
            'deskripsi' => $deskripsi,
            'urutan'    => $urutan,
            'is_active' => $isActive ? 1 : 0,
        ];

        if ($id) {
            $this->modelKategori->update($id, $data);
            $msg = 'Kategori dokumen berhasil diperbarui';
        } else {
            $this->modelKategori->insert($data);
            $msg = 'Kategori dokumen berhasil ditambahkan';
        }

        return redirect()->to('admin/kategori-dokumen')
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

        $row = $this->modelKategori->find($id);
        if (!$row) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }

        $this->modelKategori->delete($id);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Kategori dokumen berhasil dihapus',
        ]);
    }
}
