<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],

            'parent_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true
            ],

            'label' => [
                'type'       => 'VARCHAR',
                'constraint' => 150
            ],

            'url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
            ],

            'is_header' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0
            ],

            'sort_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0
            ],

            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1
            ],

            // opsional: publik / admin / desa
            'roles' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true
            ],

            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('parent_id');
        $this->forge->createTable('menus', true);
    }

    public function down()
    {
        $this->forge->dropTable('menus', true);
    }
}
