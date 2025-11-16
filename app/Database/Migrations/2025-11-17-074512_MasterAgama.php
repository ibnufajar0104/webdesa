<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MasterAgama extends Migration
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
            'nama_agama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'kode_agama' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'urut' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('master_agama', true);

        // Insert data default
        $data = [
            ['nama_agama' => 'Islam',    'kode_agama' => '01', 'urut' => 1, 'is_active' => 1],
            ['nama_agama' => 'Kristen',  'kode_agama' => '02', 'urut' => 2, 'is_active' => 1],
            ['nama_agama' => 'Katolik',  'kode_agama' => '03', 'urut' => 3, 'is_active' => 1],
            ['nama_agama' => 'Hindu',    'kode_agama' => '04', 'urut' => 4, 'is_active' => 1],
            ['nama_agama' => 'Buddha',   'kode_agama' => '05', 'urut' => 5, 'is_active' => 1],
            ['nama_agama' => 'Konghucu', 'kode_agama' => '06', 'urut' => 6, 'is_active' => 1],
        ];

        $this->db->table('master_agama')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('master_agama', true);
    }
}
