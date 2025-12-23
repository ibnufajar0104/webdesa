<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

class PendudukStats extends BaseController
{
    protected $db;

    // privacy: jangan tampilkan angka bucket yang terlalu kecil
    protected int $minBucket = 5;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * GET /api/penduduk/stats/overview?dusun_id=&rt_id=
     * Ringkasan sangat detail (tanpa identitas).
     */
    public function overview()
    {
        $f = $this->filters();

        // total dasar (semua yg belum soft-delete)
        $total = $this->basePenduduk($f)->countAllResults(false);

        // status_dasar (Hidup/Meninggal/Pindah/DLL sesuai data)
        $statusDasar = $this->groupCount('penduduk.status_dasar', $f);

        // status_penduduk (Tetap/Pendatang/DLL)
        $statusPenduduk = $this->groupCount('penduduk.status_penduduk', $f);

        // gender
        $jk = $this->groupCount('penduduk.jenis_kelamin', $f, [
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
        ]);

        // kewarganegaraan
        $wn = $this->groupCount('penduduk.kewarganegaraan', $f);

        // perkawinan
        $kawin = $this->groupCount('penduduk.status_perkawinan', $f);

        // agama
        $agama = $this->groupCountJoin(
            'master_agama',
            'master_agama.id = penduduk.agama_id',
            'master_agama.nama_agama',
            $f
        );

        // pendidikan
        $pendidikan = $this->groupCountJoin(
            'master_pendidikan',
            'master_pendidikan.id = penduduk.pendidikan_id',
            'master_pendidikan.nama_pendidikan',
            $f
        );

        // pekerjaan
        $pekerjaan = $this->groupCountJoin(
            'master_pekerjaan',
            'master_pekerjaan.id = penduduk.pekerjaan_id',
            'master_pekerjaan.nama_pekerjaan',
            $f
        );

        // gol darah
        $goldar = $this->groupCount('penduduk.golongan_darah', $f);

        // usia (bucket)
        $usia = $this->ageBuckets($f);

        // statistik demografi lanjutan (median/avg usia) -> berbasis TIMESTAMPDIFF, tanpa tanggal lahir mentah
        $ageAgg = $this->ageAggregates($f);

        // kelengkapan data (berapa yang null)
        $completeness = $this->dataCompleteness($f);

        return $this->response->setJSON([
            'status' => true,
            'privacy' => [
                'min_bucket' => $this->minBucket,
                'rule' => 'Bucket count < min_bucket dimasking menjadi "<min_bucket" (mencegah identifikasi).',
            ],
            'data' => [
                'total' => (int)$total,
                'gender' => $jk,
                'status_dasar' => $statusDasar,
                'status_penduduk' => $statusPenduduk,
                'kewarganegaraan' => $wn,
                'status_perkawinan' => $kawin,
                'agama' => $agama,
                'pendidikan' => $pendidikan,
                'pekerjaan' => $pekerjaan,
                'golongan_darah' => $goldar,
                'usia' => $usia,
                'usia_ringkas' => $ageAgg,
                'kelengkapan_data' => $completeness,
            ],
        ]);
    }

    /**
     * GET /api/penduduk/stats/wilayah?level=dusun|rt
     * - level=dusun -> agregasi per dusun
     * - level=rt    -> agregasi per RT (dengan dusun)
     */
    public function wilayah()
    {
        $level = strtolower((string)($this->request->getGet('level') ?? 'dusun'));
        $f = $this->filters();

        if ($level === 'rt') {
            $builder = $this->basePenduduk($f)
                ->select('dusun.id as dusun_id, dusun.nama_dusun, rt.id as rt_id, rt.no_rt, COUNT(*) as total', false)
                ->join('rt', 'rt.id = penduduk.rt_id', 'left')
                ->join('dusun', 'dusun.id = rt.id_dusun', 'left')
                ->groupBy('dusun.id, dusun.nama_dusun, rt.id, rt.no_rt')
                ->orderBy('dusun.nama_dusun', 'asc')
                ->orderBy('rt.no_rt', 'asc');

            $rows = $builder->get()->getResultArray();
            $rows = $this->maskSmallBuckets($rows, 'total');

            return $this->response->setJSON(['status' => true, 'data' => $rows]);
        }

        // default dusun
        $builder = $this->basePenduduk($f)
            ->select('dusun.id as dusun_id, dusun.nama_dusun, COUNT(*) as total', false)
            ->join('rt', 'rt.id = penduduk.rt_id', 'left')
            ->join('dusun', 'dusun.id = rt.id_dusun', 'left')
            ->groupBy('dusun.id, dusun.nama_dusun')
            ->orderBy('dusun.nama_dusun', 'asc');

        $rows = $builder->get()->getResultArray();
        $rows = $this->maskSmallBuckets($rows, 'total');

        return $this->response->setJSON(['status' => true, 'data' => $rows]);
    }

