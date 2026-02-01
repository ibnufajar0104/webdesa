<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PendudukSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $db = \Config\Database::connect();

        // Get limits for foreign keys
        $agama = $db->table('master_agama')->select('id')->get()->getResultArray();
        $pekerjaan = $db->table('master_pekerjaan')->select('id')->get()->getResultArray();
        $pendidikan = $db->table('master_pendidikan')->select('id')->get()->getResultArray();
        $rt = $db->table('rt')->select('id')->get()->getResultArray();

        $agamaIds = array_column($agama, 'id');
        $pekerjaanIds = array_column($pekerjaan, 'id');
        $pendidikanIds = array_column($pendidikan, 'id');
        $rtIds = array_column($rt, 'id');

        $data = [];
        for ($i = 0; $i < 50; $i++) {
            $gender = $faker->randomElement(['L', 'P']);
            $data[] = [
                'nik'               => $faker->nik(),
                'no_kk'             => $faker->nik(), // Using nik generator for KK as well for dummy
                'nama_lengkap'      => $faker->name($gender == 'L' ? 'male' : 'female'),
                'jenis_kelamin'     => $gender,
                'tempat_lahir'      => $faker->city,
                'tanggal_lahir'     => $faker->date('Y-m-d', '-17 years'),
                'golongan_darah'    => $faker->randomElement(['A', 'B', 'AB', 'O', '-']),
                'agama_id'          => !empty($agamaIds) ? $faker->randomElement($agamaIds) : 1,
                'status_perkawinan' => $faker->randomElement(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']),
                'pendidikan_id'     => !empty($pendidikanIds) ? $faker->randomElement($pendidikanIds) : 1,
                'pekerjaan_id'      => !empty($pekerjaanIds) ? $faker->randomElement($pekerjaanIds) : 1,
                'kewarganegaraan'   => 'WNI',
                'status_penduduk'   => 'Tetap',
                'status_dasar'      => 'Hidup',
                'rt_id'             => !empty($rtIds) ? $faker->randomElement($rtIds) : 1,
                'alamat'            => $faker->address,
                'desa'              => 'Batilai',
                'kecamatan'         => 'Takisung',
                'no_hp'             => $faker->phoneNumber,
                'is_active'         => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ];
        }

        // Using chunks to avoid memory issues if size increases
        $this->db->table('penduduk')->insertBatch($data);
    }
}
