<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MasterBantuanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_bantuan' => 'BLT Dana Desa',
                'urut'         => 1,
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_bantuan' => 'PKH (Program Keluarga Harapan)',
                'urut'         => 2,
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_bantuan' => 'BPNT (Bantuan Pangan Non Tunai)',
                'urut'         => 3,
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_bantuan' => 'BST (Bantuan Sosial Tunai)',
                'urut'         => 4,
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_bantuan' => 'Bedah Rumah',
                'urut'         => 5,
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        // Check if data exists to avoid duplicates on multiple runs
        $db = \Config\Database::connect();
        $builder = $db->table('master_bantuan');
        
        foreach ($data as $row) {
            $exists = $builder->where('nama_bantuan', $row['nama_bantuan'])->countAllResults();
            if ($exists == 0) {
                $builder->insert($row);
            }
        }
    }
}
