<?php
helper('icon');

$activeMenu = $activeMenu ?? '';

$active = function ($key) use ($activeMenu) {
    return $activeMenu === $key
        ? 'bg-primary-700 text-white shadow-inner'
        : 'text-primary-100/90 hover:bg-primary-800 hover:text-white';
};

$sidebarId = $sidebarId ?? 'sidebar';

// Definisi Menu
$menus = [
    [
        'type'  => 'link',
        'key'   => 'dashboard',
        'label' => 'Dashboard',
        'url'   => 'admin/dashboard',
        'icon'  => 'dashboard',
    ],
    [
        'type'  => 'header',
        'label' => 'Konten Situs',
    ],
    [
        'type'  => 'link',
        'key'   => 'halaman_statis',
        'label' => 'Halaman Statis',
        'url'   => 'admin/halaman-statis',
        'icon'  => 'halaman_statis',
    ],
    [
        'type'  => 'link',
        'key'   => 'menu',
        'label' => 'Manajemen Menu',
        'url'   => 'admin/menu',
        'icon'  => 'menu',
    ],
    [
        'type'  => 'link',
        'key'   => 'banner',
        'label' => 'Banner',
        'url'   => 'admin/banner',
        'icon'  => 'banner',
    ],
    [
        'type'  => 'link',
        'key'   => 'berita',
        'label' => 'Berita',
        'url'   => 'admin/berita',
        'icon'  => 'berita',
    ],
    [
        'type'  => 'link',
        'key'   => 'galery',
        'label' => 'Galery',
        'url'   => 'admin/galery',
        'icon'  => 'galery',
    ],
    [
        'type'     => 'dropdown',
        'key'      => 'dokumen_group',
        'label'    => 'Dokumen',
        'icon'     => 'dokumen',
        'active_keys' => ['dokumen_kategori', 'dokumen'], // Kapan menu ini terbuka
        'children' => [
            [
                'key'   => 'dokumen_kategori',
                'label' => 'Kategori Dokumen',
                'url'   => 'admin/kategori-dokumen',
                'icon'  => 'kategori_dokumen',
            ],
            [
                'key'   => 'dokumen',
                'label' => 'Dokumen',
                'url'   => 'admin/dokumen',
                'icon'  => 'dokumen_simple',
            ],
        ]
    ],
    [
        'type'  => 'link',
        'key'   => 'perangkat_desa',
        'label' => 'Daftar Perangkat Desa',
        'url'   => 'admin/perangkat-desa',
        'icon'  => 'perangkat_desa',
    ],
    [
        'type'  => 'link',
        'key'   => 'bpd',
        'label' => 'Anggota BPD',
        'url'   => 'admin/bpd',
        'icon'  => 'bpd',
    ],
    [
        'type'  => 'link',
        'key'   => 'penduduk',
        'label' => 'Data Penduduk',
        'url'   => 'admin/data-penduduk',
        'icon'  => 'penduduk',
    ],
    [
        'type'  => 'link',
        'key'   => 'penerima_bantuan',
        'label' => 'Penerima Bantuan',
        'url'   => 'admin/penerima-bantuan',
        'icon'  => 'penerima_bantuan',
    ],
    [
        'type'  => 'link',
        'key'   => 'rt_identitas',
        'label' => 'RT',
        'url'   => 'admin/rt-identitas',
        'icon'  => 'rt',
    ],
    [
        'type'     => 'dropdown',
        'key'      => 'master_data',
        'label'    => 'Master Data',
        'icon'     => 'settings',
        'active_keys' => [
            'master_pendidikan',
            'master_pekerjaan',
            'master_agama',
            'master_dusun',
            'master_rt',
            'master_jabatan'
        ],
        'children' => [
            [
                'key'   => 'master_pendidikan',
                'label' => 'Pendidikan',
                'url'   => 'admin/master-pendidikan',
                'icon'  => 'master_pendidikan',
            ],
            [
                'key'   => 'master_pekerjaan',
                'label' => 'Pekerjaan',
                'url'   => 'admin/master-pekerjaan',
                'icon'  => 'master_pekerjaan',
            ],
            [
                'key'   => 'master_agama',
                'label' => 'Agama',
                'url'   => 'admin/master-agama',
                'icon'  => 'master_agama',
            ],
            [
                'key'   => 'master_dusun',
                'label' => 'Dusun',
                'url'   => 'admin/master-dusun',
                'icon'  => 'master_dusun',
            ],
            [
                'key'   => 'master_rt',
                'label' => 'Data RT',
                'url'   => 'admin/master-rt',
                'icon'  => 'master_rt',
            ],
            [
                'key'   => 'master_jabatan',
                'label' => 'Jabatan',
                'url'   => 'admin/master-jabatan',
                'icon'  => 'master_jabatan',
            ],
        ]
    ],
    [
        'type'  => 'header',
        'label' => 'Konten Profil',
    ],
    [
        'type'  => 'link',
        'key'   => 'demografi',
        'label' => 'Demografi',
        'url'   => 'admin/demografi',
        'icon'  => 'demografi',
    ],
    [
        'type'  => 'link',
        'key'   => 'sambutan_kades',
        'label' => 'Sambutan Kepala Desa',
        'url'   => 'admin/sambutan-kades',
        'icon'  => 'sambutan_kades',
    ],
    [
        'type'  => 'link',
        'key'   => 'jam_pelayanan',
        'label' => 'Jam Pelayanan',
        'url'   => 'admin/jam-pelayanan',
        'icon'  => 'jam_pelayanan',
    ],
    [
        'type'  => 'link',
        'key'   => 'kontak',
        'label' => 'Kontak',
        'url'   => 'admin/kontak',
        'icon'  => 'kontak',
    ],
    [
        'type'  => 'header',
        'label' => 'Pengaturan',
    ],
    [
        'type'  => 'link',
        'key'   => 'pengguna',
        'label' => 'Manajemen Pengguna',
        'url'   => 'admin/pengguna',
        'icon'  => 'pengguna',
    ],
    [
        'type'   => 'link',
        'key'    => 'lihat_website',
        'label'  => 'Lihat Website',
        'url'    => '', // Base URL root
        'icon'   => 'globe',
        'target' => '_blank',
    ],
];
?>