    /**
     * GET /api/penduduk/stats/usia?mode=bucket|single&min=&max=
     * - mode=bucket (default): bucket umur
     */
    public function usia()
    {
        $f = $this->filters();
        $mode = strtolower((string)($this->request->getGet('mode') ?? 'bucket'));

        if ($mode === 'single') {
            // per umur (0..100) -> ini rawan identifikasi di desa kecil, jadi kita mask juga
            $rows = $this->ageSingleYears($f);
            return $this->response->setJSON(['status' => true, 'data' => $rows]);
        }

        return $this->response->setJSON(['status' => true, 'data' => $this->ageBuckets($f)]);
    }

    /**
     * GET /api/penduduk/stats/tren?by=month|year&range=24
     * Tren berdasarkan created_at (bukan identitas)
     */
    public function tren()
    {
        $f = $this->filters();
        $by = strtolower((string)($this->request->getGet('by') ?? 'month'));
        $range = (int)($this->request->getGet('range') ?? 24);
        $range = min(max($range, 6), 120);

        if ($by === 'year') {
            $rows = $this->basePenduduk($f)
                ->select('YEAR(penduduk.created_at) as periode, COUNT(*) as total', false)
                ->where('penduduk.created_at IS NOT NULL', null, false)
                ->groupBy('YEAR(penduduk.created_at)')
                ->orderBy('periode', 'asc')
                ->get()->getResultArray();

            return $this->response->setJSON(['status' => true, 'data' => $rows]);
        }

        // month
        $rows = $this->basePenduduk($f)
            ->select("DATE_FORMAT(penduduk.created_at, '%Y-%m') as periode, COUNT(*) as total", false)
            ->where('penduduk.created_at IS NOT NULL', null, false)
            ->groupBy("DATE_FORMAT(penduduk.created_at, '%Y-%m')", false)
            ->orderBy('periode', 'asc')
            ->get()->getResultArray();

        // frontend bisa slice sendiri, tapi kita bantu ambil range terakhir
        if (count($rows) > $range) {
            $rows = array_slice($rows, -$range);
        }

        return $this->response->setJSON(['status' => true, 'data' => $rows]);
    }

    /* =========================
       HELPERS
    ========================= */

    private function filters(): array
    {
        return [
            'dusun_id'    => $this->request->getGet('dusun_id'),
            'rt_id'       => $this->request->getGet('rt_id'),
            'jk'          => $this->request->getGet('jk'),
            'agama_id'    => $this->request->getGet('agama_id'),
            'pendidikan_id' => $this->request->getGet('pendidikan_id'),
            'pekerjaan_id'  => $this->request->getGet('pekerjaan_id'),
            'status_dasar'  => $this->request->getGet('status_dasar'),
            'status_penduduk' => $this->request->getGet('status_penduduk'),
        ];
    }

