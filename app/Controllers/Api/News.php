<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\NewsModel;

class News extends BaseController
{
    protected NewsModel $newsModel;

    public function __construct()
    {
        $this->newsModel = new NewsModel();
    }

    /**
     * GET /api/news?page=1&per_page=10
     * (hanya published)
     */
    public function index()
    {
        $page    = max(1, (int) ($this->request->getGet('page') ?? 1));
        $perPage = (int) ($this->request->getGet('per_page') ?? 10);
        $perPage = min(max($perPage, 1), 50);

        $builder = $this->newsModel->builder()
            ->select('id, title, slug, cover_image, status, updated_at, created_at')
            ->where('deleted_at', null)
            ->where('status', 'published')
            ->orderBy('updated_at', 'desc');

        $total = (clone $builder)->countAllResults(false);

        $rows = $builder->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResultArray();

        // Map cover URL (opsional)
        $rows = array_map(function ($r) {
            $r['cover_url'] = $this->coverUrl($r['cover_image'] ?? null);
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
     * GET /api/news/{slug}
     */
    public function show($slug = null)
    {
        if (!$slug) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => false,
                'message' => 'Slug is required',
            ]);
        }

        $row = $this->newsModel->where('slug', $slug)
            ->where('deleted_at', null)
            ->where('status', 'published')
            ->first();

        if (!$row) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => false,
                'message' => 'News not found',
            ]);
        }

        $row['cover_url'] = $this->coverUrl($row['cover_image'] ?? null);

        return $this->response->setJSON([
            'status' => true,
            'data'   => $row,
        ]);
    }

    /**
     * GET /api/news/search?q=keyword&page=1&per_page=10
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

        $builder = $this->newsModel->builder()
            ->select('id, title, slug, cover_image, updated_at, created_at')
            ->where('deleted_at', null)
            ->where('status', 'published')
            ->groupStart()
            ->like('title', $q)
            ->orLike('slug', $q)
            ->groupEnd()
            ->orderBy('updated_at', 'desc');

        $total = (clone $builder)->countAllResults(false);

        $rows = $builder->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResultArray();

        $rows = array_map(function ($r) {
            $r['cover_url'] = $this->coverUrl($r['cover_image'] ?? null);
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
     * GET /api/news/latest?limit=5
     */
    public function latest()
    {
        $limit = (int) ($this->request->getGet('limit') ?? 5);
        $limit = min(max($limit, 1), 20);

        $rows = $this->newsModel->builder()
            ->select('id, title, slug, cover_image, updated_at, created_at')
            ->where('deleted_at', null)
            ->where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->limit($limit)
            ->get()
            ->getResultArray();

        $rows = array_map(function ($r) {
            $r['cover_url'] = $this->coverUrl($r['cover_image'] ?? null);
            return $r;
        }, $rows);

        return $this->response->setJSON([
            'status' => true,
            'data'   => $rows,
        ]);
    }

    private function coverUrl(?string $fileName): ?string
    {
        if (!$fileName) return null;

        // SESUAIKAN:
        // Kalau cover kamu disimpan di public/uploads/news/
        return base_url('file/news/' . $fileName);

        // Kalau cover kamu disimpan di WRITEPATH (tidak publik),
        // kamu perlu endpoint "serve cover", jangan base_url langsung.
    }
}