<aside id="<?= esc($sidebarId) ?>"
    class="fixed inset-y-0 left-0 z-50 w-72
         bg-primary-900 text-slate-100 shadow-xl
         transform -translate-x-full
         transition-transform duration-200 ease-out
         md:static md:translate-x-0 md:w-64 md:flex md:flex-col
         md:sticky md:top-0 md:h-screen
         dark:bg-primary-950">
    <div class="h-16 flex items-center px-6 border-b border-primary-700/60">
        <div class="flex items-center gap-3">
            <div>
                <p class="text-sm font-semibold leading-tight">CMS Web Desa</p>
                <p class="text-xs text-primary-200/80">Panel Admin</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto scroll-thin py-4">
        <ul class="px-3 space-y-1 text-sm bg-primary-900 dark:bg-primary-950">

            <?php foreach ($menus as $menu) : ?>

                <?php if ($menu['type'] === 'header') : ?>
                    <li class="mt-4 mb-1 px-2 text-[11px] font-semibold uppercase tracking-wide text-primary-300/70">
                        <?= $menu['label'] ?>
                    </li>

                <?php elseif ($menu['type'] === 'dropdown') : ?>
                    <?php
                    $isOpen = in_array($activeMenu, $menu['active_keys'], true);
                    $dropdownId = 'submenu-' . $menu['key'];
                    ?>
                    <li>
                        <button type="button"
                            class="w-full flex items-center justify-between gap-2 px-3 py-2.5 rounded-xl transition <?= $isOpen ? 'bg-primary-800/60 text-white' : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>"
                            aria-controls="<?= $dropdownId ?>"
                            aria-expanded="<?= $isOpen ? 'true' : 'false' ?>"
                            onclick="(function(){
                                const box = document.getElementById('<?= $dropdownId ?>');
                                const btn = event.currentTarget;
                                const isOpen = btn.getAttribute('aria-expanded') === 'true';
                                btn.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
                                box.classList.toggle('hidden');
                                // Rotate icon
                                const svg = btn.querySelector('.dropdown-arrow');
                                if(svg) { svg.classList.toggle('rotate-180'); }
                            })()">
                            <span class="flex items-center gap-2">
                                <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                    <?= get_icon($menu['icon']) ?>
                                </span>
                                <span><?= $menu['label'] ?></span>
                            </span>

                            <svg class="dropdown-arrow w-4 h-4 transition-transform <?= $isOpen ? 'rotate-180' : '' ?>"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9l6 6 6-6" />
                            </svg>
                        </button>

                        <ul id="<?= $dropdownId ?>"
                            class="mt-1 ml-3 pl-3 border-l border-primary-700/50 space-y-1 <?= $isOpen ? '' : 'hidden' ?>">
                            <?php foreach ($menu['children'] as $child) : ?>
                                <li>
                                    <a href="<?= base_url($child['url']) ?>"
                                        class="flex items-center gap-2 px-3 py-2 rounded-xl transition <?= $active($child['key']) ?>">
                                        <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/40 items-center justify-center">
                                            <?= get_icon($child['icon']) ?>
                                        </span>
                                        <span><?= $child['label'] ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                <?php else : // type = link 
                ?>
                    <li>
                        <a href="<?= base_url($menu['url']) ?>" 
                           target="<?= $menu['target'] ?? '_self' ?>"
                           class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active($menu['key']) ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <?= get_icon($menu['icon']) ?>
                            </span>
                            <span><?= $menu['label'] ?></span>
                        </a>
                    </li>
                <?php endif; ?>

            <?php endforeach; ?>

        </ul>
    </nav>

    <div class="h-14 flex items-center justify-between px-4 border-t border-primary-700/60 text-[11px] text-primary-200/80">
        <span>© <?= date('Y') ?> Web Desa</span>
        <span class="px-2 py-1 rounded-full bg-primary-700/80 text-[10px] uppercase tracking-wide">Admin</span>
    </div>

</aside>