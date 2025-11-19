<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJamPelayanan extends Migration
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
            'hari' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'jam_mulai' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'jam_selesai' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
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
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('jam_pelayanan', true);

        // Seed data dummy
        $this->db->table('jam_pelayanan')->insert([
            'hari'        => 'Senin - Jumat',
            'jam_mulai'   => '08:00 WITA',
            'jam_selesai' => '15:00 WITA',
            'keterangan'  => 'Istirahat pukul 12:00 - 13:00 WITA',
            'is_active'   => 1,
            'created_at'  => date('Y-m-d H:i:s'),
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('jam_pelayanan', true);
    }
}
