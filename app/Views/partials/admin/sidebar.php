<?php
$activeMenu = $activeMenu ?? '';

$active = function ($key) use ($activeMenu) {
    return $activeMenu === $key
        ? 'bg-primary-700 text-white shadow-inner'
        : 'text-primary-100/90 hover:bg-primary-800 hover:text-white';
};
?>

<?php $sidebarId = $sidebarId ?? 'sidebar'; ?>

<aside id="<?= esc($sidebarId) ?>"
    class="fixed inset-y-0 left-0 z-50 w-72
         bg-primary-900 text-slate-100 shadow-xl
         transform -translate-x-full
         transition-transform duration-200 ease-out
         md:static md:translate-x-0 md:w-64 md:flex md:flex-col
         md:sticky md:top-0 md:h-screen
         dark:bg-primary-950">
    <!-- Brand -->
    <div class="h-16 flex items-center px-6 border-b border-primary-700/60">
        <div class="flex items-center gap-3">
            <!-- <div class="w-9 h-9 rounded-xl bg-primary-500 flex items-center justify-center shadow-md">
                <span class="text-sm font-bold tracking-tight">WD</span>
            </div> -->
            <div>
                <p class="text-sm font-semibold leading-tight">CMS Web Desa</p>
                <p class="text-xs text-primary-200/80">Panel Admin</p>
            </div>
        </div>
    </div>

    <!-- MENU -->
    <!-- <nav class="flex-1 overflow-y-auto scroll-thin py-4"> -->
    <nav class="flex-1 overflow-y-auto scroll-thin py-4">

        <ul class="px-3 space-y-1 text-sm">

            <!-- Dashboard -->
            <li>
                <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('dashboard') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 11.5L12 4l8 7.5" />
                            <path d="M5.5 10.5V20h13v-9.5" />
                        </svg>
                    </span>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="mt-3 mb-1 px-2 text-[11px] font-semibold uppercase tracking-wide text-primary-300/70">
                Konten Situs
            </li>

            <!-- Halaman Statis -->
            <li>
                <a href="<?= base_url('admin/halaman-statis') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('halaman_statis') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M7 3.5h7.5L19 8v12H7z" />
                            <path d="M14.5 3.5V8H19" />
                            <path d="M10 11h5M10 14h5M10 17h3" />
                        </svg>
                    </span>
                    <span>Halaman Statis</span>
                </a>
            </li>
            <!-- Manajemen Menu -->
            <li>
                <a href="<?= base_url('admin/menu') ?>"
                    class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('menu') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="4" rx="1" />
                            <rect x="3" y="10" width="18" height="4" rx="1" />
                            <rect x="3" y="16" width="18" height="4" rx="1" />
                        </svg>
                    </span>
                    <span>Manajemen Menu</span>
                </a>
            </li>

            <!-- Banner -->
            <li>
                <a href="<?= base_url('admin/banner') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('banner') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="4" y="5" width="16" height="14" rx="1.5" />
                            <path d="M8 13l2.5-2.5L14 14l2-2 2 3" />
                            <circle cx="9" cy="9" r="1.1" />
                        </svg>
                    </span>
                    <span>Banner</span>
                </a>
            </li>

            <!-- Berita -->
            <li>
                <a href="<?= base_url('admin/berita') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('berita') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="4" y="5" width="16" height="14" rx="1.5" />
                            <path d="M8 9h5M8 12h5M8 15h3" />
                            <rect x="15" y="9" width="3" height="6" rx="0.6" />
                        </svg>
                    </span>
                    <span>Berita</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/galery') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('galery') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="4" y="6" width="16" height="12" rx="1.5" />
                            <path d="M8 14l2.2-2.2L13.2 15l2.3-2.3L20 18" />
                            <circle cx="9" cy="10" r="1.1" />
                        </svg>
                    </span>
                    <span>Galery</span>
                </a>
            </li>
            <!-- Data Penduduk -->
            <li>
                <a href="<?= base_url('admin/data-penduduk') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('penduduk') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M8 13.5c-2.2 0-4 1.3-4 3v1.5h8v-1.5c0-1.7-1.8-3-4-3z" />
                            <circle cx="8" cy="8.5" r="2.5" />
                            <path d="M16 12.5c1.7 0 3 1.1 3 2.6V18" />
                            <circle cx="16" cy="8.5" r="2.1" />
                        </svg>
                    </span>
                    <span>Data Penduduk</span>
                </a>
            </li>

            <!-- Daftar Perangkat Desa -->
            <li>
                <a href="<?= base_url('admin/perangkat-desa') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('perangkat_desa') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="4" y="8" width="16" height="10" rx="1.5" />
                            <path d="M9 8V6.5A1.5 1.5 0 0 1 10.5 5h3A1.5 1.5 0 0 1 15 6.5V8" />
                            <path d="M4 12h16" />
                        </svg>
                    </span>
                    <span>Daftar Perangkat Desa</span>
                </a>
            </li>

            <li>
                <a href="<?= base_url('admin/penerima-bantuan') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('penerima_bantuan') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2.5 20 6v6c0 5-3.5 9-8 9s-8-4-8-9V6l8-3.5Z" />
                            <path d="M8.5 12.5 11 15l4.5-5" />
                        </svg>
                    </span>
                    <span>Penerima Bantuan</span>
                </a>
            </li>
            <!-- RT (Identitas) -->
            <li>
                <a href="<?= base_url('admin/rt-identitas') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('rt_identitas') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 20V9.5L12 4l8 5.5V20" />
                            <path d="M9.5 20v-6h5v6" />
                        </svg>
                    </span>
                    <span>RT</span>
                </a>
            </li>


            <!-- MASTER DATA -->
            <li class="mt-4 mb-1 px-2 text-[11px] font-semibold uppercase tracking-wide text-primary-300/70">
                Master Data
            </li>

            <!-- Master Pendidikan -->
            <li>
                <a href="<?= base_url('admin/master-pendidikan') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('master_pendidikan') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M3 9.5L12 5l9 4.5-9 4.5-9-4.5z" />
                            <path d="M7 12.5v3.5c0 1 2.2 2 5 2s5-1 5-2v-3.5" />
                            <path d="M21 10v4" />
                        </svg>
                    </span>
                    <span>Master Pendidikan</span>
                </a>
            </li>

            <!-- Master Pekerjaan -->
            <li>
                <a href="<?= base_url('admin/master-pekerjaan') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('master_pekerjaan') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M10 6V4.5A1.5 1.5 0 0 1 11.5 3h1A1.5 1.5 0 0 1 14 4.5V6" />
                            <rect x="4" y="6" width="16" height="12" rx="2" />
                            <path d="M4 12h16" />
                        </svg>
                    </span>
                    <span>Master Pekerjaan</span>
                </a>
            </li>


            <!-- Master Agama -->

            <li>
                <a href="<?= base_url('admin/master-agama') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('master_agama') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 4l9 5-9 5-9-5 9-5z" />
                            <path d="M3 14l9 5 9-5" />
                        </svg>


                    </span>
                    <span>Master Agama</span>
                </a>
            </li>

            <!-- Master Dusun -->
            <li>
                <a href="<?= base_url('admin/master-dusun') ?>"
                    class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('master_dusun') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 20V10l8-5 8 5v10" />
                            <path d="M9 20v-6h6v6" />
                            <path d="M7.5 12.5h.01M10.5 12.5h.01M13.5 12.5h.01M16.5 12.5h.01" />
                        </svg>
                    </span>
                    <span>Master Dusun</span>
                </a>
            </li>

            <!-- Data RT (Master) -->
            <li>
                <a href="<?= base_url('admin/master-rt') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('master_rt') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3.5" y="4.5" width="17" height="15" rx="2" />
                            <path d="M7 9h10M7 12h10M7 15h6" />
                        </svg>
                    </span>
                    <span>Master RT</span>
                </a>
            </li>

            <!-- Master Jabatan -->
            <li>
                <a href="<?= base_url('admin/master-jabatan') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('master_jabatan') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="4" y="4" width="6" height="6" rx="1.2" />
                            <rect x="14" y="4" width="6" height="6" rx="1.2" />
                            <rect x="4" y="14" width="6" height="6" rx="1.2" />
                            <rect x="14" y="14" width="6" height="6" rx="1.2" />
                        </svg>
                    </span>
                    <span>Master Jabatan</span>
                </a>
            </li>
            <!-- Pengguna -->
            <li>
                <a href="<?= base_url('admin/pengguna') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('pengguna') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="3" />
                            <path d="M4.5 20a7.5 7.5 0 0 1 15 0" />
                        </svg>
                    </span>
                    <span>Pengguna</span>
                </a>
            </li>

            <!-- KONTEN PROFIL -->
            <li class="mt-4 mb-1 px-2 text-[11px] font-semibold uppercase tracking-wide text-primary-300/70">
                Konten Profil
            </li>

            <!-- Sambutan Kepala Desa -->
            <li>
                <a href="<?= base_url('admin/sambutan-kades') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('sambutan_kades') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M5 11v2l9 4V7L5 11z" />
                            <path d="M18 9.5v5" />
                            <path d="M7 13l-1 4" />
                        </svg>
                    </span>
                    <span>Sambutan Kepala Desa</span>
                </a>
            </li>

            <!-- Jam Pelayanan -->
            <li>
                <a href="<?= base_url('admin/jam-pelayanan') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('jam_pelayanan') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="12" cy="12" r="7.5" />
                            <path d="M12 8v4l2.5 2.5" />
                        </svg>
                    </span>
                    <span>Jam Pelayanan</span>
                </a>
            </li>

            <!-- Kontak -->
            <li>
                <a href="<?= base_url('admin/kontak') ?>" class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition <?= $active('kontak') ?>">
                    <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M7.5 4.5l2 3.5-1.7 1.2a2 2 0 0 0-.6 2.6 11.5 11.5 0 0 0 5 5 2 2 0 0 0 2.6-.6l1.2-1.7 3.5 2a1.3 1.3 0 0 1 .4 1.8l-1.1 1.7a2.3 2.3 0 0 1-2.3 1 16.5 16.5 0 0 1-9.1-4.3 16.2 16.2 0 0 1-4.3-9.1 2.3 2.3 0 0 1 1-2.3l1.7-1.1a1.3 1.3 0 0 1 1.8.4z" />
                        </svg>
                    </span>
                    <span>Kontak</span>
                </a>
            </li>

        </ul>
    </nav>

    <div class="h-14 flex items-center justify-between px-4 border-t border-primary-700/60 text-[11px] text-primary-200/80">
        <span>© <?= date('Y') ?> Web Desa</span>
        <span class="px-2 py-1 rounded-full bg-primary-700/80 text-[10px] uppercase tracking-wide">Admin</span>
    </div>

</aside>