    private function basePenduduk(array $f)
    {
        $b = $this->db->table('penduduk')
            ->where('penduduk.deleted_at', null);

        // filter wilayah (sesuai struktur kamu: rt.id_dusun)
        if (!empty($f['dusun_id'])) {
            $b->join('rt', 'rt.id = penduduk.rt_id', 'left')
                ->where('rt.id_dusun', (int)$f['dusun_id']);
        }
        if (!empty($f['rt_id'])) {
            $b->where('penduduk.rt_id', (int)$f['rt_id']);
        }

        if (!empty($f['jk'])) $b->where('penduduk.jenis_kelamin', (string)$f['jk']);
        if (!empty($f['agama_id'])) $b->where('penduduk.agama_id', (int)$f['agama_id']);
        if (!empty($f['pendidikan_id'])) $b->where('penduduk.pendidikan_id', (int)$f['pendidikan_id']);
        if (!empty($f['pekerjaan_id'])) $b->where('penduduk.pekerjaan_id', (int)$f['pekerjaan_id']);
        if (!empty($f['status_dasar'])) $b->where('penduduk.status_dasar', (string)$f['status_dasar']);
        if (!empty($f['status_penduduk'])) $b->where('penduduk.status_penduduk', (string)$f['status_penduduk']);

        return $b;
    }

    private function groupCount(string $field, array $f, array $labelMap = []): array
    {
        $rows = $this->basePenduduk($f)
            ->select("$field as k, COUNT(*) as total", false)
            ->groupBy($field)
            ->orderBy('total', 'desc')
            ->get()->getResultArray();

        $rows = array_map(function ($r) use ($labelMap) {
            $key = $r['k'] ?? null;
            $label = ($key === null || $key === '') ? '(Kosong)' : (string)$key;
            if (isset($labelMap[$label])) $label = $labelMap[$label];

            return [
                'key' => ($key === null || $key === '') ? null : $key,
                'label' => $label,
                'total' => (int)$r['total'],
            ];
        }, $rows);

        return $this->maskSmallBuckets($rows, 'total');
    }

    private function groupCountJoin(string $table, string $on, string $labelField, array $f): array
    {
        $rows = $this->basePenduduk($f)
            ->select("$labelField as label, COUNT(*) as total", false)
            ->join($table, $on, 'left')
            ->groupBy($labelField)
            ->orderBy('total', 'desc')
            ->get()->getResultArray();

        $rows = array_map(function ($r) {
            $label = $r['label'] ?? '(Kosong)';
            return [
                'label' => ($label === null || $label === '') ? '(Kosong)' : $label,
                'total' => (int)$r['total'],
            ];
        }, $rows);

        return $this->maskSmallBuckets($rows, 'total');
    }

