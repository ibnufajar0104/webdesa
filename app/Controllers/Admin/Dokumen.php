<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DokumenModel;
use App\Models\DokumenKategoriModel;

class Dokumen extends BaseController
{
    protected $dokumenModel;
    protected $kategoriModel;
    protected $validation;

    public function __construct()
    {
        $this->dokumenModel  = new DokumenModel();
        $this->kategoriModel = new DokumenKategoriModel();
        $this->validation    = \Config\Services::validation();
        helper(['text', 'url']);
    }

    private function generateSlug(string $title, $ignoreId = null): string
    {
        $slug = url_title($title, '-', true);
        if ($slug === '') $slug = random_string('alnum', 8);

        $original = $slug;
        $i = 1;

        while ($this->slugExists($slug, $ignoreId)) {
            $slug = $original . '-' . ($i++);
        }

        return $slug;
    }

    private function slugExists(string $slug, $ignoreId = null): bool
    {
        $builder = $this->dokumenModel->where('slug', $slug);
        if ($ignoreId !== null) $builder->where('id !=', $ignoreId);
        return $builder->countAllResults() > 0;
    }

    private function kategoriOptions(): array
    {
        return $this->kategoriModel
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->orderBy('urutan', 'ASC')
            ->orderBy('nama', 'ASC')
            ->findAll();
    }

