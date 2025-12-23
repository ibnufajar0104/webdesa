<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\SambutanKadesModel;

class SambutanKades extends BaseController
{
    protected SambutanKadesModel $model;

    public function __construct()
    {
        $this->model = new SambutanKadesModel();
    }

    /**
     * GET /api/sambutan-kades
     * Ambil single sambutan yang aktif (is_active=1).
     */
    public function index()
    {
        $row = $this->model
            ->where('is_active', 1)
            ->orderBy('id', 'ASC')
            ->first();

        if (!$row) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => false,
                'message' => 'Sambutan tidak ditemukan',
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'data'   => $this->mapRow($row),
        ]);
    }

    /**
     * GET /api/sambutan-kades/{id}
     * Opsional: detail by id, tetap hormati is_active=1 untuk frontend publik.
     */
    public function show($id = null)
    {
        $id = (int)($id ?? 0);
        if ($id <= 0) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => false,
                'message' => 'Invalid id',
            ]);
        }

        $row = $this->model
            ->where('id', $id)
            ->where('is_active', 1)
            ->first();

        if (!$row) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => false,
                'message' => 'Sambutan tidak ditemukan',
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'data'   => $this->mapRow($row),
        ]);
    }

    private function mapRow(array $row): array
    {
        // foto disimpan di WRITEPATH/uploads/pages (sesuai controller admin kamu)
        $fotoUrl = $this->fotoUrl($row['foto_kades'] ?? null);

        return [
            'id'         => (int)($row['id'] ?? 0),
            'judul'      => $row['judul'] ?? '',
            'isi'        => $row['isi'] ?? '',
            'foto_url'   => $fotoUrl,
            'updated_at' => $row['updated_at'] ?? null,
            'created_at' => $row['created_at'] ?? null,
        ];
    }

    private function fotoUrl(?string $fileName): ?string
    {
        if (!$fileName) return null;

        // konsisten dengan pattern kamu sebelumnya
        return base_url('file/pages/' . $fileName);
    }
}
