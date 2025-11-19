<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMasterJabatan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'kode_jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'urut' => [
                'type'       => 'INT',
                'constraint' => 4,
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
        $this->forge->createTable('master_jabatan', true);

        // === Data dummy jabatan perangkat desa ===
        $data = [
            [
                'nama_jabatan' => 'Kepala Desa',
                'kode_jabatan' => 'KADES',
                'urut'         => 1,
                'is_active'    => 1,
            ],
            [
                'nama_jabatan' => 'Sekretaris Desa',
                'kode_jabatan' => 'SEKDES',
                'urut'         => 2,
                'is_active'    => 1,
            ],
            [
                'nama_jabatan' => 'Kaur Umum dan Perencanaan',
                'kode_jabatan' => 'KAUR_UMUM',
                'urut'         => 3,
                'is_active'    => 1,
            ],
            [
                'nama_jabatan' => 'Kaur Keuangan',
                'kode_jabatan' => 'KAUR_KEU',
                'urut'         => 4,
                'is_active'    => 1,
            ],
            [
                'nama_jabatan' => 'Kasi Pemerintahan',
                'kode_jabatan' => 'KASI_PEM',
                'urut'         => 5,
                'is_active'    => 1,
            ],
            [
                'nama_jabatan' => 'Kasi Kesejahteraan',
                'kode_jabatan' => 'KASI_KESRA',
                'urut'         => 6,
                'is_active'    => 1,
            ],
            [
                'nama_jabatan' => 'Kasi Pelayanan',
                'kode_jabatan' => 'KASI_PEL',
                'urut'         => 7,
                'is_active'    => 1,
            ],
            [
                'nama_jabatan' => 'Kepala Dusun I',
                'kode_jabatan' => 'KADUS_1',
                'urut'         => 8,
                'is_active'    => 1,
            ],
            [
                'nama_jabatan' => 'Kepala Dusun II',
                'kode_jabatan' => 'KADUS_2',
                'urut'         => 9,
                'is_active'    => 1,
            ],
            [
                'nama_jabatan' => 'Staf Desa',
                'kode_jabatan' => 'STAF',
                'urut'         => 10,
                'is_active'    => 1,
            ],
        ];

        $this->db->table('master_jabatan')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('master_jabatan', true);
    }
}
