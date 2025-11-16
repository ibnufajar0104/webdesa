<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePendudukAndMasters extends Migration
{
    public function up()
    {
        /**
         * 1. TABEL DUSUN
         */
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_dusun' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'kode_dusun' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('dusun', true);

        // Dummy dusun
        $this->db->table('dusun')->insertBatch([
            ['nama_dusun' => 'Dusun I',   'kode_dusun' => 'D001'],
            ['nama_dusun' => 'Dusun II',  'kode_dusun' => 'D002'],
            ['nama_dusun' => 'Dusun III', 'kode_dusun' => 'D003'],
        ]);

        /**
         * 2. TABEL RW
         */
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'dusun_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],
            'no_rw' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('dusun_id', 'dusun', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rw', true);

        // Dummy RW (mengasumsikan id dusun: 1,2,3 dari insert di atas)
        $this->db->table('rw')->insertBatch([
            // Dusun I (id=1)
            ['dusun_id' => 1, 'no_rw' => 1],
            ['dusun_id' => 1, 'no_rw' => 2],
            // Dusun II (id=2)
            ['dusun_id' => 2, 'no_rw' => 1],
            ['dusun_id' => 2, 'no_rw' => 2],
            // Dusun III (id=3)
            ['dusun_id' => 3, 'no_rw' => 1],
        ]);

        /**
         * 3. TABEL RT
         */
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'rw_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],
            'no_rt' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('rw_id', 'rw', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rt', true);

        // Dummy RT (mengasumsikan id RW berurutan dari insert RW)
        $this->db->table('rt')->insertBatch([
            // RW 1 Dusun I
            ['rw_id' => 1, 'no_rt' => 1],
            ['rw_id' => 1, 'no_rt' => 2],
            ['rw_id' => 1, 'no_rt' => 3],

            // RW 2 Dusun I
            ['rw_id' => 2, 'no_rt' => 1],
            ['rw_id' => 2, 'no_rt' => 2],

            // RW 1 Dusun II
            ['rw_id' => 3, 'no_rt' => 1],
            ['rw_id' => 3, 'no_rt' => 2],

            // RW 2 Dusun II
            ['rw_id' => 4, 'no_rt' => 1],

            // RW 1 Dusun III
            ['rw_id' => 5, 'no_rt' => 1],
            ['rw_id' => 5, 'no_rt' => 2],
        ]);

        /**
         * 4. MASTER PENDIDIKAN
         */
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_pendidikan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'kode_pendidikan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'urut' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('master_pendidikan', true);

        $this->db->table('master_pendidikan')->insertBatch([
            ['nama_pendidikan' => 'Tidak/Belum Sekolah', 'kode_pendidikan' => '00', 'urut' => 1],
            ['nama_pendidikan' => 'SD/Sederajat',        'kode_pendidikan' => '01', 'urut' => 2],
            ['nama_pendidikan' => 'SMP/Sederajat',       'kode_pendidikan' => '02', 'urut' => 3],
            ['nama_pendidikan' => 'SMA/Sederajat',       'kode_pendidikan' => '03', 'urut' => 4],
            ['nama_pendidikan' => 'Diploma I/II',        'kode_pendidikan' => '04', 'urut' => 5],
            ['nama_pendidikan' => 'Diploma III',         'kode_pendidikan' => '05', 'urut' => 6],
            ['nama_pendidikan' => 'Diploma IV/S1',       'kode_pendidikan' => '06', 'urut' => 7],
            ['nama_pendidikan' => 'S2',                  'kode_pendidikan' => '07', 'urut' => 8],
            ['nama_pendidikan' => 'S3',                  'kode_pendidikan' => '08', 'urut' => 9],
        ]);

        /**
         * 5. MASTER PEKERJAAN
         */
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'kode_pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'urut' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('master_pekerjaan', true);

        $this->db->table('master_pekerjaan')->insertBatch([
            ['nama_pekerjaan' => 'Belum/Tidak Bekerja',   'kode_pekerjaan' => '001', 'urut' => 1],
            ['nama_pekerjaan' => 'Pelajar/Mahasiswa',     'kode_pekerjaan' => '002', 'urut' => 2],
            ['nama_pekerjaan' => 'Ibu Rumah Tangga',      'kode_pekerjaan' => '003', 'urut' => 3],
            ['nama_pekerjaan' => 'Petani/Pekebun',        'kode_pekerjaan' => '004', 'urut' => 4],
            ['nama_pekerjaan' => 'Buruh Tani/Buruh Harian', 'kode_pekerjaan' => '005', 'urut' => 5],
            ['nama_pekerjaan' => 'Pedagang/Wiraswasta',   'kode_pekerjaan' => '006', 'urut' => 6],
            ['nama_pekerjaan' => 'PNS/ASN',               'kode_pekerjaan' => '007', 'urut' => 7],
            ['nama_pekerjaan' => 'TNI/Polri',             'kode_pekerjaan' => '008', 'urut' => 8],
            ['nama_pekerjaan' => 'Pensiunan',             'kode_pekerjaan' => '009', 'urut' => 9],
            ['nama_pekerjaan' => 'Lainnya',               'kode_pekerjaan' => '999', 'urut' => 99],
        ]);

        /**
         * 6. TABEL PENDUDUK
         */
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nik' => [
                'type'       => 'CHAR',
                'constraint' => 16,
            ],
            'no_kk' => [
                'type'       => 'CHAR',
                'constraint' => 16,
                'null'       => true,
            ],
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'jenis_kelamin' => [
                'type'       => "ENUM('L','P')",
                'default'    => 'L',
            ],
            'tempat_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal_lahir' => [
                'type' => 'DATE',
            ],
            'golongan_darah' => [
                'type'       => "ENUM('A','B','AB','O','-')",
                'null'       => true,
            ],

            // Kependudukan
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'status_perkawinan' => [
                'type'       => "ENUM('Belum Kawin','Kawin','Cerai Hidup','Cerai Mati')",
                'default'    => 'Belum Kawin',
            ],
            'pendidikan_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => true,
            ],
            'pekerjaan_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => true,
            ],
            'kewarganegaraan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'WNI',
            ],
            'status_penduduk' => [
                'type'       => "ENUM('Tetap','Pendatang')",
                'default'    => 'Tetap',
            ],
            'status_dasar' => [
                'type'       => "ENUM('Hidup','Meninggal','Pindah','Hilang')",
                'default'    => 'Hidup',
            ],

            // Alamat sampai kecamatan + RT master
            'rt_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => true,
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'desa' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'kecamatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],

            // Kontak
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],

            // Upload KTP (opsional)
            'ktp_file' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            // Meta
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('nik');
        $this->forge->addKey('no_kk');
        $this->forge->addKey('nama_lengkap');
        $this->forge->addKey('status_penduduk');
        $this->forge->addKey('status_dasar');
        $this->forge->addForeignKey('rt_id', 'rt', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('pendidikan_id', 'master_pendidikan', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('pekerjaan_id', 'master_pekerjaan', 'id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('penduduk', true);
    }

    public function down()
    {
        // urutan drop: anak dulu baru induk
        $this->forge->dropTable('penduduk', true);
        $this->forge->dropTable('rt', true);
        $this->forge->dropTable('rw', true);
        $this->forge->dropTable('dusun', true);
        $this->forge->dropTable('master_pendidikan', true);
        $this->forge->dropTable('master_pekerjaan', true);
    }
}
