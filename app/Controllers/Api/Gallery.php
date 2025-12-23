<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\GaleryModel;

class Gallery extends BaseController
{
    protected GaleryModel $galeryModel;

    public function __construct()
    {
        $this->galeryModel = new GaleryModel();
    }

    /**
     * GET /api/gallery?page=1&per_page=12
     * Hanya is_active=1, soft-delete aman.
     */
    public function index()
    {
        $page    = max(1, (int) ($this->request->getGet('page') ?? 1));
        $perPage = (int) ($this->request->getGet('per_page') ?? 12);
        $perPage = min(max($perPage, 1), 50);

        $builder = $this->galeryModel->builder()
            ->select('id, file_path, judul, caption, urut, is_active, created_at, updated_at')
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->orderBy('urut', 'asc')
            ->orderBy('id', 'desc');

        $total = (clone $builder)->countAllResults(false);

        $rows = $builder->limit($perPage, ($page - 1) * $perPage)
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
            'data'   => $rows,
        ]);
    }

    /**
     * GET /api/gallery/{id}
     */
    public function show($id = null)
    {
        $id = (int) ($id ?? 0);
        if ($id <= 0) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => false,
                'message' => 'ID is required',
            ]);
        }

        $row = $this->galeryModel->where('id', $id)
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->first();

        if (!$row) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => false,
                'message' => 'Gallery not found',
            ]);
        }

        $row['file_url'] = $this->fileUrl($row['file_path'] ?? null);

        return $this->response->setJSON([
            'status' => true,
            'data'   => $row,
        ]);
    }

    /**
     * GET /api/gallery/search?q=keyword&page=1&per_page=12
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
        $perPage = (int) ($this->request->getGet('per_page') ?? 12);
        $perPage = min(max($perPage, 1), 50);

        $builder = $this->galeryModel->builder()
            ->select('id, file_path, judul, caption, urut, is_active, created_at, updated_at')
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->groupStart()
            ->like('judul', $q)
            ->orLike('caption', $q)
            ->orLike('file_path', $q)
            ->groupEnd()
            ->orderBy('urut', 'asc')
            ->orderBy('id', 'desc');

        $total = (clone $builder)->countAllResults(false);

        $rows = $builder->limit($perPage, ($page - 1) * $perPage)
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
            'data'   => $rows,
        ]);
    }

    /**
     * GET /api/gallery/latest?limit=8
     * Ambil terbaru (urut utama tetap urut ASC, tapi ambil data terbaru by created_at/updated_at).
     * Kalau kamu ingin benar2 "terbaru", ganti orderBy jadi updated_at desc saja.
     */
    public function latest()
    {
        $limit = (int) ($this->request->getGet('limit') ?? 8);
        $limit = min(max($limit, 1), 20);

        $rows = $this->galeryModel->builder()
            ->select('id, file_path, judul, caption, urut, is_active, created_at, updated_at')
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->orderBy('updated_at', 'desc')
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

        // file_path kamu: "galery/namafile.jpg"
        // Route file handler kamu: /file/galery/{filename}
        $fileName = basename($filePath);

        return base_url('file/galery/' . $fileName);
    }
}
