<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =======================
// FRONT
// =======================
$routes->get('/', 'Home::index');

// =======================
// FILE HANDLER
// =======================
// routes file handler
$routes->group('file', static function ($routes) {
    $routes->get('pages/(:any)',    'FileHandler::pages/$1');
    $routes->get('news/(:any)',     'FileHandler::news/$1');
    $routes->get('banner/(:any)',   'FileHandler::banner/$1');
    $routes->get('ktp/(:any)',      'FileHandler::ktp/$1');
    $routes->get('perangkat/(:any)', 'FileHandler::perangkat/$1');
    $routes->get('ijazah/(:any)',   'FileHandler::ijazah/$1');
    $routes->get('sk/(:any)',       'FileHandler::sk/$1');
});



// =======================
// ADMIN
// =======================
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {

    // DASHBOARD
    $routes->get('dashboard', 'Dashboard::index');

    // =======================
    // KONTEN SITUS
    // =======================

    // Halaman Statis
    $routes->group('halaman-statis', static function ($routes) {
        $routes->get('/',             'HalamanStatis::index');
        $routes->post('datatable',    'HalamanStatis::datatable');

        $routes->get('create',        'HalamanStatis::create');
        $routes->get('edit/(:num)',   'HalamanStatis::edit/$1');
        $routes->post('save',         'HalamanStatis::save');

        $routes->post('delete',       'HalamanStatis::delete');
        $routes->post('upload-image', 'HalamanStatis::uploadImage');
    });

    // Berita
    $routes->group('berita', static function ($routes) {
        $routes->get('/',           'Berita::index');
        $routes->post('datatable',  'Berita::datatable');

        $routes->get('create',      'Berita::create');
        $routes->get('edit/(:num)', 'Berita::edit/$1');
        $routes->post('save',       'Berita::save');

        $routes->post('delete',     'Berita::delete');
    });

    // =======================
    // DATA PENDUDUK
    // =======================
    $routes->group('data-penduduk', static function ($routes) {
        $routes->get('/',             'Penduduk::index');
        $routes->post('datatable',    'Penduduk::datatable');

        $routes->get('create',        'Penduduk::create');
        $routes->get('edit/(:num)',   'Penduduk::edit/$1');
        $routes->get('detail/(:num)', 'Penduduk::detail/$1');

        $routes->post('save',         'Penduduk::save');
        $routes->post('delete',       'Penduduk::delete');
    });

    // =======================
    // MASTER DATA
    // =======================

    // Master Pendidikan
    // =======================
    // MASTER DATA
    // =======================
    $routes->group('master-pendidikan', static function ($routes) {
        $routes->get('/',           'MasterPendidikan::index');
        $routes->post('datatable',  'MasterPendidikan::datatable');
        $routes->post('save',       'MasterPendidikan::save');
        $routes->post('delete',     'MasterPendidikan::delete');
    });



    // Master Pekerjaan
    $routes->group('master-pekerjaan', static function ($routes) {
        $routes->get('/',           'MasterPekerjaan::index');
        $routes->post('datatable',  'MasterPekerjaan::datatable');
        $routes->post('save',       'MasterPekerjaan::save');
        $routes->post('delete',     'MasterPekerjaan::delete');
    });


    // Master Agama
    $routes->group('master-agama', static function ($routes) {
        $routes->get('/',           'MasterAgama::index');
        $routes->post('datatable',  'MasterAgama::datatable');
        $routes->post('save',       'MasterAgama::save');
        $routes->post('delete',     'MasterAgama::delete');
    });


    // Master Jabatan
    $routes->group('master-jabatan', static function ($routes) {
        $routes->get('/',           'MasterJabatan::index');
        $routes->post('datatable',  'MasterJabatan::datatable');
        $routes->post('save',       'MasterJabatan::save');
        $routes->post('delete',     'MasterJabatan::delete');
    });


    // Sambutan Kepala Desa
    $routes->group('sambutan-kades', static function ($routes) {
        $routes->get('/',      'SambutanKades::index');
        $routes->post('save',  'SambutanKades::save');
    });

    // Jam Pelayanan
    $routes->group('jam-pelayanan', static function ($routes) {
        $routes->get('/',      'JamPelayanan::index');
        $routes->post('save',  'JamPelayanan::save');
    });


    $routes->group('kontak', static function ($routes) {
        $routes->get('/',     'Kontak::index');
        $routes->post('save', 'Kontak::save');
    });


    // Banner
    $routes->group('banner', static function ($routes) {
        $routes->get('/',           'Banner::index');
        $routes->post('datatable',  'Banner::datatable');

        $routes->get('create',      'Banner::create');
        $routes->get('edit/(:num)', 'Banner::edit/$1');
        $routes->post('save',       'Banner::save');

        $routes->post('delete',     'Banner::delete');
    });


    // =======================
    // PERANGKAT DESA
    // =======================
    $routes->group('perangkat-desa', static function ($routes) {
        $routes->get('/',             'PerangkatDesa::index');
        $routes->post('datatable',    'PerangkatDesa::datatable');

        $routes->get('create',        'PerangkatDesa::create');
        $routes->get('edit/(:num)',   'PerangkatDesa::edit/$1');
        $routes->get('detail/(:num)', 'PerangkatDesa::detail/$1');

        $routes->post('save',         'PerangkatDesa::save');
        $routes->post('delete',       'PerangkatDesa::delete');

        // CRUD Riwayat Pendidikan
        $routes->post('pendidikan/save',   'PerangkatDesa::savePendidikanHistory');
        $routes->post('pendidikan/delete', 'PerangkatDesa::deletePendidikanHistory');

        // CRUD Riwayat Jabatan
        $routes->post('jabatan/save',   'PerangkatDesa::saveJabatanHistory');
        $routes->post('jabatan/delete', 'PerangkatDesa::deleteJabatanHistory');
    });


    // Master RT
    $routes->group('master-rt', static function ($routes) {
        $routes->get('/',           'MasterRt::index');
        $routes->post('datatable',  'MasterRt::datatable');
        $routes->post('save',       'MasterRt::save');
        $routes->post('delete',     'MasterRt::delete');
        $routes->post('dusun-options', 'MasterRt::dusunOptions');
    });
});
