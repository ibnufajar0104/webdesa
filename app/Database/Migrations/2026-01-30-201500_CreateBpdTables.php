<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBpdTables extends Migration
{
    public function up()
    {
        // 1. Table bpd
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],

            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'jenis_kelamin' => [
                'type'       => 'CHAR',
                'constraint' => 1, // L/P
                'null'       => true,
            ],
            'jabatan_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
            ],
            'pendidikan_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
            ],
            'tmt_jabatan' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'status_aktif' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1, // 1 = aktif, 0 = non-aktif
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'foto_file' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true, // disimpan misal: 'bpd/xxxx.jpg'
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
        $this->forge->createTable('bpd');

        // 2. Table bpd_jabatan_history
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'perangkat_id' => [ // Maps to bpd.id
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
                'null'       => true,
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
                'null'       => true,
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
        $this->forge->createTable('bpd_jabatan_history');

        // 3. Table bpd_pendidikan_history
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'perangkat_id' => [ // Maps to bpd.id
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
        $this->forge->createTable('bpd_pendidikan_history');
    }

    public function down()
    {
        $this->forge->dropTable('bpd');
        $this->forge->dropTable('bpd_jabatan_history');
        $this->forge->dropTable('bpd_pendidikan_history');
    }
}