    public function index()
    {
        return view('admin/dokumen/index', [
            'pageTitle'  => 'Dokumen',
            'activeMenu' => 'dokumen',
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
        $orderColumnIdx = $order[0]['column'] ?? 6; // default updated_at
        $orderDir       = $order[0]['dir'] ?? 'desc';

        // Index DT -> field db (tanpa kolom #)
        $columns = [
            0 => 'id',          // virtual
            1 => 'judul',
            2 => 'kategori_nama', // virtual
            3 => 'tahun',
            4 => 'tanggal',
            5 => 'is_active',
            6 => 'updated_at',
        ];

        $orderColumn = $columns[$orderColumnIdx] ?? 'updated_at';

        $db = \Config\Database::connect();
        $builder = $db->table('dokumen d')
            ->select('d.*, k.nama as kategori_nama')
            ->join('dokumen_kategori k', 'k.id = d.kategori_id', 'left')
            ->where('d.deleted_at', null);

        $recordsTotal = $builder->countAllResults(false);

        if ($search) {
            $builder->groupStart()
                ->like('d.judul', $search)
                ->orLike('d.slug', $search)
                ->orLike('d.nomor', $search)
                ->orLike('k.nama', $search)
                ->groupEnd();
        }

        $recordsFiltered = $builder->countAllResults(false);

        // order
        if ($orderColumn === 'kategori_nama') {
            $builder->orderBy('k.nama', $orderDir);
        } else {
            $builder->orderBy('d.' . $orderColumn, $orderDir);
        }

        $builder->limit($length, $start);

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
        return view('admin/dokumen/form', [
            'pageTitle'  => 'Tambah Dokumen',
            'activeMenu' => 'dokumen',
            'mode'       => 'create',
            'kategori'   => $this->kategoriOptions(),
            'row'        => [
                'id'         => '',
                'kategori_id' => old('kategori_id'),
                'judul'      => old('judul'),
                'nomor'      => old('nomor'),
                'tahun'      => old('tahun'),
                'tanggal'    => old('tanggal'),
                'ringkasan'  => old('ringkasan'),
                'file_path'  => old('file_path'),
                'file_name'  => old('file_name'),
                'is_active'  => old('is_active') ?? 1,
            ],
            'errors'     => session('errors') ?? [],
        ]);
    }

    public function edit($id)
    {
        $row = $this->dokumenModel->find($id);

        if (!$row) {
            return redirect()->to('admin/dokumen')
                ->with('error', 'Data tidak ditemukan');
        }

        return view('admin/dokumen/form', [
            'pageTitle'  => 'Edit Dokumen',
            'activeMenu' => 'dokumen',
            'mode'       => 'edit',
            'kategori'   => $this->kategoriOptions(),
            'row'        => [
                'id'         => $row['id'],
                'kategori_id' => old('kategori_id', $row['kategori_id']),
                'judul'      => old('judul', $row['judul']),
                'nomor'      => old('nomor', $row['nomor'] ?? ''),
                'tahun'      => old('tahun', $row['tahun'] ?? ''),
                'tanggal'    => old('tanggal', $row['tanggal'] ?? ''),
                'ringkasan'  => old('ringkasan', $row['ringkasan'] ?? ''),
                'file_path'  => $row['file_path'] ?? '',
                'file_name'  => $row['file_name'] ?? '',
                'is_active'  => old('is_active', $row['is_active'] ?? 1),
            ],
            'errors'     => session('errors') ?? [],
        ]);
    }

    public function save()
    {
        $id         = $this->request->getPost('id');
        $kategoriId = (int) $this->request->getPost('kategori_id');
        $judul      = trim((string) $this->request->getPost('judul'));
        $nomor      = $this->request->getPost('nomor');
        $tahun      = $this->request->getPost('tahun');
        $tanggal    = $this->request->getPost('tanggal');
        $ringkasan  = $this->request->getPost('ringkasan');
        $isActive   = (int) ($this->request->getPost('is_active') ?? 1);

        $rules = [
            'kategori_id' => 'required|is_natural_no_zero',
            'judul'       => 'required|min_length[3]',
            'tahun'       => 'permit_empty|integer',
            'tanggal'     => 'permit_empty|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        $slug = $this->generateSlug($judul, $id ?: null);

        // ambil file lama (jika edit)
        $old = null;
        if ($id) $old = $this->dokumenModel->find($id);

        $filePath = $old['file_path'] ?? null;
        $fileName = $old['file_name'] ?? null;
        $mime     = $old['mime'] ?? null;
        $size     = $old['size'] ?? 0;

        // upload file dokumen
        $file = $this->request->getFile('dokumen_file');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $allowedMime = [
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-powerpoint',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'image/png',
                'image/jpeg',
                'image/jpg',
            ];

            $mimeUpload = $file->getMimeType();
            if (!in_array($mimeUpload, $allowedMime, true)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['dokumen_file' => 'Format file tidak didukung (PDF/DOC/DOCX/XLS/XLSX/PPT/PPTX/JPG/PNG)']);
            }

            // max 15MB
            if ($file->getSize() > (15 * 1024 * 1024)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['dokumen_file' => 'Ukuran file terlalu besar (maks 15MB)']);
            }

            $uploadPath = WRITEPATH . 'uploads/dokumen/';
            if (!is_dir($uploadPath)) mkdir($uploadPath, 0755, true);

            // hapus file lama (opsional)
            if (!empty($filePath) && is_file($uploadPath . $filePath)) {
                @unlink($uploadPath . $filePath);
            }

            $newName  = $file->getRandomName();
            $file->move($uploadPath, $newName);

            $filePath = $newName;
            $fileName = $file->getClientName();
            $mime     = $mimeUpload;
            $size     = $file->getSize();
        }

        // untuk insert baru, file wajib ada
        if (!$id && empty($filePath)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', ['dokumen_file' => 'File dokumen wajib diunggah']);
        }

        $data = [
            'kategori_id' => $kategoriId,
            'judul'       => $judul,
            'slug'        => $slug,
            'nomor'       => $nomor,
            'tahun'       => $tahun ?: null,
            'tanggal'     => $tanggal ?: null,
            'ringkasan'   => $ringkasan,
            'file_path'   => $filePath,
            'file_name'   => $fileName,
            'mime'        => $mime,
            'size'        => (int) $size,
            'is_active'   => $isActive ? 1 : 0,
        ];

        if ($id) {
            $this->dokumenModel->update($id, $data);
            $msg = 'Dokumen berhasil diperbarui';
        } else {
            $this->dokumenModel->insert($data);
            $msg = 'Dokumen berhasil ditambahkan';
        }

        return redirect()->to('admin/dokumen')
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

        $row = $this->dokumenModel->find($id);
        if (!$row) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }

        // soft delete
        $this->dokumenModel->delete($id);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Dokumen berhasil dihapus',
        ]);
    }
}