    private function ageBuckets(array $f): array
    {
        // bucket default (detail tapi aman)
        $sql = "
            SELECT
              CASE
                WHEN tanggal_lahir IS NULL THEN '(Tanggal Lahir Kosong)'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0  AND 4  THEN '0-4'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 5  AND 9  THEN '5-9'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 10 AND 14 THEN '10-14'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 15 AND 19 THEN '15-19'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 20 AND 24 THEN '20-24'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 25 AND 29 THEN '25-29'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 30 AND 34 THEN '30-34'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 35 AND 39 THEN '35-39'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 40 AND 44 THEN '40-44'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 45 AND 49 THEN '45-49'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 50 AND 54 THEN '50-54'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 55 AND 59 THEN '55-59'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 60 AND 64 THEN '60-64'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 65 AND 69 THEN '65-69'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 70 AND 74 THEN '70-74'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 75 AND 79 THEN '75-79'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 80 AND 84 THEN '80-84'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 85 AND 89 THEN '85-89'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 90 THEN '90+'
                ELSE '(Tidak Valid)'
              END AS bucket,
              COUNT(*) AS total
            FROM penduduk
            WHERE deleted_at IS NULL
        ";

        $where = [];
        $binds = [];

        // filter wilayah, dsb (matching basePenduduk)
        if (!empty($f['rt_id'])) {
            $where[] = "rt_id = ?";
            $binds[] = (int)$f['rt_id'];
        }
        if (!empty($f['jk'])) {
            $where[] = "jenis_kelamin = ?";
            $binds[] = (string)$f['jk'];
        }
        if (!empty($f['agama_id'])) {
            $where[] = "agama_id = ?";
            $binds[] = (int)$f['agama_id'];
        }
        if (!empty($f['pendidikan_id'])) {
            $where[] = "pendidikan_id = ?";
            $binds[] = (int)$f['pendidikan_id'];
        }
        if (!empty($f['pekerjaan_id'])) {
            $where[] = "pekerjaan_id = ?";
            $binds[] = (int)$f['pekerjaan_id'];
        }
        if (!empty($f['status_dasar'])) {
            $where[] = "status_dasar = ?";
            $binds[] = (string)$f['status_dasar'];
        }
        if (!empty($f['status_penduduk'])) {
            $where[] = "status_penduduk = ?";
            $binds[] = (string)$f['status_penduduk'];
        }

        // dusun filter butuh join rt; kita handle simpel dengan subquery
        if (!empty($f['dusun_id'])) {
            $where[] = "rt_id IN (SELECT id FROM rt WHERE id_dusun = ? AND deleted_at IS NULL)";
            $binds[] = (int)$f['dusun_id'];
        }

        if ($where) $sql .= " AND " . implode(" AND ", $where);
        $sql .= " GROUP BY bucket ORDER BY
                    CASE bucket
                      WHEN '0-4' THEN 1 WHEN '5-9' THEN 2 WHEN '10-14' THEN 3 WHEN '15-19' THEN 4
                      WHEN '20-24' THEN 5 WHEN '25-29' THEN 6 WHEN '30-34' THEN 7 WHEN '35-39' THEN 8
                      WHEN '40-44' THEN 9 WHEN '45-49' THEN 10 WHEN '50-54' THEN 11 WHEN '55-59' THEN 12
                      WHEN '60-64' THEN 13 WHEN '65-69' THEN 14 WHEN '70-74' THEN 15 WHEN '75-79' THEN 16
                      WHEN '80-84' THEN 17 WHEN '85-89' THEN 18 WHEN '90+' THEN 19
                      WHEN '(Tanggal Lahir Kosong)' THEN 98 ELSE 99 END ASC
                ";

        $rows = $this->db->query($sql, $binds)->getResultArray();

        $rows = array_map(fn($r) => ['label' => $r['bucket'], 'total' => (int)$r['total']], $rows);

        return $this->maskSmallBuckets($rows, 'total');
    }

    private function ageSingleYears(array $f): array
    {
        $sql = "
          SELECT
            TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) as umur,
            COUNT(*) as total
          FROM penduduk
          WHERE deleted_at IS NULL
            AND tanggal_lahir IS NOT NULL
        ";

        $where = [];
        $binds = [];

        if (!empty($f['rt_id'])) {
            $where[] = "rt_id = ?";
            $binds[] = (int)$f['rt_id'];
        }
        if (!empty($f['jk'])) {
            $where[] = "jenis_kelamin = ?";
            $binds[] = (string)$f['jk'];
        }
        if (!empty($f['dusun_id'])) {
            $where[] = "rt_id IN (SELECT id FROM rt WHERE id_dusun = ? AND deleted_at IS NULL)";
            $binds[] = (int)$f['dusun_id'];
        }

        if ($where) $sql .= " AND " . implode(" AND ", $where);

        $sql .= " GROUP BY umur ORDER BY umur ASC";

        $rows = $this->db->query($sql, $binds)->getResultArray();
        $rows = array_map(fn($r) => ['umur' => (int)$r['umur'], 'total' => (int)$r['total']], $rows);

