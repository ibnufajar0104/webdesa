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
$routes->group('file', static function ($routes) {
    $routes->get('pages/(:any)', 'FileHandler::pages/$1');
    $routes->get('news/(:any)',  'FileHandler::news/$1');
    $routes->get('ktp/(:any)',   'FileHandler::ktp/$1');
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
});
