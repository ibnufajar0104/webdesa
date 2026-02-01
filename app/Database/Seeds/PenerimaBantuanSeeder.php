<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PenerimaBantuanSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $db = \Config\Database::connect();

        // Get available IDs
        $penduduk = $db->table('penduduk')->select('id')->limit(50)->get()->getResultArray(); // Limit to recent/sample
        $bantuan = $db->table('master_bantuan')->select('id')->get()->getResultArray();

        if (empty($penduduk) || empty($bantuan)) {
            return;
        }

        $pendudukIds = array_column($penduduk, 'id');
        // $bantuanIds = array_column($bantuan, 'id');
        // User requested only specific IDs
        $bantuanIds = [1, 2, 3];

        $data = [];
        // Generate random recipients (Increased to 50 as requested 'lagi')
        for ($i = 0; $i < 50; $i++) {
            $tahun = $faker->randomElement([date('Y'), date('Y')-1]);
            
            $data[] = [
                'penduduk_id'    => $faker->randomElement($pendudukIds),
                'bantuan_id'     => $faker->randomElement($bantuanIds),
                'tahun'          => $tahun,
                'periode'        => $faker->randomElement(['Januari', 'Februari', 'Maret', 'Tahap 1', 'Tahap 2', 'Triwulan 1']),
                'tanggal_terima' => $faker->date("$tahun-12-31"),
                'nominal'        => $faker->randomElement([300000, 600000, 900000, 1200000]),
                'status'         => 1,
                'keterangan'     => $faker->sentence(3),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ];
        }

        $db->table('penerima_bantuan')->insertBatch($data);
    }
}
