<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePerangkatPendidikanHistory extends Migration
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
            'pendidikan_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'nama_lembaga' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'jurusan' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'tahun_masuk' => [
                'type'       => 'SMALLINT',
                'constraint' => 4,
                'null'       => true,
            ],
            'tahun_lulus' => [
                'type'       => 'SMALLINT',
                'constraint' => 4,
                'null'       => true,
            ],
            'ijazah_file' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true, // misal 'ijazah/xxx.pdf'
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

        $this->forge->createTable('perangkat_pendidikan_history');
    }

    public function down()
    {
        $this->forge->dropTable('perangkat_pendidikan_history');
    }
}
