<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\DokumenModel;

class Dokumen extends BaseController
{
    protected DokumenModel $dokumenModel;

    public function __construct()
    {
        $this->dokumenModel = new DokumenModel();
    }

    /**
     * GET /api/dokumen?page=1&per_page=10&kategori=slug-kategori&tahun=2024
     * Filter:
     * - kategori = slug kategori (opsional)
     * - tahun = int (opsional)
     */
    public function index()
    {
        $page    = max(1, (int) ($this->request->getGet('page') ?? 1));
        $perPage = (int) ($this->request->getGet('per_page') ?? 10);
        $perPage = min(max($perPage, 1), 50);

        $kategoriSlug = trim((string) ($this->request->getGet('kategori') ?? ''));
        $tahun        = trim((string) ($this->request->getGet('tahun') ?? ''));

        $db = \Config\Database::connect();
        $builder = $db->table('dokumen d')
            ->select('d.id, d.kategori_id, d.judul, d.slug, d.nomor, d.tahun, d.tanggal, d.ringkasan, d.file_path, d.file_name, d.mime, d.size, d.updated_at, d.created_at,
                      k.nama as kategori_nama, k.slug as kategori_slug')
            ->join('dokumen_kategori k', 'k.id = d.kategori_id', 'left')
            ->where('d.deleted_at', null)
            ->where('d.is_active', 1);

        // filter kategori by slug
        if ($kategoriSlug !== '') {
            $builder->where('k.slug', $kategoriSlug)
                ->where('k.deleted_at', null)
                ->where('k.is_active', 1);
        }

        // filter tahun
        if ($tahun !== '' && ctype_digit($tahun)) {
            $builder->where('d.tahun', (int) $tahun);
        }

        $total = (clone $builder)->countAllResults(false);

        $rows = $builder
            ->orderBy('d.tanggal', 'desc')
            ->orderBy('d.updated_at', 'desc')
            ->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResultArray();

        $rows = array_map(function ($r) {
            $r['file_url'] = $this->fileUrl($r['file_path'] ?? null);
            return $r;
        }, $rows);

        return $this->response->setJSON([
            'status' => true,
            'meta'   => [
                'page'      => $page,
                'per_page'  => $perPage,
                'total'     => (int) $total,
                'totalPage' => (int) ceil($total / $perPage),
            ],
            'data' => $rows,
        ]);
    }

    /**
     * GET /api/dokumen/{slug}
     */
    public function show($slug = null)
    {
        if (!$slug) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => false,
                'message' => 'Slug is required',
            ]);
        }

        $db = \Config\Database::connect();
        $row = $db->table('dokumen d')
            ->select('d.*, k.nama as kategori_nama, k.slug as kategori_slug')
            ->join('dokumen_kategori k', 'k.id = d.kategori_id', 'left')
            ->where('d.slug', $slug)
            ->where('d.deleted_at', null)
            ->where('d.is_active', 1)
            ->get()
            ->getRowArray();

        if (!$row) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => false,
                'message' => 'Dokumen not found',
            ]);
        }

        $row['file_url'] = $this->fileUrl($row['file_path'] ?? null);

        return $this->response->setJSON([
            'status' => true,
            'data'   => $row,
        ]);
    }

    /**
     * GET /api/dokumen/search?q=keyword&page=1&per_page=10&kategori=slug-kategori
     */
    public function search()
    {
        $q = trim((string) ($this->request->getGet('q') ?? ''));
        if ($q === '') {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => false,
                'message' => 'Query q is required',
            ]);
        }

        $page    = max(1, (int) ($this->request->getGet('page') ?? 1));
        $perPage = (int) ($this->request->getGet('per_page') ?? 10);
        $perPage = min(max($perPage, 1), 50);

        $kategoriSlug = trim((string) ($this->request->getGet('kategori') ?? ''));

        $db = \Config\Database::connect();
        $builder = $db->table('dokumen d')
            ->select('d.id, d.kategori_id, d.judul, d.slug, d.nomor, d.tahun, d.tanggal, d.ringkasan, d.file_path, d.file_name, d.mime, d.size, d.updated_at, d.created_at,
                      k.nama as kategori_nama, k.slug as kategori_slug')
            ->join('dokumen_kategori k', 'k.id = d.kategori_id', 'left')
            ->where('d.deleted_at', null)
            ->where('d.is_active', 1)
            ->groupStart()
            ->like('d.judul', $q)
            ->orLike('d.slug', $q)
            ->orLike('d.nomor', $q)
            ->orLike('d.ringkasan', $q)
            ->orLike('k.nama', $q)
            ->groupEnd();

        if ($kategoriSlug !== '') {
            $builder->where('k.slug', $kategoriSlug)
                ->where('k.deleted_at', null)
                ->where('k.is_active', 1);
        }

        $total = (clone $builder)->countAllResults(false);

        $rows = $builder
            ->orderBy('d.tanggal', 'desc')
            ->orderBy('d.updated_at', 'desc')
            ->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResultArray();

        $rows = array_map(function ($r) {
            $r['file_url'] = $this->fileUrl($r['file_path'] ?? null);
            return $r;
        }, $rows);

        return $this->response->setJSON([
            'status' => true,
            'meta'   => [
                'page'      => $page,
                'per_page'  => $perPage,
                'total'     => (int) $total,
                'totalPage' => (int) ceil($total / $perPage),
            ],
            'data' => $rows,
        ]);
    }

    /**
     * GET /api/dokumen/latest?limit=10
     */
    public function latest()
    {
        $limit = (int) ($this->request->getGet('limit') ?? 10);
        $limit = min(max($limit, 1), 50);

        $db = \Config\Database::connect();
        $rows = $db->table('dokumen d')
            ->select('d.id, d.kategori_id, d.judul, d.slug, d.nomor, d.tahun, d.tanggal, d.ringkasan, d.file_path, d.file_name, d.mime, d.size, d.updated_at, d.created_at,
                      k.nama as kategori_nama, k.slug as kategori_slug')
            ->join('dokumen_kategori k', 'k.id = d.kategori_id', 'left')
            ->where('d.deleted_at', null)
            ->where('d.is_active', 1)
            ->orderBy('d.updated_at', 'desc')
            ->limit($limit)
            ->get()
            ->getResultArray();

        $rows = array_map(function ($r) {
            $r['file_url'] = $this->fileUrl($r['file_path'] ?? null);
            return $r;
        }, $rows);

        return $this->response->setJSON([
            'status' => true,
            'data'   => $rows,
        ]);
    }

    private function fileUrl(?string $filePath): ?string
    {
        if (!$filePath) return null;

        // file dokumen disimpan di WRITEPATH/uploads/dokumen/{filePath}
        // dan route file handler kamu: /file/dokumen/{filename}
        return base_url('file/dokumen/' . $filePath);
    }
}
