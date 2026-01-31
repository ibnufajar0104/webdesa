<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Statistik extends Controller
{
    /**
     * Halaman Statistik Penduduk
     * Endpoints consumed:
     * - /api/penduduk/stats/overview
     * - /api/penduduk/stats/wilayah (dusun & rt)
     * - /api/penduduk/stats/tren (year & month)
     * - /api/penduduk/stats/kk
     */
    public function penduduk()
    {
        // 1. Overview
        $overview = $this->fetch('api/penduduk/stats/overview');

        // 2. Wilayah
        $wilayah = [
            'dusun' => $this->fetch('api/penduduk/stats/wilayah?level=dusun'),
            'rt'    => $this->fetch('api/penduduk/stats/wilayah?level=rt')
        ];

        // 3. Tren
        $rangeTahun = (int)($this->request->getGet('range_tahun') ?? 5);
        $rangeBulan = (int)($this->request->getGet('range_bulan') ?? 24);

        $tren = [
            'tahun' => $this->fetch("api/penduduk/stats/tren?by=year&range={$rangeTahun}"),
            'bulan' => $this->fetch("api/penduduk/stats/tren?by=month&range={$rangeBulan}")
        ];

        // 4. KK
        $kk = $this->fetch('api/penduduk/stats/kk');

        $data = [
            'title'      => 'Statistik Penduduk',
            'overview'   => $overview,
            'wilayah'    => $wilayah,
            'tren'       => $tren,
            'kk'         => $kk,
            'rangeTahun' => $rangeTahun,
            'rangeBulan' => $rangeBulan,
        ];

        return view('frontend/statistik/penduduk', $data);
    }

    /**
     * Halaman Statistik Penerima Bantuan
     * Endpoints consumed:
     * - /api/penerima-bantuan/stats/overview
     * - /api/penerima-bantuan/stats/by-bantuan
     */
    public function bantuan()
    {
        // 1. Overview
        $overview = $this->fetch('api/penerima-bantuan/stats/overview');

        // 2. By Bantuan Type
        $byBantuan = $this->fetch('api/penerima-bantuan/stats/by-bantuan');

        $data = [
            'title'     => 'Statistik Penerima Bantuan',
            'overview'  => $overview,
            'byBantuan' => $byBantuan
        ];

        return view('frontend/statistik/bantuan', $data);
    }

    /**
     * AJAX Endpoint for Chart Data
     * GET /statistik/tren-data?by=year&range=5
     */
    public function tren_data()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid Request']);
        }

        $by    = $this->request->getGet('by') ?? 'year';
        $range = (int)($this->request->getGet('range') ?? 5);

        // Fetch data
        $data = $this->fetch("api/penduduk/stats/tren?by={$by}&range={$range}");

        return $this->response->setJSON($data);
    }

    // --------------------------------------------------------------------
    
    /**
     * Helper to fetch data safely from internal API
     */
    private function fetch(string $path): array
    {
        $client = \Config\Services::curlrequest();
        $baseUrl = base_url(); 

        try {
            $response = $client->get($baseUrl . $path, [
                'timeout' => 5,
                'http_errors' => false
            ]);
            
            if ($response->getStatusCode() === 200) {
                $json = json_decode($response->getBody(), true);
                return $json['data'] ?? [];
            }
        } catch (\Exception $e) {
            log_message('error', "Failed to fetch stats from {$path}: " . $e->getMessage());
        }
        return [];
    }
}
