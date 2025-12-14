<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
// use App\Models\PendudukModel;
// use App\Models\BeritaModel;
// use App\Models\PageModel;
// use App\Models\PerangkatDesaModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // Nanti bisa dihubungkan ke model beneran
        $data = [
            'pageTitle'       => 'Dashboard',
            'activeMenu'      => 'dashboard',
            'totalPenduduk'   => $this->getTotalPenduduk(),
            'totalBerita'     => $this->getTotalBerita(),
            'totalHalaman'    => $this->getTotalHalaman(),
            'totalPerangkat'  => $this->getTotalPerangkat(),
            'latestBerita'    => $this->getLatestBerita(),
        ];

        return view('admin/dashboard/index', $data);
    }

    private function getTotalPenduduk(): int
    {
        // $model = new PendudukModel();
        // return $model->where('deleted_at', null)->countAllResults();
        return 0; // placeholder
    }

    private function getTotalBerita(): int
    {
        // $model = new BeritaModel();
        // return $model->where('deleted_at', null)->countAllResults();
        return 0;
    }

    private function getTotalHalaman(): int
    {
        // $model = new PageModel();
        // return $model->where('deleted_at', null)->countAllResults();
        return 0;
    }

    private function getTotalPerangkat(): int
    {
        // $model = new PerangkatDesaModel();
        // return $model->where('deleted_at', null)->countAllResults();
        return 0;
    }

    private function getLatestBerita(): array
    {
        // Contoh struktur. Nanti ganti query asli.
        return [
            // [
            //     'id'        => 1,
            //     'judul'     => 'Contoh Berita Pertama',
            //     'ringkasan' => 'Ini contoh ringkasan singkat berita pertama...',
            //     'penulis'   => 'Admin Web Desa',
            //     'tanggal'   => '2025-11-20',
            // ],
        ];
    }
}
