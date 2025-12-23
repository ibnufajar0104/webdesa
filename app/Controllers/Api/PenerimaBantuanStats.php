<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

class PenerimaBantuanStats extends BaseController
{
    protected $db;

    // masking kecil untuk publik (anti-identifikasi). bisa kamu matikan kalau endpoint ini internal.
    protected int $minBucket = 5;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * GET /api/penerima-bantuan/stats/overview?tahun=2025&bantuan_id=1&status=1&periode=Jan
     */
    public function overview()
    {
        $f = $this->filters();

        $base = $this->base($f);

        // agregat dasar
        $row = $base->select("
            COUNT(*) as total_row,
            COUNT(DISTINCT penerima_bantuan.penduduk_id) as total_penerima_unik,
            SUM(CASE WHEN penerima_bantuan.status = 1 THEN 1 ELSE 0 END) as total_status_aktif,
            SUM(CASE WHEN penerima_bantuan.status = 0 THEN 1 ELSE 0 END) as total_status_nonaktif,

            SUM(CASE WHEN penerima_bantuan.nominal IS NOT NULL THEN 1 ELSE 0 END) as nominal_filled,
            SUM(CASE WHEN penerima_bantuan.nominal IS NULL THEN 1 ELSE 0 END) as nominal_null,

            COALESCE(SUM(penerima_bantuan.nominal), 0) as nominal_sum,
            COALESCE(AVG(penerima_bantuan.nominal), 0) as nominal_avg,
            COALESCE(MAX(penerima_bantuan.nominal), 0) as nominal_max,
            COALESCE(MIN(penerima_bantuan.nominal), 0) as nominal_min
        ", false)->get()->getRowArray();

        return $this->response->setJSON([
            'status' => true,
            'filters' => $f,
            'privacy' => [
                'min_bucket' => $this->minBucket,
                'rule' => 'Bucket count < min_bucket dimasking menjadi "<min_bucket" (mencegah identifikasi).',
            ],
            'data' => [
                'total_row'           => (int)($row['total_row'] ?? 0),
                'total_penerima_unik' => (int)($row['total_penerima_unik'] ?? 0),
                'status' => [
                    'aktif'    => (int)($row['total_status_aktif'] ?? 0),
                    'nonaktif' => (int)($row['total_status_nonaktif'] ?? 0),
                ],
                'nominal' => [
                    'filled' => (int)($row['nominal_filled'] ?? 0),
                    'null'   => (int)($row['nominal_null'] ?? 0),
                    'sum'    => (float)($row['nominal_sum'] ?? 0),
                    'avg'    => (float)($row['nominal_avg'] ?? 0),
                    'min'    => (float)($row['nominal_min'] ?? 0),
                    'max'    => (float)($row['nominal_max'] ?? 0),
                ],
            ],
        ]);
    }

    /**
     * GET /api/penerima-bantuan/stats/by-bantuan?tahun=2025&status=1
     * Output: per program bantuan (jumlah row, jumlah penerima unik, total nominal)
     */
    public function byBantuan()
    {
        $f = $this->filters();

        $rows = $this->base($f)
            ->join('master_bantuan mb', 'mb.id = penerima_bantuan.bantuan_id', 'left')
            ->select("
                penerima_bantuan.bantuan_id,
                mb.nama_bantuan,
                COUNT(*) as total_row,
                COUNT(DISTINCT penerima_bantuan.penduduk_id) as total_penerima_unik,
                COALESCE(SUM(penerima_bantuan.nominal), 0) as nominal_sum
            ", false)
            ->groupBy('penerima_bantuan.bantuan_id')
            ->orderBy('mb.urut', 'ASC')
            ->orderBy('mb.nama_bantuan', 'ASC')
            ->get()->getResultArray();

        $rows = array_map(fn($r) => $this->maskSmallBucket($r, 'total_penerima_unik'), $rows);

        return $this->response->setJSON([
            'status' => true,
            'filters' => $f,
            'data' => $rows,
        ]);
    }

    /**
     * GET /api/penerima-bantuan/stats/by-periode?tahun=2025&bantuan_id=1
     * Output: agregat per "periode" (string), default diurutkan alfabet/tanggal (kalau format konsisten)
     */
    public function byPeriode()
    {
        $f = $this->filters();

        $rows = $this->base($f)
            ->select("
                COALESCE(penerima_bantuan.periode, '(Tanpa Periode)') as periode,
                COUNT(*) as total_row,
                COUNT(DISTINCT penerima_bantuan.penduduk_id) as total_penerima_unik,
                COALESCE(SUM(penerima_bantuan.nominal), 0) as nominal_sum
            ", false)
            ->groupBy('periode')
            ->orderBy('periode', 'ASC')
            ->get()->getResultArray();

        $rows = array_map(fn($r) => $this->maskSmallBucket($r, 'total_penerima_unik'), $rows);

        return $this->response->setJSON([
            'status' => true,
            'filters' => $f,
            'data' => $rows,
        ]);
    }

    /**
     * GET /api/penerima-bantuan/stats/tren?by=month|year&range=24&bantuan_id=1&status=1
     * Tren berdasarkan tanggal_terima (kalau null, bisa jatuh ke created_at).
     */
    public function tren()
    {
        $f = $this->filters();

        $by    = strtolower((string)($this->request->getGet('by') ?? 'month'));
        $range = (int)($this->request->getGet('range') ?? 24);
        $range = min(max($range, 1), 120);

        // pakai tanggal_terima jika ada, fallback ke created_at
        $dateExpr = "COALESCE(NULLIF(penerima_bantuan.tanggal_terima, ''), penerima_bantuan.created_at)";

        if ($by === 'year') {
            $groupExpr = "DATE_FORMAT($dateExpr, '%Y')";
        } else {
            $by = 'month';
            $groupExpr = "DATE_FORMAT($dateExpr, '%Y-%m')";
        }

        $rows = $this->base($f)
            ->select("$groupExpr as periode, COUNT(*) as total_row, COUNT(DISTINCT penerima_bantuan.penduduk_id) as total_penerima_unik, COALESCE(SUM(penerima_bantuan.nominal),0) as nominal_sum", false)
            ->where("$dateExpr IS NOT NULL", null, false)
            ->groupBy('periode')
            ->orderBy('periode', 'ASC')
            ->get()->getResultArray();

        // potong terakhir sesuai range (ambil tail)
        if (count($rows) > $range) {
            $rows = array_slice($rows, -$range);
        }

        $rows = array_map(fn($r) => $this->maskSmallBucket($r, 'total_penerima_unik'), $rows);

        return $this->response->setJSON([
            'status' => true,
            'filters' => array_merge($f, ['by' => $by, 'range' => $range]),
            'data' => $rows,
        ]);
    }

    /**
     * GET /api/penerima-bantuan/stats/quality?tahun=2025
     * cek kelengkapan field + kemungkinan duplikat secara statistik (tanpa identitas)
     */
    public function quality()
    {
        $f = $this->filters();

        $row = $this->base($f)
            ->select("
                COUNT(*) as total_row,

                SUM(CASE WHEN penerima_bantuan.penduduk_id IS NULL THEN 1 ELSE 0 END) as null_penduduk,
                SUM(CASE WHEN penerima_bantuan.bantuan_id IS NULL THEN 1 ELSE 0 END) as null_bantuan,
                SUM(CASE WHEN penerima_bantuan.tahun IS NULL THEN 1 ELSE 0 END) as null_tahun,

                SUM(CASE WHEN penerima_bantuan.periode IS NULL OR penerima_bantuan.periode = '' THEN 1 ELSE 0 END) as null_periode,
                SUM(CASE WHEN penerima_bantuan.tanggal_terima IS NULL OR penerima_bantuan.tanggal_terima = '' THEN 1 ELSE 0 END) as null_tanggal_terima,
                SUM(CASE WHEN penerima_bantuan.nominal IS NULL THEN 1 ELSE 0 END) as null_nominal
            ", false)
            ->get()->getRowArray();

        $total = (int)($row['total_row'] ?? 0);
        if ($total <= 0) $total = 1;

        $pct = fn($n) => round(((int)$n / $total) * 100, 2);

        return $this->response->setJSON([
            'status' => true,
            'filters' => $f,
            'data' => [
                'total_row' => (int)($row['total_row'] ?? 0),
                'nulls' => [
                    'penduduk_id'   => ['count' => (int)($row['null_penduduk'] ?? 0), 'pct' => $pct($row['null_penduduk'] ?? 0)],
                    'bantuan_id'    => ['count' => (int)($row['null_bantuan'] ?? 0),  'pct' => $pct($row['null_bantuan'] ?? 0)],
                    'tahun'         => ['count' => (int)($row['null_tahun'] ?? 0),    'pct' => $pct($row['null_tahun'] ?? 0)],
                    'periode'       => ['count' => (int)($row['null_periode'] ?? 0),  'pct' => $pct($row['null_periode'] ?? 0)],
                    'tanggal_terima' => ['count' => (int)($row['null_tanggal_terima'] ?? 0), 'pct' => $pct($row['null_tanggal_terima'] ?? 0)],
                    'nominal'       => ['count' => (int)($row['null_nominal'] ?? 0),  'pct' => $pct($row['null_nominal'] ?? 0)],
                ],
            ],
        ]);
    }

    // =========================
    // Helpers
    // =========================

    private function filters(): array
    {
        $tahun     = $this->request->getGet('tahun');
        $bantuanId = $this->request->getGet('bantuan_id');
        $status    = $this->request->getGet('status');
        $periode   = $this->request->getGet('periode');

        return [
            'tahun'      => ($tahun !== null && $tahun !== '') ? (int)$tahun : null,
            'bantuan_id' => ($bantuanId !== null && $bantuanId !== '') ? (int)$bantuanId : null,
            'status'     => ($status !== null && $status !== '') ? (int)$status : null, // 0/1
            'periode'    => ($periode !== null && $periode !== '') ? (string)$periode : null,
        ];
    }

    private function base(array $f)
    {
        $b = $this->db->table('penerima_bantuan')
            ->where('penerima_bantuan.deleted_at', null);

        if (!empty($f['tahun'])) {
            $b->where('penerima_bantuan.tahun', (int)$f['tahun']);
        }
        if (!empty($f['bantuan_id'])) {
            $b->where('penerima_bantuan.bantuan_id', (int)$f['bantuan_id']);
        }
        if ($f['status'] === 0 || $f['status'] === 1) {
            $b->where('penerima_bantuan.status', (int)$f['status']);
        }
        if (!empty($f['periode'])) {
            $b->where('penerima_bantuan.periode', $f['periode']);
        }

        return $b;
    }

    private function maskSmallBucket(array $row, string $fieldCount): array
    {
        $n = (int)($row[$fieldCount] ?? 0);
        if ($n > 0 && $n < $this->minBucket) {
            $row[$fieldCount] = '<' . $this->minBucket;
            $row['_masked'] = true;
        } else {
            $row['_masked'] = false;
        }
        return $row;
    }
}
