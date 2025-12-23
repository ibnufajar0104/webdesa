<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =======================
// FRONT
// =======================

// AUTH (PUBLIC)
$routes->get('login',  'Auth::login');
$routes->post('login', 'Auth::attempt');
$routes->get('logout', 'Auth::logout');

// / langsung ke login
$routes->get('/', static fn() => redirect()->to(site_url('login')));

// =======================
// FILE HANDLER
// =======================
$routes->group('file', static function ($routes) {
    $routes->get('pages/(:any)',     'FileHandler::pages/$1');
    $routes->get('news/(:any)',      'FileHandler::news/$1');
    $routes->get('banner/(:any)',    'FileHandler::banner/$1');
    $routes->get('ktp/(:any)',       'FileHandler::ktp/$1');
    $routes->get('perangkat/(:any)', 'FileHandler::perangkat/$1');
    $routes->get('ijazah/(:any)',    'FileHandler::ijazah/$1');
    $routes->get('sk/(:any)',        'FileHandler::sk/$1');
    $routes->get('galery/(:any)',    'FileHandler::galery/$1');
    $routes->get('dokumen/(:any)',   'FileHandler::dokumen/$1');
});

// =======================
// ADMIN (PROTECTED)
// =======================
$routes->group('admin', [
    'namespace' => 'App\Controllers\Admin',
    'filter'    => 'auth',
], static function ($routes) {

    // DASHBOARD
    $routes->get('dashboard', 'Dashboard::index');

    // PROFILE (dedup: cukup satu)
    $routes->get('profile', 'Pengguna::profile');

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

    // Data Penduduk
    $routes->group('data-penduduk', static function ($routes) {
        $routes->get('/',             'Penduduk::index');
        $routes->post('datatable',    'Penduduk::datatable');
        $routes->get('create',        'Penduduk::create');
        $routes->get('edit/(:num)',   'Penduduk::edit/$1');
        $routes->get('detail/(:num)', 'Penduduk::detail/$1');
        $routes->post('save',         'Penduduk::save');
        $routes->post('delete',       'Penduduk::delete');
    });

    // Master Pendidikan
    $routes->group('master-pendidikan', static function ($routes) {
        $routes->get('/',          'MasterPendidikan::index');
        $routes->post('datatable', 'MasterPendidikan::datatable');
        $routes->post('save',      'MasterPendidikan::save');
        $routes->post('delete',    'MasterPendidikan::delete');
    });

    // Master Pekerjaan
    $routes->group('master-pekerjaan', static function ($routes) {
        $routes->get('/',          'MasterPekerjaan::index');
        $routes->post('datatable', 'MasterPekerjaan::datatable');
        $routes->post('save',      'MasterPekerjaan::save');
        $routes->post('delete',    'MasterPekerjaan::delete');
    });

    // Master Agama
    $routes->group('master-agama', static function ($routes) {
        $routes->get('/',          'MasterAgama::index');
        $routes->post('datatable', 'MasterAgama::datatable');
        $routes->post('save',      'MasterAgama::save');
        $routes->post('delete',    'MasterAgama::delete');
    });

    // Master Jabatan
    $routes->group('master-jabatan', static function ($routes) {
        $routes->get('/',          'MasterJabatan::index');
        $routes->post('datatable', 'MasterJabatan::datatable');
        $routes->post('save',      'MasterJabatan::save');
        $routes->post('delete',    'MasterJabatan::delete');
    });

    // Master Dusun
    $routes->group('master-dusun', static function ($routes) {
        $routes->get('/',          'MasterDusun::index');
        $routes->post('datatable', 'MasterDusun::datatable');
        $routes->post('save',      'MasterDusun::save');
        $routes->post('delete',    'MasterDusun::delete');
    });

    // Sambutan Kades
    $routes->group('sambutan-kades', static function ($routes) {
        $routes->get('/',     'SambutanKades::index');
        $routes->post('save', 'SambutanKades::save');
    });

    // Jam Pelayanan (ambil versi lengkap: datatable + save + delete)
    $routes->group('jam-pelayanan', static function ($routes) {
        $routes->get('/',          'JamPelayanan::index');
        $routes->post('datatable', 'JamPelayanan::datatable');
        $routes->post('save',      'JamPelayanan::save');
        $routes->post('delete',    'JamPelayanan::delete');
    });

    // Kontak
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

    // Perangkat Desa
    $routes->group('perangkat-desa', static function ($routes) {
        $routes->get('/',             'PerangkatDesa::index');
        $routes->post('datatable',    'PerangkatDesa::datatable');
        $routes->get('create',        'PerangkatDesa::create');
        $routes->get('edit/(:num)',   'PerangkatDesa::edit/$1');
        $routes->get('detail/(:num)', 'PerangkatDesa::detail/$1');
        $routes->post('save',         'PerangkatDesa::save');
        $routes->post('delete',       'PerangkatDesa::delete');

        $routes->post('pendidikan/save',   'PerangkatDesa::savePendidikanHistory');
        $routes->post('pendidikan/delete', 'PerangkatDesa::deletePendidikanHistory');
        $routes->post('jabatan/save',      'PerangkatDesa::saveJabatanHistory');
        $routes->post('jabatan/delete',    'PerangkatDesa::deleteJabatanHistory');
    });

    // Master RT
    $routes->group('master-rt', static function ($routes) {
        $routes->get('/',              'MasterRt::index');
        $routes->post('datatable',     'MasterRt::datatable');
        $routes->post('save',          'MasterRt::save');
        $routes->post('delete',        'MasterRt::delete');
        $routes->post('dusun-options', 'MasterRt::dusunOptions');
    });

    // RT Identitas
    $routes->group('rt-identitas', static function ($routes) {
        $routes->get('/',           'RtIdentitas::index');
        $routes->post('datatable',  'RtIdentitas::datatable');
        $routes->get('create',      'RtIdentitas::create');
        $routes->get('edit/(:num)', 'RtIdentitas::edit/$1');
        $routes->post('save',       'RtIdentitas::save');
        $routes->post('delete',     'RtIdentitas::delete');
    });

    // Galery
    $routes->group('galery', static function ($routes) {
        $routes->get('/',           'Galery::index');
        $routes->post('datatable',  'Galery::datatable');
        $routes->get('create',      'Galery::create');
        $routes->get('edit/(:num)', 'Galery::edit/$1');
        $routes->post('save',       'Galery::save');
        $routes->post('delete',     'Galery::delete');
    });

    // Penerima Bantuan
    $routes->group('penerima-bantuan', static function ($routes) {
        $routes->get('/',                'PenerimaBantuan::index');
        $routes->post('datatable',       'PenerimaBantuan::datatable');
        $routes->get('create',           'PenerimaBantuan::create');
        $routes->get('edit/(:num)',      'PenerimaBantuan::edit/$1');
        $routes->post('save',            'PenerimaBantuan::save');
        $routes->post('delete',          'PenerimaBantuan::delete');
        $routes->get('penduduk-options', 'PenerimaBantuan::pendudukOptions');
    });

    // Pengguna
    $routes->group('pengguna', static function ($routes) {
        $routes->get('/',             'Pengguna::index');
        $routes->post('datatable',    'Pengguna::datatable');
        $routes->get('create',        'Pengguna::create');
        $routes->get('edit/(:num)',   'Pengguna::edit/$1');
        $routes->post('save',         'Pengguna::save');
        $routes->post('save_profile', 'Pengguna::save_profile');
        $routes->post('delete',       'Pengguna::delete');
    });

    // Manajemen Menu (dedup: reorder dobel dihapus)
    $routes->group('menu', static function ($routes) {
        $routes->get('/',                  'Menu::index');
        $routes->get('(:num)',             'Menu::show/$1');
        $routes->post('save',              'Menu::save');
        $routes->post('reorder',           'Menu::reorder');
        $routes->post('toggle/(:num)',     'Menu::toggle/$1');
        $routes->post('set-active/(:num)', 'Menu::setActive/$1');
        $routes->post('delete/(:num)',     'Menu::delete/$1');
    });

    // Kategori Dokumen
    $routes->group('kategori-dokumen', static function ($routes) {
        $routes->get('/',           'KategoriDokumen::index');
        $routes->post('datatable',  'KategoriDokumen::datatable');
        $routes->get('create',      'KategoriDokumen::create');
        $routes->get('edit/(:num)', 'KategoriDokumen::edit/$1');
        $routes->post('save',       'KategoriDokumen::save');
        $routes->post('delete',     'KategoriDokumen::delete');
    });

    // Dokumen
    $routes->group('dokumen', static function ($routes) {
        $routes->get('/',           'Dokumen::index');
        $routes->post('datatable',  'Dokumen::datatable');
        $routes->get('create',      'Dokumen::create');
        $routes->get('edit/(:num)', 'Dokumen::edit/$1');
        $routes->post('save',       'Dokumen::save');
        $routes->post('delete',     'Dokumen::delete');
    });
});

