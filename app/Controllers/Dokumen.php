<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Dokumen extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        // 1. Ambil Parameter Filter dari query string
        $page     = $this->request->getGet('page') ?? 1;
        $perPage  = $this->request->getGet('per_page') ?? 10;
        $kategori = $this->request->getGet('kategori') ?? '';
        $keyword  = $this->request->getGet('q') ?? '';

        // 2. Siapkan Client HTTP (Internal Request)
        $client = \Config\Services::curlrequest();

        // 3. Request ke API Dokumen List
        //    Kita gunakan full URL localhost/api/... atau base_url()
        //    Tapi karena ini request internal server yg sama, pastikan port/domain benar.
        //    Agar aman, gunakan base_url() yg sudah diset di .env/App.php
        
        $apiUrl = base_url('api/dokumen');
        // Jika ada search, mungkin api-nya beda endpoint? 
        // Cek Api\Dokumen.php: 
        // index() -> filter kategori & tahun
        // search() -> cari keyword
        
        // Logika: 
        // Jika ada 'q', tembak /api/dokumen/search
        // Jika tidak, tembak /api/dokumen
        
        $queryParams = [
            'page'     => $page,
            'per_page' => $perPage,
        ];

        if ($kategori) {
            $queryParams['kategori'] = $kategori;
        }

        try {
            if ($keyword) {
                // Endpoint Search
                $apiUrl = base_url('api/dokumen/search');
                $queryParams['q'] = $keyword;
            } else {
                // Endpoint List biasa
                // Cek apakah controller API support filter kategori di index?
                // code: if ($kategoriSlug !== '') ... support!
            }

            // Execute Request Dokumen
             $response = $client->request('GET', $apiUrl, [
                'query' => $queryParams,
                'http_errors' => false // Supaya tidak throw exception kalau 404/400
            ]);

            $body = json_decode($response->getBody(), true);
            $documents = $body['data'] ?? [];
            $meta      = $body['meta'] ?? [];
            
            // 4. Request ke API Kategori (untuk Sidebar)
            //    Endpoint: /api/dokumen-kategori
            $catResponse = $client->request('GET', base_url('api/dokumen-kategori'), [
                 'query' => ['per_page' => 100], // ambil banyak sekalian
                 'http_errors' => false
            ]);
            $catBody = json_decode($catResponse->getBody(), true);
            $categories = $catBody['data'] ?? [];


        } catch (\Exception $e) {
            // Fallback jika API error / server down
            log_message('error', 'API Dokumen Error: ' . $e->getMessage());
            $documents  = [];
            $categories = [];
            $meta       = [];
        }

        $data = [
            'title'      => 'Dokumen Publik',
            'documents'  => $documents,
            'categories' => $categories,
            'pager_meta' => $meta,
            'keyword'    => $keyword,
            'curr_cat'   => $kategori
        ];

        return view('frontend/dokumen/index', $data);
    }
}
