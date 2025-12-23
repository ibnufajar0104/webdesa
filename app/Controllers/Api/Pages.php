<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PageModel;

class Pages extends BaseController
{
    protected PageModel $pageModel;

    public function __construct()
    {
        $this->pageModel = new PageModel();
    }

    /**
     * GET /api/pages?page=1&per_page=10&with_content=0
     * Default: tanpa content (biar ringan).
     * Hanya published.
     */
    public function index()
    {
        $page    = max(1, (int) ($this->request->getGet('page') ?? 1));
        $perPage = (int) ($this->request->getGet('per_page') ?? 10);
        $perPage = min(max($perPage, 1), 50);

        $withContent = (int) ($this->request->getGet('with_content') ?? 0) === 1;

        $select = $withContent
            ? 'id, title, slug, status, content, updated_at, created_at'
            : 'id, title, slug, status, updated_at, created_at';

        $builder = $this->pageModel->builder()
            ->select($select)
            ->where('deleted_at', null)
            ->where('status', 'published')
            ->orderBy('updated_at', 'desc');

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
            'data'   => $rows,
        ]);
    }

    /**
     * GET /api/pages/{slug}
     */
    public function show($slug = null)
    {
        if (!$slug) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => false,
                'message' => 'Slug is required',
            ]);
        }

        $row = $this->pageModel->where('slug', $slug)
            ->where('deleted_at', null)
            ->where('status', 'published')
            ->first();

        if (!$row) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => false,
                'message' => 'Page not found',
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'data'   => $row,
        ]);
    }

    /**
     * GET /api/pages/search?q=keyword&page=1&per_page=10&with_content=0
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

        $withContent = (int) ($this->request->getGet('with_content') ?? 0) === 1;

        $select = $withContent
            ? 'id, title, slug, status, content, updated_at, created_at'
            : 'id, title, slug, status, updated_at, created_at';

        $builder = $this->pageModel->builder()
            ->select($select)
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
     * GET /api/pages/latest?limit=5&with_content=0
     */
    public function latest()
    {
        $limit = (int) ($this->request->getGet('limit') ?? 5);
        $limit = min(max($limit, 1), 20);

        $withContent = (int) ($this->request->getGet('with_content') ?? 0) === 1;

        $select = $withContent
            ? 'id, title, slug, status, content, updated_at, created_at'
            : 'id, title, slug, status, updated_at, created_at';

        $rows = $this->pageModel->builder()
            ->select($select)
            ->where('deleted_at', null)
            ->where('status', 'published')
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
