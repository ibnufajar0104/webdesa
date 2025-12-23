<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDokumenTables extends Migration
{
    public function up()
    {
        /**
         * =========================================================
         * TABLE: dokumen_kategori
         * =========================================================
         */
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 160,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'urutan' => [
                'type'       => 'INT',
                'constraint' => 11,
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
        $this->forge->addUniqueKey('slug', 'uk_dokumen_kategori_slug');
        $this->forge->addKey(['is_active', 'urutan'], false, false, 'idx_dokumen_kategori_active_urutan');

        $this->forge->createTable('dokumen_kategori', true, [
            'ENGINE'  => 'InnoDB',
            'DEFAULT CHARACTER SET' => 'utf8mb4',
            'COLLATE' => 'utf8mb4_unicode_ci',
        ]);

        /**
         * =========================================================
         * TABLE: dokumen
         * =========================================================
         */
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kategori_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 220,
                'null'       => true, // boleh null kalau kamu belum pakai slug dokumen
            ],
            'nomor' => [
                'type'       => 'VARCHAR',
                'constraint' => 80,
                'null'       => true,
            ],
            'tahun' => [
                'type'       => 'SMALLINT',
                'constraint' => 5,
                'null'       => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'ringkasan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'file_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'mime' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'size' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'views' => [
                'type'       => 'INT',
                'constraint' => 11,
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
        $this->forge->addKey('kategori_id', false, false, 'idx_dokumen_kategori');
        $this->forge->addKey('tahun', false, false, 'idx_dokumen_tahun');
        $this->forge->addKey(['is_active', 'tanggal'], false, false, 'idx_dokumen_active_tanggal');

        // Unique slug dokumen (kalau slug null, MySQL mengizinkan banyak NULL)
        $this->forge->addUniqueKey('slug', 'uk_dokumen_slug');

        // Foreign key
        $this->forge->addForeignKey(
            'kategori_id',
            'dokumen_kategori',
            'id',
            'CASCADE',
            'RESTRICT',
            'fk_dokumen_kategori'
        );

        $this->forge->createTable('dokumen', true, [
            'ENGINE'  => 'InnoDB',
            'DEFAULT CHARACTER SET' => 'utf8mb4',
            'COLLATE' => 'utf8mb4_unicode_ci',
        ]);

        /**
         * =========================================================
         * OPTIONAL: TABLE dokumen_file (lampiran multi-file)
         * (Uncomment kalau kamu butuh banyak file per dokumen)
         * =========================================================
         */
        /*
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'dokumen_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],
            'label' => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
                'null'       => true,
            ],
            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'file_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'mime' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'size' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('dokumen_id', false, false, 'idx_dokumen_file_dokumen');
        $this->forge->addForeignKey('dokumen_id', 'dokumen', 'id', 'CASCADE', 'RESTRICT', 'fk_dokumen_file_dokumen');

        $this->forge->createTable('dokumen_file', true, [
            'ENGINE'  => 'InnoDB',
            'DEFAULT CHARACTER SET' => 'utf8mb4',
            'COLLATE' => 'utf8mb4_unicode_ci',
        ]);
        */
    }

    public function down()
    {
        // OPTIONAL table (kalau kamu aktifkan)
        // $this->forge->dropTable('dokumen_file', true);

        $this->forge->dropTable('dokumen', true);
        $this->forge->dropTable('dokumen_kategori', true);
    }
}
