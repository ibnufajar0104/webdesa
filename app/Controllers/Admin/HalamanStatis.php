<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PageModel;

class HalamanStatis extends BaseController
{
    protected $pageModel;
    protected $validation;

    public function __construct()
    {
        $this->pageModel  = new PageModel();
        $this->validation = \Config\Services::validation();
        helper('text');
    }

    private function generateSlug(string $title, $ignoreId = null): string
    {
        // slug dasar
        $slug = url_title($title, '-', true);
        if ($slug === '') {
            $slug = random_string('alnum', 8);
        }

        $original = $slug;
        $i = 1;

        while ($this->slugExists($slug, $ignoreId)) {
            // kalau bentrok, tambahkan suffix angka
            $slug = $original . '-' . ($i++);
        }

        return $slug;
    }

    private function slugExists(string $slug, $ignoreId = null): bool
    {
        $builder = $this->pageModel->where('slug', $slug);
        if ($ignoreId !== null) {
            $builder->where('id !=', $ignoreId);
        }
        return $builder->countAllResults() > 0;
    }

    public function index()
    {
        return view('admin/halaman_statis/index', [
            'pageTitle'  => 'Halaman Statis',
            'activeMenu' => 'halaman_statis',
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
        $orderColumnIdx = $order[0]['column'] ?? 1;   // default: title
        $orderDir       = $order[0]['dir'] ?? 'asc';

        // mapping index kolom DataTables -> field database
        $columns = [
            0 => 'id',
            1 => 'title',
            2 => 'slug',
            3 => 'status',
            4 => 'updated_at',
        ];
        $orderColumn = $columns[$orderColumnIdx] ?? 'title';

        // total tanpa filter (hanya yang belum di-soft-delete)
        $builder = $this->pageModel->builder();
        $builder->where('deleted_at', null);
        $recordsTotal = $builder->countAllResults(false);

        // filter search
        if ($search) {
            $builder->groupStart()
                ->like('title', $search)
                ->orLike('slug', $search)
                ->groupEnd();
        }

        $recordsFiltered = $builder->countAllResults(false);

        // order + limit
        $builder->orderBy($orderColumn, $orderDir)
            ->limit($length, $start);

        $query = $builder->get();
        $data  = $query->getResultArray();

        return $this->response->setJSON([
            'draw'            => $draw,
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
        ]);
    }

    public function create()
    {
        return view('admin/halaman_statis/form', [
            'pageTitle'  => 'Tambah Halaman',
            'activeMenu' => 'halaman_statis',
            'mode'       => 'create',
            'page'       => [
                'id'      => '',
                'title'   => old('title'),
                'slug'    => old('slug'),
                'status'  => old('status') ?? 'published',
                'content' => old('content'),
            ],
            'errors'     => session('errors') ?? [],
        ]);
    }

    public function edit($id)
    {
        $page = $this->pageModel->find($id);

        if (!$page) {
            return redirect()->to('admin/halaman-statis')
                ->with('error', 'Data tidak ditemukan');
        }

        return view('admin/halaman_statis/form', [
            'pageTitle'  => 'Edit Halaman',
            'activeMenu' => 'halaman_statis',
            'mode'       => 'edit',
            'page'       => [
                'id'      => $page['id'],
                'title'   => old('title', $page['title']),
                'slug'    => old('slug', $page['slug']),
                'status'  => old('status', $page['status']),
                'content' => old('content', $page['content']),
            ],
            'errors'     => session('errors') ?? [],
        ]);
    }

    public function save()
    {
        $id      = $this->request->getPost('id');
        $title   = $this->request->getPost('title');
        $slug    = $this->generateSlug($title, $id);
        $status  = $this->request->getPost('status') ?? 'published';
        $content = $this->request->getPost('content');

        $rules = [
            'title' => 'required|min_length[3]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        $data = [
            'title'   => $title,
            'slug'    => $slug,
            'status'  => $status,
            'content' => $content,
        ];

        if ($id) {
            $this->pageModel->update($id, $data);
            $msg = 'Halaman berhasil diperbarui';
        } else {
            $this->pageModel->insert($data);
            $msg = 'Halaman berhasil ditambahkan';
        }

        return redirect()->to('admin/halaman-statis')
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

        $page = $this->pageModel->find($id);
        if (!$page) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }

        // soft delete
        $this->pageModel->delete($id);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Halaman berhasil dihapus',
        ]);
    }

    public function uploadImage()
    {
        if (!$this->request->is('post')) {
            return $this->response->setStatusCode(405);
        }

        $file = $this->request->getFile('file');

        if (!$file || !$file->isValid()) {
            return $this->response->setJSON(['error' => 'File tidak valid']);
        }

        $mime    = $file->getMimeType();
        $allowed = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/webp'];

        if (!in_array($mime, $allowed, true)) {
            return $this->response->setJSON(['error' => 'Format gambar tidak didukung']);
        }

        $uploadPath = WRITEPATH . 'uploads/pages/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $fileSize = $file->getSize();       // byte
        $tmpPath  = $file->getTempName();

        // batas untuk mulai compress
        $maxSizeForCompress = 1 * 1024 * 1024; // 1 MB

        // ========== 1) FILE KECIL → SIMPAN APA ADANYA ==========
        if ($fileSize <= $maxSizeForCompress) {
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);

            $publicUrl = base_url('file/pages/' . $newName);

            return $this->response->setJSON([
                'location' => $publicUrl,
            ]);
        }

        // ========== 2) FILE BESAR → KOMPRES (DIMENSI TETAP) ==========
        // Ambil dimensi asli
        [$width, $height] = getimagesize($tmpPath);

        // Load gambar sesuai jenis
        switch ($mime) {
            case 'image/jpeg':
            case 'image/jpg':
                $src = imagecreatefromjpeg($tmpPath);

                // --- FIX EXIF ORIENTATION UNTUK JPEG ---
                if (function_exists('exif_read_data')) {
                    $exif = @exif_read_data($tmpPath);
                    if (!empty($exif['Orientation'])) {
                        switch ($exif['Orientation']) {
                            case 3: // 180 derajat
                                $src = imagerotate($src, 180, 0);
                                break;
                            case 6: // 90 derajat CW
                                $src = imagerotate($src, -90, 0);
                                break;
                            case 8: // 90 derajat CCW
                                $src = imagerotate($src, 90, 0);
                                break;
                        }
                    }
                }

                // setelah rotate, dimensi bisa berubah (portrait/landscape)
                $width  = imagesx($src);
                $height = imagesy($src);
                break;

            case 'image/png':
                $src = imagecreatefrompng($tmpPath);
                break;

            case 'image/gif':
                $src = imagecreatefromgif($tmpPath);
                break;

            case 'image/webp':
                $src = imagecreatefromwebp($tmpPath);
                break;

            default:
                return $this->response->setJSON(['error' => 'Format tidak dapat diproses']);
        }

        // Canvas tujuan, ukuran sama persis (tidak ubah dimensi)
        $dst = imagecreatetruecolor($width, $height);

        // Kalau asalnya ada alpha (PNG/WebP), kita bisa isi background putih biar aman,
        // karena output akhirnya JPEG (tanpa transparan).
        $white = imagecolorallocate($dst, 255, 255, 255);
        imagefill($dst, 0, 0, $white);

        // Copy pixel 1:1 (tanpa scaling aspect ratio)
        imagecopyresampled(
            $dst,
            $src,
            0,
            0,
            0,
            0,
            $width,
            $height,
            $width,
            $height
        );

        // Selalu simpan sebagai JPEG terkompres
        $newName  = uniqid('img_', true) . '.jpg';
        $fullPath = $uploadPath . $newName;

        imagejpeg($dst, $fullPath, 80); // quality 80

        imagedestroy($src);
        imagedestroy($dst);

        $publicUrl = base_url('file/pages/' . $newName);

        return $this->response->setJSON([
            'location' => $publicUrl,
        ]);
    }
}
