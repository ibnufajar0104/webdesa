<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSambutanKades extends Migration
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
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'isi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'foto_kades' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
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
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('sambutan_kades', true);

        // Data dummy awal
        $this->db->table('sambutan_kades')->insert([
            'judul'      => 'Sambutan Kepala Desa Batilai',
            'isi'        => "Assalamualaikum warahmatullahi wabarakatuh,\n\nSelamat datang di website resmi Desa Batilai. Melalui media ini kami berharap informasi terkait pemerintahan desa, pelayanan, dan kegiatan masyarakat dapat tersampaikan dengan baik kepada seluruh warga.\n\nMari bersama-sama kita bangun Desa Batilai menjadi desa yang maju, mandiri, dan sejahtera.\n\nWassalamualaikum warahmatullahi wabarakatuh.",
            'foto_kades' => null, // nanti diisi lewat upload
            'is_active'  => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('sambutan_kades', true);
    }
}
