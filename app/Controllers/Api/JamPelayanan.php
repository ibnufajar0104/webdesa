<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\JamPelayananModel;

class JamPelayanan extends BaseController
{
    protected JamPelayananModel $model;

    public function __construct()
    {
        $this->model = new JamPelayananModel();
    }

    /**
     * GET /api/jam-pelayanan
     * Hanya yang aktif (is_active=1)
     */
    public function index()
    {
        $rows = $this->model->builder()
            ->select('id, hari, jam_mulai, jam_selesai, keterangan, is_active, updated_at, created_at')
            ->where('is_active', 1)
            ->orderBy('id', 'ASC')
            ->get()->getResultArray();

        return $this->response->setJSON([
            'status' => true,
            'data'   => array_map([$this, 'mapRow'], $rows),
        ]);
    }

    /**
     * GET /api/jam-pelayanan/grouped
     * Output dikelompokkan per hari untuk tampilan frontend (mis. Senin -> array sesi)
     */
    public function grouped()
    {
        $rows = $this->model->builder()
            ->select('id, hari, jam_mulai, jam_selesai, keterangan, is_active')
            ->where('is_active', 1)
            ->orderBy('id', 'ASC')
            ->get()->getResultArray();

        $group = [];
        foreach ($rows as $r) {
            $hari = trim((string)($r['hari'] ?? ''));
            if ($hari === '') $hari = 'Lainnya';

            $group[$hari][] = [
                'id'         => (int)$r['id'],
                'jam_mulai'  => $this->normTime($r['jam_mulai'] ?? null),
                'jam_selesai' => $this->normTime($r['jam_selesai'] ?? null),
                'keterangan' => $r['keterangan'] ?? null,
            ];
        }

        // opsional: urutan hari Indonesia standar
        $orderHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $sorted = [];
        foreach ($orderHari as $h) {
            if (isset($group[$h])) $sorted[$h] = $group[$h];
        }
        // sisanya (kalau ada)
        foreach ($group as $h => $v) {
            if (!isset($sorted[$h])) $sorted[$h] = $v;
        }

        return $this->response->setJSON([
            'status' => true,
            'data'   => $sorted,
        ]);
    }

    /**
     * GET /api/jam-pelayanan/all
     * Opsional: semua data (aktif + nonaktif) untuk preview admin di frontend tertentu.
     */
    public function all()
    {
        $rows = $this->model->builder()
            ->select('id, hari, jam_mulai, jam_selesai, keterangan, is_active, updated_at, created_at')
            ->orderBy('id', 'ASC')
            ->get()->getResultArray();

        return $this->response->setJSON([
            'status' => true,
            'data'   => array_map([$this, 'mapRow'], $rows),
        ]);
    }

    // =========================
    // Helpers
    // =========================

    private function mapRow(array $r): array
    {
        return [
            'id'          => (int)($r['id'] ?? 0),
            'hari'        => $r['hari'] ?? '',
            'jam_mulai'   => $this->normTime($r['jam_mulai'] ?? null),
            'jam_selesai' => $this->normTime($r['jam_selesai'] ?? null),
            'keterangan'  => $r['keterangan'] ?? null,
            'is_active'   => (int)($r['is_active'] ?? 0),
            'updated_at'  => $r['updated_at'] ?? null,
            'created_at'  => $r['created_at'] ?? null,
        ];
    }

    private function normTime($v): ?string
    {
        $v = trim((string)($v ?? ''));
        if ($v === '') return null;

        // biar konsisten, kalau user isi "08.00" -> "08:00"
        $v = str_replace('.', ':', $v);

        // kalau format "08:00:00" -> "08:00"
        if (preg_match('/^\d{2}:\d{2}:\d{2}$/', $v)) {
            return substr($v, 0, 5);
        }

        return $v;
    }
}
