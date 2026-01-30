<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNamaKadesToSambutan extends Migration
{
    public function up()
    {
        $fields = [
            'nama_kades' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
                'after'      => 'judul', // Place after 'judul' for cleaner structure
            ],
        ];

        $this->forge->addColumn('sambutan_kades', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('sambutan_kades', 'nama_kades');
    }
}