        return $this->maskSmallBuckets($rows, 'total');
    }

    private function ageAggregates(array $f): array
    {
        // avg + min + max + median (median aproksimasi pakai percentile_cont tidak ada di MySQL lama)
        // fallback: return avg/min/max dan p50 aproksimasi via order + limit.
        $base = $this->basePenduduk($f);

        // avg/min/max
        $row = $base->select("
                COUNT(*) as total,
                AVG(TIMESTAMPDIFF(YEAR, penduduk.tanggal_lahir, CURDATE())) as avg_age,
                MIN(TIMESTAMPDIFF(YEAR, penduduk.tanggal_lahir, CURDATE())) as min_age,
                MAX(TIMESTAMPDIFF(YEAR, penduduk.tanggal_lahir, CURDATE())) as max_age
            ", false)
            ->where('penduduk.tanggal_lahir IS NOT NULL', null, false)
            ->get()->getRowArray();

        $total = (int)($row['total'] ?? 0);

        // median aproksimasi: ambil umur di posisi tengah
        $median = null;
        if ($total > 0) {
            $offset = (int) floor(($total - 1) / 2);
            $medianRow = $this->basePenduduk($f)
                ->select("TIMESTAMPDIFF(YEAR, penduduk.tanggal_lahir, CURDATE()) as age", false)
                ->where('penduduk.tanggal_lahir IS NOT NULL', null, false)
                ->orderBy('age', 'asc')
                ->limit(1, $offset)
                ->get()->getRowArray();
            $median = isset($medianRow['age']) ? (int)$medianRow['age'] : null;
        }

        return [
            'count_with_birthdate' => $total,
            'avg_age' => isset($row['avg_age']) ? round((float)$row['avg_age'], 2) : null,
            'min_age' => isset($row['min_age']) ? (int)$row['min_age'] : null,
            'max_age' => isset($row['max_age']) ? (int)$row['max_age'] : null,
            'median_age_approx' => $median,
        ];
    }

    private function dataCompleteness(array $f): array
    {
        $row = $this->basePenduduk($f)
            ->select("
          COUNT(*) as total,

          /* tanggal_lahir: aman untuk strict (tanpa literal '0000-00-00') */
          SUM(
            CASE
              WHEN penduduk.tanggal_lahir IS NULL THEN 1
              WHEN NULLIF(penduduk.tanggal_lahir, 0) IS NULL THEN 1
              ELSE 0
            END
          ) as null_tanggal_lahir,

          SUM(CASE WHEN penduduk.agama_id IS NULL THEN 1 ELSE 0 END) as null_agama,
          SUM(CASE WHEN penduduk.pendidikan_id IS NULL THEN 1 ELSE 0 END) as null_pendidikan,
          SUM(CASE WHEN penduduk.pekerjaan_id IS NULL THEN 1 ELSE 0 END) as null_pekerjaan,
          SUM(CASE WHEN penduduk.rt_id IS NULL THEN 1 ELSE 0 END) as null_rt,
          SUM(CASE WHEN penduduk.golongan_darah IS NULL OR penduduk.golongan_darah = '' THEN 1 ELSE 0 END) as null_goldar
        ", false)
            ->get()->getRowArray();

        $total = (int)($row['total'] ?? 0);
        if ($total <= 0) $total = 1;

        $make = function ($nullCount) use ($total) {
            $nullCount = (int)$nullCount;
            return [
                'null' => $nullCount,
                'filled' => max(0, $total - $nullCount),
                'null_pct' => round(($nullCount / $total) * 100, 2),
                'filled_pct' => round((($total - $nullCount) / $total) * 100, 2),
            ];
        };

        return [
            'tanggal_lahir' => $make($row['null_tanggal_lahir'] ?? 0),
            'agama'         => $make($row['null_agama'] ?? 0),
            'pendidikan'    => $make($row['null_pendidikan'] ?? 0),
            'pekerjaan'     => $make($row['null_pekerjaan'] ?? 0),
            'rt'            => $make($row['null_rt'] ?? 0),
            'gol_darah'     => $make($row['null_goldar'] ?? 0),
        ];
    }



    private function maskSmallBuckets(array $rows, string $countKey): array
    {
        // Ubah angka kecil jadi string "<5" (atau sesuai minBucket)
        return array_map(function ($r) use ($countKey) {
            if (!isset($r[$countKey])) return $r;
            $n = (int)$r[$countKey];
            if ($n > 0 && $n < $this->minBucket) {
                $r[$countKey] = '<' . $this->minBucket;
                $r['_masked'] = true;
            } else {
                $r[$countKey] = $n;
                $r['_masked'] = false;
            }
            return $r;
        }, $rows);
    }
}
