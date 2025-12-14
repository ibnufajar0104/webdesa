<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePerangkatJabatanHistory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'perangkat_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'jabatan_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'nama_unit' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true, // misal: "Pemerintah Desa Batilai"
            ],
            'sk_nomor' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'sk_tanggal' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'tmt_mulai' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'tmt_selesai' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'sk_file' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true, // misal 'sk/xxx.pdf'
            ],
            'keterangan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
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
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('perangkat_id');
        $this->forge->addKey('jabatan_id');

        $this->forge->createTable('perangkat_jabatan_history');
    }

    public function down()
    {
        $this->forge->dropTable('perangkat_jabatan_history');
    }
}
