<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Galeri extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        // 1. Ambil Parameter Filter
        $page     = $this->request->getGet('page') ?? 1;
        $perPage  = $this->request->getGet('per_page') ?? 12; // Default 12 for grid (3x4 or 4x3)

        // 2. Siapkan Client HTTP
        $client = \Config\Services::curlrequest();
        $apiUrl = base_url('api/gallery');

        try {
            // 3. Request ke API Gallery
            $response = $client->request('GET', $apiUrl, [
                'query' => [
                    'page'     => $page,
                    'per_page' => $perPage,
                ],
                'http_errors' => false
            ]);

            $body = json_decode($response->getBody(), true);
            $gallery = $body['data'] ?? [];
            $meta    = $body['meta'] ?? [];

        } catch (\Exception $e) {
            log_message('error', 'API Gallery Error: ' . $e->getMessage());
            $gallery = [];
            $meta    = [];
        }

        $data = [
            'title'      => 'Galeri Kegiatan',
            'gallery'    => $gallery,
            'pager_meta' => $meta
        ];

        return view('frontend/galeri/index', $data);
    }
}
