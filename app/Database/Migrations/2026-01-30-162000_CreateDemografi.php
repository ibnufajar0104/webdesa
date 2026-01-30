<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDemografi extends Migration
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
            'jarak_ke_kabupaten' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
            ],
            'luas_wilayah' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
            ],
            'kepadatan' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
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
        $this->forge->createTable('demografi', true);

        // Seed initial data (optional, but good for single-row setup)
        // $this->db->table('demografi')->insert([
        //     'jarak_ke_kabupaten' => 0,
        //     'luas_wilayah'       => 0,
        //     'kepadatan'          => 0,
        //     'created_at'         => date('Y-m-d H:i:s'),
        // ]);
    }

    public function down()
    {
        $this->forge->dropTable('demografi', true);
    }
}
