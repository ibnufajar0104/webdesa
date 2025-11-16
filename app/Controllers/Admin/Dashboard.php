<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // Sementara statistik dummy
        $statistik = [
            'penduduk'  => 1234,
            'berita'    => 12,
            'perangkat' => 8,
        ];

        return view('admin/dashboard', [
            'pageTitle'  => 'Dashboard',
            'activeMenu' => 'dashboard',
            'statistik'  => $statistik,
        ]);
    }
}
