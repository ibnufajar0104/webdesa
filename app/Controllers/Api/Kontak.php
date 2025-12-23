<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\KontakModel;

class Kontak extends BaseController
{
    protected KontakModel $model;

    public function __construct()
    {
        $this->model = new KontakModel();
    }

    /**
     * GET /api/kontak
     * Ambil single kontak desa yang aktif
     */
    public function index()
    {
        $row = $this->model
            ->where('is_active', 1)
            ->orderBy('id', 'ASC')
            ->first();

        if (!$row) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Kontak desa tidak ditemukan',
                ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'data'   => $this->mapRow($row),
        ]);
    }

    // =========================
    // Helpers
    // =========================
    private function mapRow(array $row): array
    {
        return [
            'alamat'   => $row['alamat'] ?? '',
            'telepon'  => $this->norm($row['telepon'] ?? null),
            'whatsapp' => $this->normWa($row['whatsapp'] ?? null),
            'email'    => $this->norm($row['email'] ?? null),
            'website'  => $this->normUrl($row['website'] ?? null),
            'maps'     => $this->normUrl($row['link_maps'] ?? null),
        ];
    }

    private function norm(?string $v): ?string
    {
        $v = trim((string) $v);
        return $v === '' ? null : $v;
    }

    private function normUrl(?string $v): ?string
    {
        $v = trim((string) $v);
        if ($v === '') return null;

        // auto tambahkan https:// kalau admin lupa
        if (!preg_match('~^https?://~i', $v)) {
            $v = 'https://' . $v;
        }
        return $v;
    }

    private function normWa(?string $v): ?array
    {
        $v = trim((string) $v);
        if ($v === '') return null;

        // normalisasi nomor WA (62xxxxxxxxxx)
        $num = preg_replace('/[^0-9]/', '', $v);
        if (strpos($num, '0') === 0) {
            $num = '62' . substr($num, 1);
        }

        return [
            'number' => $num,
            'link'   => 'https://wa.me/' . $num,
        ];
    }
}
