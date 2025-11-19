<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKontakDesa extends Migration
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
            'alamat' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'whatsapp' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'comment'    => 'Nomor WA format internasional, contoh: 628xxxxxxxxxx',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
                'null'       => true,
            ],
            'website' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'link_maps' => [
                'type'       => 'TEXT',
                'null'       => true,
                'comment'    => 'URL Google Maps / embed link',
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
        $this->forge->createTable('kontak_desa', true);

        // Dummy awal
        $this->db->table('kontak_desa')->insert([
            'alamat'     => "Kantor Desa Batilai\nKecamatan Batulicin\nKabupaten Tanah Laut, Kalimantan Selatan",
            'telepon'    => '0512-123456',
            'whatsapp'   => '6281234567890',
            'email'      => 'desabatilai@example.com',
            'website'    => 'https://desabatilai.go.id',
            'link_maps'  => 'https://maps.google.com/?q=Desa+Batilai',
            'is_active'  => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('kontak_desa', true);
    }
}
