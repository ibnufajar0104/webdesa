<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\BannerModel;

class Banner extends BaseController
{
    protected BannerModel $bannerModel;

    public function __construct()
    {
        $this->bannerModel = new BannerModel();
    }

    /**
     * GET /api/banner
     * ?limit=
     *
     * Ambil semua banner aktif (default: semua)
     */
    public function index()
    {
        $limit = (int) ($this->request->getGet('limit') ?? 0);
        $limit = min(max($limit, 0), 20); // max 20 banner

        $builder = $this->bannerModel->builder()
            ->select('id, title, subtitle, description, button_text, button_url, image, position')
            ->where('deleted_at', null)
            ->where('status', 'active')
            ->orderBy('position', 'asc')
            ->orderBy('updated_at', 'desc');

        if ($limit > 0) {
            $builder->limit($limit);
        }

        $rows = $builder->get()->getResultArray();

        $rows = array_map(function ($row) {
            $row['image_url'] = $this->imageUrl($row['image'] ?? null);
            return $row;
        }, $rows);

        return $this->response->setJSON([
            'status' => true,
            'data'   => $rows,
        ]);
    }

    /**
     * GET /api/banner/{id}
     * (opsional, kalau frontend butuh detail satu banner)
     */
    public function show($id = null)
    {
        if (!$id || !is_numeric($id)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => false,
                'message' => 'Invalid banner ID',
            ]);
        }

        $row = $this->bannerModel->where('id', $id)
            ->where('deleted_at', null)
            ->where('status', 'active')
            ->first();

        if (!$row) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => false,
                'message' => 'Banner not found',
            ]);
        }

        $row['image_url'] = $this->imageUrl($row['image'] ?? null);

        return $this->response->setJSON([
            'status' => true,
            'data'   => $row,
        ]);
    }

    /**
     * Helper URL gambar banner
     */
    private function imageUrl(?string $fileName): ?string
    {
        if (!$fileName) return null;

        // SESUAIKAN DENGAN FileHandler kamu
        // karena banner disimpan di WRITEPATH/uploads/banner
        return site_url('file/banner/' . $fileName);
    }
}
