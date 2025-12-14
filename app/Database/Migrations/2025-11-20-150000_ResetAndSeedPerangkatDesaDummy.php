<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ResetAndSeedPerangkatDesaDummy extends Migration
{
    public function up()
    {
        // ============================
        // 0. BERSIHKAN DATA LAMA
        // ============================
        // WARNING: ini akan mengosongkan semua data di 3 tabel ini
        $this->db->table('perangkat_pendidikan_history')->truncate();
        $this->db->table('perangkat_jabatan_history')->truncate();
        $this->db->table('perangkat_desa')->truncate();

        $now = date('Y-m-d H:i:s');

        // ==========================================
        // 1. AMBIL MASTER PENDIDIKAN & MASTER JABATAN
        // ==========================================
        $pendidikanRows = $this->db->table('master_pendidikan')
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->orderBy('urut', 'ASC')
            ->get()
            ->getResultArray();

        $jabatanRows = $this->db->table('master_jabatan')
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->orderBy('urut', 'ASC')
            ->get()
            ->getResultArray();

        // Kalau master kosong, hentikan (supaya migration tidak error)
        if (empty($pendidikanRows) || empty($jabatanRows)) {
            return;
        }

        $pendidikanIds = array_column($pendidikanRows, 'id');
        $jabatanIds    = array_column($jabatanRows, 'id');

        // ============================
        // 2. INSERT 20 PERANGKAT DESA
        // ============================
        $perangkatTable = $this->db->table('perangkat_desa');
        $perangkatData  = [];

        for ($i = 1; $i <= 20; $i++) {
            $gender = $i % 2 === 0 ? 'P' : 'L';

            // pilih pendidikan & jabatan aktif secara siklis
            $pendIdxAktif = ($i - 1) % count($pendidikanIds);
            $jabIdxAktif  = ($i - 1) % count($jabatanIds);

            $pendAktifId = $pendidikanIds[$pendIdxAktif];
            $jabAktifId  = $jabatanIds[$jabIdxAktif];

            $tmtJabatan  = (2018 + ($i % 5)) . '-01-01';

            $perangkatData[] = [
                'nama'          => "Perangkat Desa {$i}",
                'nip'           => '19800101' . str_pad((string) $i, 8, '0', STR_PAD_LEFT),
                'nik'           => '637101' . str_pad((string) $i, 10, '0', STR_PAD_LEFT),
                'jenis_kelamin' => $gender,
                'jabatan_id'    => $jabAktifId,      // jabatan aktif
                'pendidikan_id' => $pendAktifId,     // pendidikan terakhir aktif
                'tmt_jabatan'   => $tmtJabatan,
                'status_aktif'  => 1,
                'no_hp'         => '0822' . str_pad((string) $i, 7, '0', STR_PAD_LEFT),
                'email'         => "perangkat{$i}@batilai.desa.id",
                'alamat'        => "Jl. Contoh No. {$i}, Batilai",
                'foto_file'     => null,
                'created_at'    => $now,
                'updated_at'    => $now,
                'deleted_at'    => null,
            ];
        }

        if (!empty($perangkatData)) {
            $perangkatTable->insertBatch($perangkatData);
        }

        // Ambil kembali perangkat yang baru diinsert
        $perangkatRows = $this->db->table('perangkat_desa')
            ->like('nama', 'Perangkat Desa ', 'after')
            ->orderBy('id', 'ASC')
            ->get()
            ->getResultArray();

        if (empty($perangkatRows)) {
            return;
        }

        // ==============================
        // 3. BUAT HISTORY PENDIDIKAN
        // ==============================
        $pendHistTable = $this->db->table('perangkat_pendidikan_history');
        $jabHistTable  = $this->db->table('perangkat_jabatan_history');

        $pendHistData = [];
        $jabHistData  = [];

        foreach ($perangkatRows as $row) {
            $perangkatId = $row['id'];
            $nama        = $row['nama']; // "Perangkat Desa X"

            // Coba ambil angka X di belakang nama untuk variasi
            $parts   = explode(' ', $nama);
            $last    = end($parts);
            $nomor   = is_numeric($last) ? (int) $last : $perangkatId;

            // indeks siklis lagi
            $pendIdxAktif = ($nomor - 1) % count($pendidikanIds);
            $jabIdxAktif  = ($nomor - 1) % count($jabatanIds);

            $pendAktifId = $pendidikanIds[$pendIdxAktif];
            $jabAktifId  = $jabatanIds[$jabIdxAktif];

            // ---------- 2 riwayat pendidikan ----------
            // Riwayat 1 (lama)
            $tahunLulus1 = 2008 + ($nomor % 5);
            $tahunMasuk1 = $tahunLulus1 - 3;

            $pendHistData[] = [
                'perangkat_id'  => $perangkatId,
                'pendidikan_id' => $pendidikanIds[($pendIdxAktif + 1) % count($pendidikanIds)],
                'nama_lembaga'  => 'SMA Negeri Contoh ' . (($nomor % 3) + 1),
                'jurusan'       => 'IPA',
                'tahun_masuk'   => $tahunMasuk1,
                'tahun_lulus'   => $tahunLulus1,
                'ijazah_file'   => null,
                'created_at'    => $now,
                'updated_at'    => $now,
                'deleted_at'    => null,
            ];

            // Riwayat 2 (terakhir / sesuai kolom pendidikan_id perangkat)
            $tahunLulus2 = 2012 + ($nomor % 5);
            $tahunMasuk2 = $tahunLulus2 - 4;

            $pendHistData[] = [
                'perangkat_id'  => $perangkatId,
                'pendidikan_id' => $pendAktifId,
                'nama_lembaga'  => 'Universitas Negeri Contoh ' . (($nomor % 4) + 1),
                'jurusan'       => 'Ilmu Pemerintahan',
                'tahun_masuk'   => $tahunMasuk2,
                'tahun_lulus'   => $tahunLulus2,
                'ijazah_file'   => null,
                'created_at'    => $now,
                'updated_at'    => $now,
                'deleted_at'    => null,
            ];

            // ---------- 2 riwayat jabatan ----------
            // Riwayat 1 (jabatan sebelumnya, sudah selesai)
            $tahunMulai1   = 2015 + ($nomor % 3);
            $tahunSelesai1 = $tahunMulai1 + 2;

            $tmtMulai1   = $tahunMulai1 . '-01-01';
            $tmtSelesai1 = $tahunSelesai1 . '-12-31';

            $jabHistData[] = [
                'perangkat_id' => $perangkatId,
                'jabatan_id'   => $jabatanIds[($jabIdxAktif + 1) % count($jabatanIds)],
                'nama_unit'    => 'Pemerintah Desa Batilai',
                'sk_nomor'     => 'SK-LAMA-' . $perangkatId,
                'sk_tanggal'   => $tmtMulai1,
                'tmt_mulai'    => $tmtMulai1,
                'tmt_selesai'  => $tmtSelesai1,
                'sk_file'      => null,
                'keterangan'   => 'Jabatan sebelumnya',
                'created_at'   => $now,
                'updated_at'   => $now,
                'deleted_at'   => null,
            ];

            // Riwayat 2 (jabatan sekarang, sama dengan jabatan_id di perangkat_desa)
            $tahunMulai2 = 2018 + ($nomor % 4);
            $tmtMulai2   = $tahunMulai2 . '-01-01';

            $jabHistData[] = [
                'perangkat_id' => $perangkatId,
                'jabatan_id'   => $jabAktifId,
                'nama_unit'    => 'Pemerintah Desa Batilai',
                'sk_nomor'     => 'SK-AKTIF-' . $perangkatId,
                'sk_tanggal'   => $tmtMulai2,
                'tmt_mulai'    => $tmtMulai2,
                'tmt_selesai'  => null, // masih aktif
                'sk_file'      => null,
                'keterangan'   => 'Jabatan aktif',
                'created_at'   => $now,
                'updated_at'   => $now,
                'deleted_at'   => null,
            ];
        }

        if (!empty($pendHistData)) {
            $pendHistTable->insertBatch($pendHistData);
        }

        if (!empty($jabHistData)) {
            $jabHistTable->insertBatch($jabHistData);
        }
    }

    public function down()
    {
        // Hanya hapus dummy "Perangkat Desa X" dan history terkait

        $perangkatRows = $this->db->table('perangkat_desa')
            ->like('nama', 'Perangkat Desa ', 'after')
            ->get()
            ->getResultArray();

        if (empty($perangkatRows)) {
            return;
        }

        $ids = array_column($perangkatRows, 'id');

        // Hapus history yang terkait
        $this->db->table('perangkat_pendidikan_history')
            ->whereIn('perangkat_id', $ids)
            ->delete();

        $this->db->table('perangkat_jabatan_history')
            ->whereIn('perangkat_id', $ids)
            ->delete();

        // Hapus perangkat dummy
        $this->db->table('perangkat_desa')
            ->whereIn('id', $ids)
            ->delete();
    }
}