// =======================
// API (FRONTEND WEBSITE) - BASIC AUTH
// =======================
$routes->group('api', [
    'namespace' => 'App\Controllers\Api',
    'filter'    => 'basicAuth',
], static function ($routes) {
    // NEWS API
    $routes->get('news',            'News::index');       // ?page=&per_page=
    $routes->get('news/latest',     'News::latest');      // ?limit=
    $routes->get('news/search',     'News::search');      // ?q=&page=&per_page=
    $routes->get('news/(:segment)', 'News::show/$1');     // slug

    // BANNER API
    $routes->get('banner',        'Banner::index');       // ?limit=
    $routes->get('banner/(:num)', 'Banner::show/$1');     // id


    $routes->get('pages', 'Pages::index');
    $routes->get('pages/latest', 'Pages::latest');
    $routes->get('pages/search', 'Pages::search');
    $routes->get('pages/(:segment)', 'Pages::show/$1');


    $routes->get('menu', 'Menu::index');
    $routes->get('menu/flat', 'Menu::flat');
    $routes->get('menu/by-parent/(:segment)', 'Menu::byParent/$1');

    $routes->get('gallery', 'Gallery::index');
    $routes->get('gallery/latest', 'Gallery::latest');
    $routes->get('gallery/search', 'Gallery::search');
    $routes->get('gallery/(:num)', 'Gallery::show/$1');


    $routes->get('dokumen-kategori', 'DokumenKategori::index');
    $routes->get('dokumen-kategori/latest', 'DokumenKategori::latest');
    $routes->get('dokumen-kategori/search', 'DokumenKategori::search');
    $routes->get('dokumen-kategori/(:segment)', 'DokumenKategori::show/$1');


    $routes->get('dokumen', 'Dokumen::index');
    $routes->get('dokumen/latest', 'Dokumen::latest');
    $routes->get('dokumen/search', 'Dokumen::search');
    $routes->get('dokumen/(:segment)', 'Dokumen::show/$1');

    $routes->get('penduduk/stats/overview', 'PendudukStats::overview');
    $routes->get('penduduk/stats/wilayah',  'PendudukStats::wilayah'); // ?level=dusun|rt
    $routes->get('penduduk/stats/usia',     'PendudukStats::usia');    // ?mode=bucket|single
    $routes->get('penduduk/stats/tren',     'PendudukStats::tren');    // ?by=month|year&range=24
});
