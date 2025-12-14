<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $this->renderSection('title') ?> - Web Desa CMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon Dummy (SVG base64) -->
    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='128' height='128' viewBox='0 0 24 24'%3E%3Crect width='24' height='24' rx='6' ry='6' fill='%233b82f6'/%3E%3Ctext x='12' y='16' font-size='10' text-anchor='middle' fill='white' font-family='Roboto, sans-serif'%3ECMS%3C/text%3E%3C/svg%3E">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>

    <!-- GOOGLE FONT: Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/custom.css">

    <style>
        body {
            font-family: 'Roboto', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .scroll-thin::-webkit-scrollbar {
            width: 6px;
        }

        .scroll-thin::-webkit-scrollbar-track {
            background: transparent;
        }

        .scroll-thin::-webkit-scrollbar-thumb {
            background: rgba(148, 163, 184, 0.75);
            border-radius: 999px;
        }
    </style>
</head>



<body class="bg-slate-100 text-slate-800 dark:bg-slate-950 dark:text-slate-100">
    <div class="min-h-screen flex">
        <?php $activeMenu = $activeMenu ?? ''; ?>

        <!-- SIDEBAR -->
        <aside id="sidebar" class="hidden md:flex md:flex-col w-64 bg-primary-900 text-slate-100 shadow-xl dark:bg-primary-950">
            <!-- Brand -->
            <div class="h-16 flex items-center px-6 border-b border-primary-700/60">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-primary-500 flex items-center justify-center shadow-md">
                        <span class="text-sm font-bold tracking-tight">WD</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold leading-tight">Web Desa CMS</p>
                        <p class="text-xs text-primary-200/80">Panel Admin</p>
                    </div>
                </div>
            </div>

            <!-- MENU -->
            <nav class="flex-1 overflow-y-auto scroll-thin py-4">
                <ul class="px-3 space-y-1 text-sm">
                    <!-- Dashboard -->
                    <li>
                        <a href="<?= base_url('admin/dashboard') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                           <?= $activeMenu === 'dashboard'
                                ? 'bg-primary-700 text-white shadow-inner'
                                : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon Home -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
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
                        <a href="<?= base_url('admin/halaman-statis') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                           <?= $activeMenu === 'halaman_statis'
                                ? 'bg-primary-700 text-white shadow-inner'
                                : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon Document -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M7 3.5h7.5L19 8v12H7z" />
                                    <path d="M14.5 3.5V8H19" />
                                    <path d="M10 11h5M10 14h5M10 17h3" />
                                </svg>
                            </span>
                            <span>Halaman Statis</span>
                        </a>
                    </li>

                    <!-- Banner -->
                    <li>
                        <a href="<?= base_url('admin/banner') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                           <?= $activeMenu === 'banner'
                                ? 'bg-primary-700 text-white shadow-inner'
                                : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon Photo/Banner -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
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
                        <a href="<?= base_url('admin/berita') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                           <?= $activeMenu === 'berita'
                                ? 'bg-primary-700 text-white shadow-inner'
                                : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon Newspaper -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="4" y="5" width="16" height="14" rx="1.5" />
                                    <path d="M8 9h5M8 12h5M8 15h3" />
                                    <rect x="15" y="9" width="3" height="6" rx="0.6" />
                                </svg>
                            </span>
                            <span>Berita</span>
                        </a>
                    </li>

                    <!-- Data Penduduk -->
                    <li>
                        <a href="<?= base_url('admin/data-penduduk') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                           <?= $activeMenu === 'penduduk'
                                ? 'bg-primary-700 text-white shadow-inner'
                                : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon Users -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
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
                        <a href="<?= base_url('admin/perangkat-desa') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                           <?= $activeMenu === 'perangkat_desa'
                                ? 'bg-primary-700 text-white shadow-inner'
                                : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon Briefcase/Person -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="4" y="8" width="16" height="10" rx="1.5" />
                                    <path d="M9 8V6.5A1.5 1.5 0 0 1 10.5 5h3A1.5 1.5 0 0 1 15 6.5V8" />
                                    <path d="M4 12h16" />
                                </svg>
                            </span>
                            <span>Daftar Perangkat Desa</span>
                        </a>
                    </li>


                    <!-- BPD -->
                    <li>
                        <a href="<?= base_url('admin/bpd') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                           <?= $activeMenu === 'bpd'
                                ? 'bg-primary-700 text-white shadow-inner'
                                : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon People / Council -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="8" cy="9" r="2.1" />
                                    <circle cx="16" cy="9" r="2.1" />
                                    <path d="M4.5 17.5c.7-2 2-3 3.5-3s2.8 1 3.5 3" />
                                    <path d="M12.5 17.5c.7-2 2-3 3.5-3s2.8 1 3.5 3" />
                                </svg>
                            </span>
                            <span>BPD</span>
                        </a>
                    </li>

                    <!-- Karang Taruna -->
                    <li>
                        <a href="<?= base_url('admin/karang-taruna') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                           <?= $activeMenu === 'karang_taruna'
                                ? 'bg-primary-700 text-white shadow-inner'
                                : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon Community / Youth -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="8" r="2.3" />
                                    <path d="M6 18.5c.8-2.5 2.9-4 6-4s5.2 1.5 6 4" />
                                    <path d="M5 9.5l2-1.5M19 9.5l-2-1.5" />
                                </svg>
                            </span>
                            <span>Karang Taruna</span>
                        </a>
                    </li>

                    <!-- Kader -->
                    <li>
                        <a href="<?= base_url('admin/kader') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                           <?= $activeMenu === 'kader'
                                ? 'bg-primary-700 text-white shadow-inner'
                                : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon Badge / Volunteer -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="8" r="2.4" />
                                    <path d="M8.5 14h7l1.5 5-5-2-5 2 1.5-5z" />
                                </svg>
                            </span>
                            <span>Kader</span>
                        </a>
                    </li>

                    <!-- BUMDes -->
                    <li>
                        <a href="<?= base_url('admin/bumdes') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                           <?= $activeMenu === 'bumdes'
                                ? 'bg-primary-700 text-white shadow-inner'
                                : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon Store / Building -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 10.5 6 5h12l2 5.5" />
                                    <path d="M5 10.5h14V19H5z" />
                                    <path d="M10 14h4v5h-4z" />
                                </svg>
                            </span>
                            <span>BUMDes</span>
                        </a>
                    </li>

                    <li class="mt-4 mb-1 px-2 text-[11px] font-semibold uppercase tracking-wide text-primary-300/70">
                        Master Data
                    </li>

                    <!-- Master Pendidikan -->
                    <li>
                        <a href="<?= base_url('admin/master-pendidikan') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                           <?= $activeMenu === 'master_pendidikan'
                                ? 'bg-primary-700 text-white shadow-inner'
                                : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon Academic Cap -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
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
                        <a href="<?= base_url('admin/master-pekerjaan') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                            <?= $activeMenu === 'master_pekerjaan'
                                ? 'bg-primary-700 text-white shadow-inner'
                                : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon Briefcase -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
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
                        <a href="<?= base_url('admin/master-agama') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                        <?= $activeMenu === 'master_agama'
                            ? 'bg-primary-700 text-white shadow-inner'
                            : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon Sparkles / Faith -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 3v18" />
                                    <path d="M6 9h12" />
                                    <path d="M9 9c0 4 3 7 3 12" />
                                    <path d="M15 9c0 4-3 7-3 12" />
                                </svg>
                            </span>
                            <span>Master Agama</span>
                        </a>
                    </li>


                    <!-- Master Jabatan -->
                    <li>
                        <a href="<?= base_url('admin/master-jabatan') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                           <?= $activeMenu === 'master_jabatan'
                                ? 'bg-primary-700 text-white shadow-inner'
                                : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon Grid / Positions -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="4" y="4" width="6" height="6" rx="1.2" />
                                    <rect x="14" y="4" width="6" height="6" rx="1.2" />
                                    <rect x="4" y="14" width="6" height="6" rx="1.2" />
                                    <rect x="14" y="14" width="6" height="6" rx="1.2" />
                                </svg>
                            </span>
                            <span>Master Jabatan</span>
                        </a>
                    </li>

                    <li class="mt-4 mb-1 px-2 text-[11px] font-semibold uppercase tracking-wide text-primary-300/70">
                        Konten Profil
                    </li>

                    <!-- Sambutan Kepala Desa -->
                    <li>
                        <a href="<?= base_url('admin/sambutan-kades') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                           <?= $activeMenu === 'sambutan_kades'
                                ? 'bg-primary-700 text-white shadow-inner'
                                : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon Megaphone -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
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
                        <a href="<?= base_url('admin/jam-pelayanan') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                           <?= $activeMenu === 'jam_pelayanan'
                                ? 'bg-primary-700 text-white shadow-inner'
                                : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon Clock -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="7.5" />
                                    <path d="M12 8v4l2.5 2.5" />
                                </svg>
                            </span>
                            <span>Jam Pelayanan</span>
                        </a>
                    </li>

                    <!-- Kontak -->
                    <li>
                        <a href="<?= base_url('admin/kontak') ?>"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl transition
                           <?= $activeMenu === 'kontak'
                                ? 'bg-primary-700 text-white shadow-inner'
                                : 'text-primary-100/90 hover:bg-primary-800 hover:text-white' ?>">
                            <span class="inline-flex w-6 h-6 rounded-lg bg-primary-700/60 items-center justify-center">
                                <!-- Icon Phone -->
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
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

        <!-- MAIN -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- TOPBAR -->
            <header class="sticky top-0 z-40 h-16 bg-white/95 backdrop-blur border-b border-slate-200 
        flex items-center justify-between px-4 md:px-6 
        dark:bg-slate-900/95 dark:border-slate-800">


                <div class="flex items-center gap-3">
                    <!-- Sidebar toggle (Heroicons: Bars-3) -->
                    <button id="sidebarToggle"
                        class="md:hidden inline-flex items-center justify-center w-9 h-9 rounded-xl border border-slate-200 bg-white shadow-sm text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:hover:bg-slate-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 5.25h16.5M3.75 12h16.5m-16.5 6.75h16.5" />
                        </svg>
                    </button>

                    <div>
                        <!-- Judul diganti statis -->
                        <h1 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
                            CMS DESA BATILAI
                        </h1>
                        <p class="text-xs text-slate-500 hidden sm:block dark:text-slate-400">
                            Panel manajemen konten Web Desa
                        </p>
                    </div>
                </div>

                <!-- User + theme toggle -->
                <div class="flex items-center gap-3">
                    <!-- Toggle tema -->
                    <button id="themeToggle"
                        type="button"
                        class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-xl border border-slate-200 bg-white text-[11px] text-slate-600 shadow-sm hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:hover:bg-slate-800">
                        <!-- Icon Sun (light) -->
                        <svg id="iconSun" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-3.5 h-3.5 block dark:hidden">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v1.5m0 15V21m9-9h-1.5M3 12H4.5m15.364 6.364L18.9 17.9M5.1 5.1L6.636 6.636m10.728 0L18.9 5.1M5.1 18.9L6.636 17.364" />
                            <circle cx="12" cy="12" r="4" />
                        </svg>
                        <!-- Icon Moon (dark) -->
                        <svg id="iconMoon" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-3.5 h-3.5 hidden dark:block">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
                        </svg>
                        <span id="themeToggleLabel" class="hidden sm:inline">Dark</span>
                    </button>

                    <!-- User dropdown -->
                    <div class="relative">
                        <button id="userMenuButton"
                            type="button"
                            class="inline-flex items-center gap-2 px-2.5 py-1.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs md:text-sm shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-primary-500/60 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:hover:bg-slate-800">
                            <div class="hidden sm:flex flex-col items-end">
                                <span class="font-medium leading-tight">
                                    <?= esc(session('user_name') ?? 'Administrator') ?>
                                </span>
                                <span class="text-[10px] text-slate-400 leading-tight">Admin Web Desa</span>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-primary-500 text-white flex items-center justify-center text-xs font-semibold shadow">
                                <?= strtoupper(substr((string)(session('user_name') ?? 'A'), 0, 1)) ?>
                            </div>
                            <!-- Chevron -->
                            <svg class="w-3.5 h-3.5 text-slate-500 hidden sm:block" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.5 7.5L10 12l4.5-4.5" stroke="currentColor" stroke-width="1.6"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>

                        <div id="userMenuDropdown"
                            class="hidden absolute right-0 mt-2 w-44 origin-top-right bg-white border border-slate-200 rounded-xl shadow-lg py-1 text-xs md:text-sm z-30 dark:bg-slate-900 dark:border-slate-700">
                            <div class="px-3 py-2 border-b border-slate-100 dark:border-slate-700">
                                <p class="font-medium text-slate-800 dark:text-slate-100 truncate">
                                    <?= esc(session('user_name') ?? 'Administrator') ?>
                                </p>
                                <p class="text-[11px] text-slate-400 dark:text-slate-500">Admin Web Desa</p>
                            </div>

                            <a href="<?= base_url('admin/profile') ?>"
                                class="flex items-center gap-2 px-3 py-2 hover:bg-slate-50 text-slate-700 dark:text-slate-100 dark:hover:bg-slate-800">
                                <!-- Icon user -->
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.7"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="9" r="3" />
                                    <path d="M7 19.5c.8-2.3 2.6-3.5 5-3.5s4.2 1.2 5 3.5" />
                                </svg>
                                <span>Profil</span>
                            </a>

                            <form method="post" action="<?= base_url('logout') ?>">
                                <?= csrf_field() ?>
                                <button type="submit"
                                    class="w-full flex items-center gap-2 px-3 py-2 text-left text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10">
                                    <!-- Icon logout -->
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.7"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M15 5h-5.5A2.5 2.5 0 0 0 7 7.5v9A2.5 2.5 0 0 0 9.5 19H15" />
                                        <path d="M12 12h8" />
                                        <path d="M18 8l4 4-4 4" />
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- CONTENT -->
            <main class="flex-1 p-4 md:p-6">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (session()->getFlashdata('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= esc(session()->getFlashdata('success')) ?>',
                timer: 2200,
                showConfirmButton: false
            });
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?= esc(session()->getFlashdata('error')) ?>'
            });
        </script>
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userBtn = document.getElementById('userMenuButton');
            const userMenu = document.getElementById('userMenuDropdown');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const themeToggle = document.getElementById('themeToggle');
            const themeLabel = document.getElementById('themeToggleLabel');

            // === USER MENU DROPDOWN ===
            document.addEventListener('click', function(e) {
                if (!userBtn || !userMenu) return;

                const clickInsideButton = userBtn.contains(e.target);
                const clickInsideMenu = userMenu.contains(e.target);

                if (clickInsideButton) {
                    userMenu.classList.toggle('hidden');
                } else if (!clickInsideMenu) {
                    userMenu.classList.add('hidden');
                }
            });

            // === SIDEBAR TOGGLE (mobile) ===
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('hidden');
                });
            }

            // === THEME TOGGLE (dark/light) ===
            const storedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            const initialTheme = storedTheme || (prefersDark ? 'dark' : 'light');

            function applyTheme(theme) {
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                    if (themeLabel) themeLabel.textContent = 'Light';
                } else {
                    document.documentElement.classList.remove('dark');
                    if (themeLabel) themeLabel.textContent = 'Dark';
                }
            }

            applyTheme(initialTheme);

            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    const current = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
                    const next = current === 'dark' ? 'light' : 'dark';
                    localStorage.setItem('theme', next);
                    applyTheme(next);
                });
            }
        });
    </script>

</body>

</html>