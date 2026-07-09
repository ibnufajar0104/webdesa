<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropRtRwForeignKey extends Migration
{
    public function up()
    {
        $this->forge->dropForeignKey('rt', 'rt_rw_id_foreign');
    }

    public function down()
    {
        $this->db->query("ALTER TABLE `rt` ADD CONSTRAINT `rt_rw_id_foreign` FOREIGN KEY (`rw_id`) REFERENCES `rw` (`id`) ON DELETE CASCADE ON UPDATE CASCADE");
    }
}
