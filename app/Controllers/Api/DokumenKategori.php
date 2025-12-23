<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\DokumenKategoriModel;

class DokumenKategori extends BaseController
{
    protected DokumenKategoriModel $model;

    public function __construct()
    {
        $this->model = new DokumenKategoriModel();
    }

    /**
     * GET /api/dokumen-kategori?page=1&per_page=50
     * Default: urut ASC by urutan, lalu nama.
     * Hanya is_active=1.
     */
    public function index()
    {
        $page    = max(1, (int) ($this->request->getGet('page') ?? 1));
        $perPage = (int) ($this->request->getGet('per_page') ?? 50);
        $perPage = min(max($perPage, 1), 100);

        $builder = $this->model->builder()
            ->select('id, nama, slug, deskripsi, urutan, is_active, updated_at, created_at')
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->orderBy('urutan', 'asc')
            ->orderBy('nama', 'asc');

        $total = (clone $builder)->countAllResults(false);

        $rows = $builder->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResultArray();

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
     * GET /api/dokumen-kategori/{slug}
     */
    public function show($slug = null)
    {
        if (!$slug) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => false,
                'message' => 'Slug is required',
            ]);
        }

        $row = $this->model->where('slug', $slug)
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->first();

        if (!$row) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => false,
                'message' => 'Kategori dokumen not found',
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'data'   => $row,
        ]);
    }

    /**
     * GET /api/dokumen-kategori/search?q=keyword&page=1&per_page=50
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
        $perPage = (int) ($this->request->getGet('per_page') ?? 50);
        $perPage = min(max($perPage, 1), 100);

        $builder = $this->model->builder()
            ->select('id, nama, slug, deskripsi, urutan, is_active, updated_at, created_at')
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->groupStart()
            ->like('nama', $q)
            ->orLike('slug', $q)
            ->orLike('deskripsi', $q)
            ->groupEnd()
            ->orderBy('urutan', 'asc')
            ->orderBy('nama', 'asc');

        $total = (clone $builder)->countAllResults(false);

        $rows = $builder->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResultArray();

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
     * GET /api/dokumen-kategori/latest?limit=10
     * Terbaru berdasarkan updated_at desc (aktif saja).
     */
    public function latest()
    {
        $limit = (int) ($this->request->getGet('limit') ?? 10);
        $limit = min(max($limit, 1), 50);

        $rows = $this->model->builder()
            ->select('id, nama, slug, deskripsi, urutan, is_active, updated_at, created_at')
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->orderBy('updated_at', 'desc')
            ->limit($limit)
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'status' => true,
            'data'   => $rows,
        ]);
    }
}
