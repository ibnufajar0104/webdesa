<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NewsModel;

class Berita extends BaseController
{
    protected $newsModel;
    protected $validation;

    public function __construct()
    {
        $this->newsModel  = new NewsModel();
        $this->validation = \Config\Services::validation();
        helper('text');
    }

    private function generateSlug(string $title, $ignoreId = null): string
    {
        $slug = url_title($title, '-', true);
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
        $builder = $this->newsModel->where('slug', $slug);
        if ($ignoreId !== null) {
            $builder->where('id !=', $ignoreId);
        }
        return $builder->countAllResults() > 0;
    }

    public function index()
    {
        return view('admin/berita/index', [
            'pageTitle'  => 'Berita',
            'activeMenu' => 'berita',
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
        $orderColumnIdx = $order[0]['column'] ?? 3;   // default: updated_at
        $orderDir       = $order[0]['dir'] ?? 'desc';

        // index DT -> field db (tanpa kolom cover & index)
        $columns = [
            0 => 'id',          // index (virtual)
            1 => 'title',       // judul
            2 => 'status',      // status
            3 => 'updated_at',  // updated_at
        ];
        $orderColumn = $columns[$orderColumnIdx] ?? 'updated_at';

        $builder = $this->newsModel->builder();
        $builder->where('deleted_at', null);

        $recordsTotal = $builder->countAllResults(false);

        if ($search) {
            $builder->groupStart()
                ->like('title', $search)
                ->orLike('slug', $search)
                ->groupEnd();
        }

        $recordsFiltered = $builder->countAllResults(false);

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
        return view('admin/berita/form', [
            'pageTitle'  => 'Tambah Berita',
            'activeMenu' => 'berita',
            'mode'       => 'create',
            'news'       => [
                'id'          => '',
                'title'       => old('title'),
                'slug'        => old('slug'),
                'status'      => old('status') ?? 'published',
                'content'     => old('content'),
                'cover_image' => old('cover_image'),
            ],
            'errors'     => session('errors') ?? [],
        ]);
    }

    public function edit($id)
    {
        $news = $this->newsModel->find($id);

        if (!$news) {
            return redirect()->to('admin/berita')
                ->with('error', 'Data tidak ditemukan');
        }

        return view('admin/berita/form', [
            'pageTitle'  => 'Edit Berita',
            'activeMenu' => 'berita',
            'mode'       => 'edit',
            'news'       => [
                'id'          => $news['id'],
                'title'       => old('title', $news['title']),
                'slug'        => old('slug', $news['slug']),
                'status'      => old('status', $news['status']),
                'content'     => old('content', $news['content']),
                'cover_image' => old('cover_image', $news['cover_image'] ?? null),
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

        // handle cover image (thumbnail)
        $coverFile = $this->request->getFile('cover_image');
        $coverName = null;

        // jika edit, ambil cover lama
        if ($id) {
            $row = $this->newsModel->find($id);
            if ($row && !empty($row['cover_image'])) {
                $coverName = $row['cover_image'];
            }
        }

        if ($coverFile && $coverFile->isValid() && !$coverFile->hasMoved()) {
            $mime    = $coverFile->getMimeType();
            $allowed = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/webp'];

            if (!in_array($mime, $allowed, true)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['cover_image' => 'Format gambar tidak didukung']);
            }

            $uploadPath = WRITEPATH . 'uploads/news/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // jika ada cover lama, bisa kamu hapus (opsional)
            if (!empty($coverName) && is_file($uploadPath . $coverName)) {
                @unlink($uploadPath . $coverName);
            }

            $fileSize = $coverFile->getSize();
            $tmpPath  = $coverFile->getTempName();

            $maxSizeForCompress = 1 * 1024 * 1024; // 1MB

            if ($fileSize <= $maxSizeForCompress) {
                // simpan apa adanya
                $newName = $coverFile->getRandomName();
                $coverFile->move($uploadPath, $newName);
                $coverName = $newName;
            } else {
                // compress seperti uploadImage halaman statis
                [$width, $height] = getimagesize($tmpPath);

                switch ($mime) {
                    case 'image/jpeg':
                    case 'image/jpg':
                        $src = imagecreatefromjpeg($tmpPath);

                        if (function_exists('exif_read_data')) {
                            $exif = @exif_read_data($tmpPath);
                            if (!empty($exif['Orientation'])) {
                                switch ($exif['Orientation']) {
                                    case 3:
                                        $src = imagerotate($src, 180, 0);
                                        break;
                                    case 6:
                                        $src = imagerotate($src, -90, 0);
                                        break;
                                    case 8:
                                        $src = imagerotate($src, 90, 0);
                                        break;
                                }
                            }
                        }

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
                        return redirect()->back()
                            ->withInput()
                            ->with('errors', ['cover_image' => 'Format gambar tidak dapat diproses']);
                }

                $dst = imagecreatetruecolor($width, $height);
                $white = imagecolorallocate($dst, 255, 255, 255);
                imagefill($dst, 0, 0, $white);

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

                $newName  = uniqid('cover_', true) . '.jpg';
                $fullPath = $uploadPath . $newName;

                imagejpeg($dst, $fullPath, 80);

                imagedestroy($src);
                imagedestroy($dst);

                $coverName = $newName;
            }
        }

        $data = [
            'title'       => $title,
            'slug'        => $slug,
            'status'      => $status,
            'content'     => $content,
            'cover_image' => $coverName,
        ];

        if ($id) {
            $this->newsModel->update($id, $data);
            $msg = 'Berita berhasil diperbarui';
        } else {
            $this->newsModel->insert($data);
            $msg = 'Berita berhasil ditambahkan';
        }

        return redirect()->to('admin/berita')
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

        $news = $this->newsModel->find($id);
        if (!$news) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }

        // soft delete
        $this->newsModel->delete($id);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Berita berhasil dihapus',
        ]);
    }
}
