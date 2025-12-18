<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        // =========================
        // MAPPING: sesuaikan kalau beda
        // =========================
        $T = [
            'penduduk'   => 'penduduk',
            'rt'         => 'rt',
            'dusun'      => 'dusun',

            'berita'     => 'news',
            'galery'     => 'galery',
            'banner'     => 'banners',
            'halaman'    => 'pages',
            'perangkat'  => 'perangkat_desa',
            'penerima'   => 'penerima_bantuan',
            'pengguna'   => 'users',

            // master
            'pendidikan' => 'master_pendidikan',
            'pekerjaan'  => 'master_pekerjaan',
            'agama'      => 'master_agama',
            'T_bantuan' => 'master_bantuan',

        ];

        $C = [
            // soft delete umum
            'deleted_at' => 'deleted_at',
            'created_at' => 'created_at',

            // penduduk (relasi & kolom utama)
            'penduduk_rt_fk'      => 'rt_id',
            'penduduk_jk'         => 'jenis_kelamin',   // L / P

            // penduduk tambahan statistik
            'penduduk_pendidikan' => 'pendidikan_id',
            'penduduk_pekerjaan'  => 'pekerjaan_id',
            'penduduk_agama'      => 'agama_id',
            'penduduk_status'     => 'status_penduduk', // enum: Tetap/Pendatang
            'penduduk_statusdas'  => 'status_dasar',    // enum: Hidup/Meninggal/Pindah/Hilang
            'penduduk_tgl_lahir'  => 'tanggal_lahir',

            // RT
            'rt_dusun_fk' => 'id_dusun',
            'rt_label'    => 'nama_rt', // opsional

            // Dusun
            'nama_dusun'  => 'nama_dusun',

            // master label
            'pendidikan_label' => 'nama_pendidikan',
            'pekerjaan_label'  => 'nama_pekerjaan',
            'agama_label'      => 'nama_agama',

            // berita/galeri (untuk latest list)
            'berita_title' => 'judul',
            'berita_date'  => 'published_at', // kalau tidak ada pakai created_at
            'galery_title' => 'judul',
            'galery_file'  => 'file',         // atau foto_file/gambar
            // penerima bantuan
            'penerima_bantuan_fk' => 'bantuan_id',   // fk di penerima_bantuan
            // master bantuan
            'bantuan_nama'        => 'nama_bantuan', // kolom nama di master_bantuan (sesuaikan)

        ];

        // helper: count soft delete friendly
        $countTable = function (string $table) use ($C) {
            $b = $this->db->table($table);
            try {
                $b->where($C['deleted_at'], null);
            } catch (\Throwable $e) {
            }
            return (int) $b->countAllResults();
        };

        // =========================
        // STAT CARDS
        // =========================
        $stats = [
            'dusun'      => $countTable($T['dusun']),
            'rt'         => $countTable($T['rt']),
            'penduduk'   => $countTable($T['penduduk']),
            'perangkat'  => $countTable($T['perangkat']),
            'penerima'   => $countTable($T['penerima']),
            'berita'     => $countTable($T['berita']),
            'galery'     => $countTable($T['galery']),
            'banner'     => $countTable($T['banner']),
            'halaman'    => $countTable($T['halaman']),
            'pengguna'   => $countTable($T['pengguna']),
        ];

        // =========================
        // CHART: Penduduk per JK
        // =========================
        $chartJK = ['labels' => ['Laki-laki', 'Perempuan'], 'values' => [0, 0]];

        try {
            $rows = $this->db->table($T['penduduk'])
                ->select("{$C['penduduk_jk']} AS jk, COUNT(*) AS total")
                ->where($C['deleted_at'], null)
                ->groupBy($C['penduduk_jk'])
                ->get()->getResultArray();

            $map = ['L' => 0, 'P' => 0];
            foreach ($rows as $r) {
                $jk = strtoupper((string)($r['jk'] ?? ''));
                if (isset($map[$jk])) $map[$jk] = (int)($r['total'] ?? 0);
            }
            $chartJK['values'] = [$map['L'], $map['P']];
        } catch (\Throwable $e) {
        }

        // =========================
        // CHART: Penduduk per Dusun (via RT)
        // penduduk -> rt -> dusun
        // =========================
        $chartDusun = ['labels' => [], 'values' => []];

        try {
            $rows = $this->db->table($T['penduduk'] . ' p')
                ->select("d.{$C['nama_dusun']} AS dusun, COUNT(*) AS total")
                ->join($T['rt'] . ' r', "r.id = p.{$C['penduduk_rt_fk']}", 'left')
                ->join($T['dusun'] . ' d', "d.id = r.{$C['rt_dusun_fk']}", 'left')
                ->where('p.' . $C['deleted_at'], null)
                ->groupBy("d.{$C['nama_dusun']}")
                ->orderBy('total', 'DESC')
                ->limit(10)
                ->get()->getResultArray();

            foreach ($rows as $r) {
                $chartDusun['labels'][] = $r['dusun'] ?: '(Tanpa Dusun)';
                $chartDusun['values'][] = (int)($r['total'] ?? 0);
            }
        } catch (\Throwable $e) {
        }

        // =========================
        // CHART: Penduduk per Pendidikan (Top 10)
        // =========================
        $chartPendidikan = ['labels' => [], 'values' => []];
        try {
            $rows = $this->db->table($T['penduduk'] . ' p')
                ->select("mp.{$C['pendidikan_label']} AS label, COUNT(*) AS total")
                ->join($T['pendidikan'] . ' mp', "mp.id = p.{$C['penduduk_pendidikan']}", 'left')
                ->where('p.' . $C['deleted_at'], null)
                ->groupBy("mp.{$C['pendidikan_label']}")
                ->orderBy('total', 'DESC')
                ->limit(10)
                ->get()->getResultArray();

            foreach ($rows as $r) {
                $chartPendidikan['labels'][] = $r['label'] ?: '(Tidak diisi)';
                $chartPendidikan['values'][] = (int)($r['total'] ?? 0);
            }
        } catch (\Throwable $e) {
        }

        // =========================
        // CHART: Penduduk per Pekerjaan (Top 10)
        // =========================
        $chartPekerjaan = ['labels' => [], 'values' => []];
        try {
            $rows = $this->db->table($T['penduduk'] . ' p')
                ->select("mk.{$C['pekerjaan_label']} AS label, COUNT(*) AS total")
                ->join($T['pekerjaan'] . ' mk', "mk.id = p.{$C['penduduk_pekerjaan']}", 'left')
                ->where('p.' . $C['deleted_at'], null)
                ->groupBy("mk.{$C['pekerjaan_label']}")
                ->orderBy('total', 'DESC')
                ->limit(10)
                ->get()->getResultArray();

            foreach ($rows as $r) {
                $chartPekerjaan['labels'][] = $r['label'] ?: '(Tidak diisi)';
                $chartPekerjaan['values'][] = (int)($r['total'] ?? 0);
            }
        } catch (\Throwable $e) {
        }

        // =========================
        // CHART: Penduduk per Agama
        // =========================
        $chartAgama = ['labels' => [], 'values' => []];
        try {
            $rows = $this->db->table($T['penduduk'] . ' p')
                ->select("ma.{$C['agama_label']} AS label, COUNT(*) AS total")
                ->join($T['agama'] . ' ma', "ma.id = p.{$C['penduduk_agama']}", 'left')
                ->where('p.' . $C['deleted_at'], null)
                ->groupBy("ma.{$C['agama_label']}")
                ->orderBy('total', 'DESC')
                ->get()->getResultArray();

            foreach ($rows as $r) {
                $chartAgama['labels'][] = $r['label'] ?: '(Tidak diisi)';
                $chartAgama['values'][] = (int)($r['total'] ?? 0);
            }
        } catch (\Throwable $e) {
        }

        // =========================
        // CHART: Status Penduduk (Tetap/Pendatang)
        // =========================
        $chartStatusPenduduk = ['labels' => ['Tetap', 'Pendatang'], 'values' => [0, 0]];
        try {
            $rows = $this->db->table($T['penduduk'])
                ->select("{$C['penduduk_status']} AS st, COUNT(*) AS total")
                ->where($C['deleted_at'], null)
                ->groupBy($C['penduduk_status'])
                ->get()->getResultArray();

            $map = ['Tetap' => 0, 'Pendatang' => 0];
            foreach ($rows as $r) {
                $st = (string)($r['st'] ?? '');
                if (isset($map[$st])) $map[$st] = (int)($r['total'] ?? 0);
            }
            $chartStatusPenduduk['values'] = [$map['Tetap'], $map['Pendatang']];
        } catch (\Throwable $e) {
        }

        // =========================
        // CHART: Status Dasar
        // =========================
        $chartStatusDasar = [
            'labels' => ['Hidup', 'Meninggal', 'Pindah', 'Hilang'],
            'values' => [0, 0, 0, 0]
        ];
        try {
            $rows = $this->db->table($T['penduduk'])
                ->select("{$C['penduduk_statusdas']} AS st, COUNT(*) AS total")
                ->where($C['deleted_at'], null)
                ->groupBy($C['penduduk_statusdas'])
                ->get()->getResultArray();

            $map = ['Hidup' => 0, 'Meninggal' => 0, 'Pindah' => 0, 'Hilang' => 0];
            foreach ($rows as $r) {
                $st = (string)($r['st'] ?? '');
                if (isset($map[$st])) $map[$st] = (int)($r['total'] ?? 0);
            }
            $chartStatusDasar['values'] = [$map['Hidup'], $map['Meninggal'], $map['Pindah'], $map['Hilang']];
        } catch (\Throwable $e) {
        }

        // =========================
        // CHART: Umur (bucket)
        // =========================
        $chartUmur = [
            'labels' => ['0-5', '6-12', '13-17', '18-25', '26-35', '36-45', '46-60', '60+'],
            'values' => [0, 0, 0, 0, 0, 0, 0, 0],
        ];

        try {
            $rows = $this->db->table($T['penduduk'])
                ->select("{$C['penduduk_tgl_lahir']} AS tgl")
                ->where($C['deleted_at'], null)
                ->where("{$C['penduduk_tgl_lahir']} IS NOT NULL", null, false)
                ->get()->getResultArray();

            $now = new \DateTime('today');

            foreach ($rows as $r) {
                $tgl = $r['tgl'] ?? null;
                if (!$tgl) continue;

                try {
                    $dob = new \DateTime($tgl);
                } catch (\Throwable $e) {
                    continue;
                }

                $age = (int) $dob->diff($now)->y;

                if ($age <= 5) $chartUmur['values'][0]++;
                elseif ($age <= 12) $chartUmur['values'][1]++;
                elseif ($age <= 17) $chartUmur['values'][2]++;
                elseif ($age <= 25) $chartUmur['values'][3]++;
                elseif ($age <= 35) $chartUmur['values'][4]++;
                elseif ($age <= 45) $chartUmur['values'][5]++;
                elseif ($age <= 60) $chartUmur['values'][6]++;
                else $chartUmur['values'][7]++;
            }
        } catch (\Throwable $e) {
        }

        // =========================
        // LATEST: Berita (5)
        // =========================
        $latestBerita = [];
        try {
            $latestBerita = $this->db->table($T['berita'])
                ->select("id, {$C['berita_title']} AS title, {$C['berita_date']} AS tanggal")
                ->where($C['deleted_at'], null)
                ->orderBy($C['berita_date'], 'DESC')
                ->limit(5)
                ->get()->getResultArray();
        } catch (\Throwable $e) {
        }

        // =========================
        // LATEST: Galery (6)
        // =========================
        $latestGalery = [];
        try {
            $latestGalery = $this->db->table($T['galery'])
                ->select("id, {$C['galery_title']} AS title, {$C['galery_file']} AS file, {$C['created_at']} AS created_at")
                ->where($C['deleted_at'], null)
                ->orderBy($C['created_at'], 'DESC')
                ->limit(6)
                ->get()->getResultArray();
        } catch (\Throwable $e) {
        }


        // =========================
        // CHART: Penerima Bantuan per Jenis Bantuan
        // penerima_bantuan -> master_bantuan
        // =========================
        $chartBantuan = ['labels' => [], 'values' => []];

        try {
            $rows = $this->db->table($T['penerima'] . ' pb')
                ->select("mb.{$C['bantuan_nama']} AS bantuan, COUNT(*) AS total")
                ->join($T['T_bantuan'] . ' mb', "mb.id = pb.{$C['penerima_bantuan_fk']}", 'left')
                ->where('pb.' . $C['deleted_at'], null)
                ->groupBy("mb.{$C['bantuan_nama']}")
                ->orderBy('total', 'DESC')
                ->limit(10)
                ->get()->getResultArray();

            foreach ($rows as $r) {
                $chartBantuan['labels'][] = $r['bantuan'] ?: '(Bantuan tidak diketahui)';
                $chartBantuan['values'][] = (int)($r['total'] ?? 0);
            }
        } catch (\Throwable $e) {
            // kalau struktur kolom beda, biarkan kosong dulu
        }


        return view('admin/dashboard/index', [
            'pageTitle'            => 'Dashboard',
            'activeMenu'           => 'dashboard',

            'stats'                => $stats,

            'chartJK'              => $chartJK,
            'chartDusun'           => $chartDusun,
            'chartPendidikan'      => $chartPendidikan,
            'chartPekerjaan'       => $chartPekerjaan,
            'chartAgama'           => $chartAgama,
            'chartStatusPenduduk'  => $chartStatusPenduduk,
            'chartStatusDasar'     => $chartStatusDasar,
            'chartUmur'            => $chartUmur,
            'chartBantuan' => $chartBantuan,
            'latestBerita'         => $latestBerita,
            'latestGalery'         => $latestGalery,
        ]);
    }
}
