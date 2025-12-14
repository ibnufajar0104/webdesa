<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SeedDummyPerangkatDesa extends Migration
{
    public function up()
    {
        $perangkatTable   = $this->db->table('perangkat_desa');
        $pendHistTable    = $this->db->table('perangkat_pendidikan_history');
        $jabatanHistTable = $this->db->table('perangkat_jabatan_history');

        $now = date('Y-m-d H:i:s');

        // ============================
        // 1. INSERT 20 PERANGKAT DESA
        // ============================
        $perangkatData = [];

        for ($i = 1; $i <= 20; $i++) {
            $gender = $i % 2 === 0 ? 'P' : 'L';

            $perangkatData[] = [
                'nama'     => "Perangkat Desa {$i}",
                'nip'              => '19800101' . str_pad((string) $i, 8, '0', STR_PAD_LEFT),
                'nik'              => '637101' . str_pad((string) $i, 10, '0', STR_PAD_LEFT),
                'jenis_kelamin'    => $gender,

                'alamat'           => "Jl. Contoh No. {$i}, Batilai",
                'no_hp'            => '0822' . str_pad((string) $i, 7, '0', STR_PAD_LEFT),
                'email'            => "perangkat{$i}@batilai.desa.id",
                'jabatan_id' => null, // akan di-update setelah history jabatan dibuat
                'status_aktif'     => 1,
                'foto_file'             => null,
                'created_at'       => $now,
                'updated_at'       => $now,
                'deleted_at'       => null,
            ];
        }

        if (!empty($perangkatData)) {
            $perangkatTable->insertBatch($perangkatData);
        }

        // Ambil kembali perangkat yang baru diinsert (berdasarkan nama)
        $names = array_column($perangkatData, 'nama');

        $perangkatRows = $this->db->table('perangkat_desa')
            ->whereIn('nama', $names)
            ->get()
            ->getResultArray();

        // Map nama -> id
        $perangkatMap = [];
        foreach ($perangkatRows as $row) {
            $perangkatMap[$row['nama']] = $row['id'];
        }

        // ==========================================
        // 2. AMBIL MASTER PENDIDIKAN & MASTER JABATAN
        // ==========================================
        $pendidikanRows = $this->db->table('master_pendidikan')
            ->where('deleted_at', null)
            ->orderBy('urut', 'ASC')
            ->get()
            ->getResultArray();

        $jabatanRows = $this->db->table('master_jabatan')
            ->where('deleted_at', null)
            ->orderBy('urut', 'ASC')
            ->get()
            ->getResultArray();

        // Kalau master kosong, jangan lanjut (biar migration tidak error)
        if (empty($pendidikanRows) || empty($jabatanRows)) {
            return;
        }

        $pendidikanIds = array_column($pendidikanRows, 'id');
        $jabatanIds    = array_column($jabatanRows, 'id');

        // ======================================
        // 3. BUAT HISTORY PENDIDIKAN & JABATAN
        // ======================================
        $pendHistData    = [];
        $jabatanHistData = [];

        $idxPend = 0;
        $idxJab  = 0;

        foreach ($perangkatData as $index => $p) {
            $namaPerangkat = $p['nama'];
            $perangkatId   = $perangkatMap[$namaPerangkat] ?? null;

            if (!$perangkatId) {
                continue;
            }

            // ---------- HISTORY PENDIDIKAN ----------
            // perangkat ganjil = 2 riwayat, genap = 1 riwayat
            $jumlahRiwayatPendidikan = ($index % 2 === 0) ? 2 : 1;

            for ($k = 0; $k < $jumlahRiwayatPendidikan; $k++) {
                $pendId = $pendidikanIds[$idxPend % count($pendidikanIds)];
                $idxPend++;

                // misal: tahun masuk 4 tahun sebelum lulus
                $tahunLulus = 2010 + $k + ($index % 5);
                $tahunMasuk = $tahunLulus - 4;

                $pendHistData[] = [
                    'perangkat_id'  => $perangkatId,
                    'pendidikan_id' => $pendId,
                    'nama_lembaga'  => 'Universitas Negeri Contoh ' . ($k + 1),
                    'jurusan'       => 'Ilmu Pemerintahan',
                    'tahun_masuk'   => $tahunMasuk,   // pastikan kolom ini ada di migration
                    'tahun_lulus'   => $tahunLulus,   // pastikan kolom ini ada di migration
                    'ijazah_file'   => null,

                    'created_at'    => $now,
                    'updated_at'    => $now,
                    'deleted_at'    => null,
                ];
            }

            // ---------- HISTORY JABATAN ----------
            $jumlahRiwayatJabatan = ($index % 2 === 0) ? 1 : 2;
            $tahunMulaiBase       = 2015 + ($index % 5);

            $lastJabatanMasterId = null;

            for ($k = 0; $k < $jumlahRiwayatJabatan; $k++) {
                $jabId = $jabatanIds[$idxJab % count($jabatanIds)];
                $idxJab++;

                $tahunMulai   = $tahunMulaiBase + $k;
                $tahunSelesai = $tahunMulai + 1;

                $tmtMulai   = $tahunMulai . '-01-01';
                $tmtSelesai = ($k === $jumlahRiwayatJabatan - 1)
                    ? null
                    : $tahunSelesai . '-12-31';

                $jabatanHistData[] = [
                    'perangkat_id' => $perangkatId,
                    'jabatan_id'   => $jabId,
                    'nama_unit'    => 'Pemerintah Desa Batilai',
                    'sk_nomor'     => 'SK-' . $perangkatId . '-' . ($k + 1),
                    'sk_tanggal'   => $tmtMulai,
                    'tmt_mulai'    => $tmtMulai,
                    'tmt_selesai'  => $tmtSelesai,
                    'sk_file'      => null,  // belum ada file SK
                    'keterangan'   => '',
                    'created_at'   => $now,
                    'updated_at'   => $now,
                    'deleted_at'   => null,
                ];

                if ($k === $jumlahRiwayatJabatan - 1) {
                    $lastJabatanMasterId = $jabId;
                }
            }

            // Update jabatan_aktif_id di tabel perangkat_desa
            if ($lastJabatanMasterId !== null) {
                $this->db->table('perangkat_desa')
                    ->where('id', $perangkatId)
                    ->update([
                        'jabatan_id' => $lastJabatanMasterId,
                        'updated_at'       => $now,
                    ]);
            }
        }

        if (!empty($pendHistData)) {
            $pendHistTable->insertBatch($pendHistData);
        }

        if (!empty($jabatanHistData)) {
            $jabatanHistTable->insertBatch($jabatanHistData);
        }
    }

    public function down()
    {
        // Hapus dummy berdasarkan pola nama "Perangkat Desa X"
        $rows = $this->db->table('perangkat_desa')
            ->like('nama', 'Perangkat Desa ', 'after')
            ->get()
            ->getResultArray();

        if (empty($rows)) {
            return;
        }

        $ids = array_column($rows, 'id');

        // Hapus history yang terkait
        $this->db->table('perangkat_pendidikan_history')
            ->whereIn('perangkat_id', $ids)
            ->delete();

        $this->db->table('perangkat_jabatan_history')
            ->whereIn('perangkat_id', $ids)
            ->delete();

        // Hapus perangkat
        $this->db->table('perangkat_desa')
            ->whereIn('id', $ids)
            ->delete();
    }
}
