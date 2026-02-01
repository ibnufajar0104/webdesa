<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Batilai - Kecamatan Pelaihari</title>
    <meta name="description" content="Website Resmi Desa Batilai, Kecamatan Pelaihari. Informasi pemerintahan desa, berita, dan layanan publik.">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class', // Enable class-based dark mode
            theme: {
                extend: {
                    colors: {
                        primary: '#059669', // emerald-600
                        primaryDark: '#047857', // emerald-700
                        secondary: '#10b981', // emerald-500
                        accent: '#f59e0b', // amber-500
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        serif: ['Merriweather', 'serif'],
                    },
                    backgroundImage: {
                        'pattern': "url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23059669' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\")",
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Smooth theme transition */
        html, body { transition: background-color 0.3s, color 0.3s; }
    </style>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-slate-900 dark:text-slate-100 flex flex-col min-h-screen font-sans antialiased">

    <!-- Top Bar (Official Info) -->
    <?= view('partials/topbar') ?>

    <!-- Navigation (Official Style) -->
    <?= view('partials/navbar') ?>

    <!-- Hero Section (Slider Only) -->
    <header class="relative bg-slate-900 h-[500px] md:h-[600px] flex items-center justify-center overflow-hidden" id="hero-section">
        <!-- Slider Container -->
        <div id="hero-slider" class="absolute inset-0 w-full h-full z-0">
             <!-- Static Fallback / Placeholder -->
             <div class="absolute inset-0">
                 <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=2813&auto=format&fit=crop" class="w-full h-full object-cover">
                 <div class="absolute inset-0 bg-slate-900/40"></div>
             </div>
        </div>
        
        <!-- Slider Controls -->
        <div id="hero-controls" class="absolute bottom-10 left-1/2 -translate-x-1/2 flex gap-2 z-20">
            <!-- Dots handled by JS -->
        </div>
        
        <!-- Navigation Arrows -->
        <button id="hero-prev" class="hidden absolute top-1/2 left-4 -translate-y-1/2 p-2 bg-white/10 hover:bg-white/30 backdrop-blur-md rounded-full text-white transition z-20">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button id="hero-next" class="hidden absolute top-1/2 right-4 -translate-y-1/2 p-2 bg-white/10 hover:bg-white/30 backdrop-blur-md rounded-full text-white transition z-20">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>
    </header>

    <!-- Search & Menu Overlay (Overlapping) -->
    <div class="relative z-30 -mt-24 mb-20 px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Main Search -->
            <form action="/berita" method="GET" class="relative max-w-3xl mx-auto mb-8 shadow-2xl rounded-full">
                <input type="hidden" name="page" value="1">
                <input type="text" name="q" id="hero-search-input" placeholder="Apa yang ingin Anda cari di desa ini?" 
                    class="w-full pl-8 pr-16 py-5 rounded-full bg-white dark:bg-slate-800 border-none text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-emerald-500/30 text-lg shadow-lg">
                <button type="submit" class="absolute right-2 top-2 bottom-2 px-6 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full transition-colors font-semibold flex items-center gap-2 group">
                    <span class="hidden md:inline">Cari</span>
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>

            <!-- Shortcut Menu Grid -->
            <div class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-md rounded-2xl shadow-xl border border-gray-100 dark:border-slate-700 p-6 md:p-8">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-6">
                    <!-- 1. Profil -->
                    <a href="/halaman/tentang-desa" class="group flex flex-col items-center gap-3 hover:-translate-y-1 transition duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 text-blue-600 dark:text-blue-400 flex items-center justify-center group-hover:shadow-lg group-hover:shadow-blue-500/20 transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-700 dark:text-gray-300 tracking-wide text-center uppercase">Profil</span>
                    </a>
                    
                    <!-- 2. Berita -->
                    <a href="/berita" class="group flex flex-col items-center gap-3 hover:-translate-y-1 transition duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900/30 dark:to-emerald-800/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:shadow-lg group-hover:shadow-emerald-500/20 transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-700 dark:text-gray-300 tracking-wide text-center uppercase">Berita</span>
                    </a>

                    <!-- 3. Dokumen -->
                    <a href="/dokumen" class="group flex flex-col items-center gap-3 hover:-translate-y-1 transition duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-50 to-amber-100 dark:from-amber-900/30 dark:to-amber-800/30 text-amber-600 dark:text-amber-400 flex items-center justify-center group-hover:shadow-lg group-hover:shadow-amber-500/20 transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-700 dark:text-gray-300 tracking-wide text-center uppercase">Dokumen</span>
                    </a>

                    <!-- 4. Galeri -->
                    <a href="/galeri" class="group flex flex-col items-center gap-3 hover:-translate-y-1 transition duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 text-purple-600 dark:text-purple-400 flex items-center justify-center group-hover:shadow-lg group-hover:shadow-purple-500/20 transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-700 dark:text-gray-300 tracking-wide text-center uppercase">Galeri</span>
                    </a>

                    <!-- 5. Stat Penduduk -->
                    <a href="/statistik/penduduk" class="group flex flex-col items-center gap-3 hover:-translate-y-1 transition duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-50 to-cyan-100 dark:from-cyan-900/30 dark:to-cyan-800/30 text-cyan-600 dark:text-cyan-400 flex items-center justify-center group-hover:shadow-lg group-hover:shadow-cyan-500/20 transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-700 dark:text-gray-300 tracking-wide text-center uppercase">Penduduk</span>
                    </a>

                    <!-- 6. Stat Bantuan -->
                    <a href="/statistik/penerima-bantuan" class="group flex flex-col items-center gap-3 hover:-translate-y-1 transition duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-50 to-rose-100 dark:from-rose-900/30 dark:to-rose-800/30 text-rose-600 dark:text-rose-400 flex items-center justify-center group-hover:shadow-lg group-hover:shadow-rose-500/20 transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-700 dark:text-gray-300 tracking-wide text-center uppercase">Bantuan</span>
                    </a>

                    <!-- 7. Kontak -->
                    <a href="/kontak" class="group flex flex-col items-center gap-3 hover:-translate-y-1 transition duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/30 dark:to-red-800/30 text-red-600 dark:text-red-400 flex items-center justify-center group-hover:shadow-lg group-hover:shadow-red-500/20 transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-700 dark:text-gray-300 tracking-wide text-center uppercase">Kontak</span>
                    </a>
        </div>
    </div>
        </div>
    </div>
    <!-- Stats Section (Redesigned - Wide 1 Row) -->
    <section id="stats-section" class="py-8 bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-slate-800 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                 <span class="text-emerald-500 font-bold tracking-widest uppercase text-xs">Informasi Desa</span>
                 <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-900 dark:text-white font-serif">Data Demografi & Wilayah</h2>
            </div>
            
            <!-- 1 Baris Saja (7 Columns on Large Screens) -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
                <!-- 1. Jarak ke Kab. (Dummy) -->
                <div class="bg-gray-50 dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700 text-center hover:shadow-lg transition-all group hover:-translate-y-1">
                    <div class="w-12 h-12 mx-auto bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center text-blue-600 dark:text-blue-400 mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <div class="text-xl font-bold text-gray-900 dark:text-white mb-1" id="stat-jarak">...</div>
                    <div class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Jarak Kab.</div>
                </div>

                <!-- 2. Luas Desa (Dummy) -->
                <div class="bg-gray-50 dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700 text-center hover:shadow-lg transition-all group hover:-translate-y-1">
                    <div class="w-12 h-12 mx-auto bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center text-emerald-600 dark:text-emerald-400 mb-3 group-hover:scale-110 transition-transform">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="text-xl font-bold text-gray-900 dark:text-white mb-1" id="stat-luas">...</div>
                    <div class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Luas Wilayah</div>
                </div>

                <!-- 3. Kepadatan (Dummy) -->
                <div class="bg-gray-50 dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700 text-center hover:shadow-lg transition-all group hover:-translate-y-1">
                    <div class="w-12 h-12 mx-auto bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center text-purple-600 dark:text-purple-400 mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div class="text-xl font-bold text-gray-900 dark:text-white mb-1" id="stat-kepadatan">...</div>
                    <div class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Kepadatan</div>
                </div>

                 <!-- 4. Dusun (Dummy) -->
                 <div class="bg-gray-50 dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700 text-center hover:shadow-lg transition-all group hover:-translate-y-1">
                    <div class="w-12 h-12 mx-auto bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center text-orange-600 dark:text-orange-400 mb-3 group-hover:scale-110 transition-transform">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <div class="text-xl font-bold text-gray-900 dark:text-white mb-1" id="stat-dusun">...</div>
                    <div class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Wilayah Dusun</div>
                </div>

                <!-- 5. RT (Dummy) -->
                <div class="bg-gray-50 dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700 text-center hover:shadow-lg transition-all group hover:-translate-y-1">
                    <div class="w-12 h-12 mx-auto bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center text-amber-600 dark:text-amber-400 mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="text-xl font-bold text-gray-900 dark:text-white mb-1" id="stat-rt">...</div>
                    <div class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Ketua RT</div>
                </div>

                <!-- 6. Penduduk (API) -->
                <div class="bg-gray-50 dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700 text-center hover:shadow-lg transition-all group hover:-translate-y-1">
                    <div class="w-12 h-12 mx-auto bg-cyan-100 dark:bg-cyan-900/30 rounded-full flex items-center justify-center text-cyan-600 dark:text-cyan-400 mb-3 group-hover:scale-110 transition-transform">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div class="text-xl font-bold text-gray-900 dark:text-white mb-1" id="stat-penduduk">...</div>
                    <div class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Total Penduduk</div>
                </div>

                <!-- 7. Kartu Keluarga (API) -->
                <div class="bg-gray-50 dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700 text-center hover:shadow-lg transition-all group hover:-translate-y-1">
                    <div class="w-12 h-12 mx-auto bg-indigo-100 dark:bg-indigo-900/30 rounded-full flex items-center justify-center text-indigo-600 dark:text-indigo-400 mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                     <div class="text-xl font-bold text-gray-900 dark:text-white mb-1" id="stat-kk">...</div>
                    <div class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Kepala Keluarga</div>
                </div>
            </div>
        </div>
    </section>




 
    
    <!-- Sambutan Only (Row) -->
    <section id="sambutan-section" class="py-8 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-slate-800 dark:to-slate-800 rounded-3xl p-6 md:p-8 shadow-sm border border-emerald-100 dark:border-slate-700">
                 <div class="flex flex-col md:flex-row gap-10 items-center">
                      <div class="md:w-1/3 shrink-0">
                         <div class="relative rounded-2xl overflow-hidden shadow-xl aspect-[3/4] max-w-sm mx-auto transform rotate-2 hover:rotate-0 transition-all duration-300">
                             <img src="https://ui-avatars.com/api/?name=Kepala+Desa" alt="Kepala Desa" class="w-full h-full object-cover" id="sambutan-foto">
                             <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                             <div class="absolute bottom-6 left-6 text-white">
                                 <p class="font-bold text-lg" id="sambutan-nama">Nama Kepala Desa</p>
                                 <p class="text-emerald-300 text-sm">Kepala Desa Batilai</p>
                             </div>
                         </div>
                      </div>
                      <div class="md:w-2/3">
                          <span class="inline-block py-1 px-3 rounded-full bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 text-xs font-bold tracking-widest uppercase mb-4">Sambutan Pemerintahan</span>
                          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6 font-serif leading-tight" id="sambutan-judul">Sambutan Kepala Desa</h2>
                          <div class="prose prose-lg text-gray-600 dark:text-gray-300 leading-relaxed" id="sambutan-isi">
                             Sedang memuat sambutan...
                          </div>
                      </div>
                 </div>
             </div>
        </div>
    </section>



    <!-- Perangkat Desa (Official Grid) -->
    <section id="perangkat-section" class="py-8 px-4 bg-white dark:bg-slate-800 border-t border-gray-100 dark:border-slate-700 transition-colors">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                 <span class="text-emerald-600 dark:text-emerald-400 font-bold tracking-wider uppercase text-xs">Pemerintahan Desa</span>
                 <h2 class="text-3xl font-bold text-gray-900 dark:text-white mt-2 font-serif">Struktur Perangkat Desa</h2>
                 <div class="w-16 h-1 bg-emerald-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <div id="perangkat-slider" class="swiper w-full content-loaded" style="display:none;">
                <div class="swiper-wrapper" id="perangkat-container">
                    <!-- Slides injected by JS -->
                </div>
            </div>

            <!-- Skeleton Loader -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6 skeleton-loader">
                <?php for($i=0; $i<5; $i++): ?>
                <div class="bg-gray-100 dark:bg-slate-700 rounded-xl overflow-hidden aspect-[3/4] skeleton"></div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Jam Pelayanan (New Dedicated Section) -->
    <section id="service-hours-section" class="py-12 bg-emerald-50 dark:bg-slate-900 border-t border-emerald-100 dark:border-slate-800 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="text-center mb-10">
                 <span class="text-emerald-600 dark:text-emerald-400 font-bold tracking-wider uppercase text-xs">Jadwal Operasional</span>
                 <h2 class="text-3xl font-bold text-gray-900 dark:text-white mt-2 font-serif">Jam Pelayanan Desa</h2>
             </div>
             
             <div id="service-hours-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 justify-center">
                 <!-- Populated by JS -->
             </div>
        </div>
    </section>

    <!-- Berita Baru (Clean Layout) -->
    <section id="news-section" class="py-10 bg-gray-50 dark:bg-slate-900 transition-colors">
        <div class="max-w-7xl mx-auto px-4">
            
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-12">
                <div class="text-center md:text-left">
                    <span class="text-emerald-600 dark:text-emerald-400 font-bold tracking-wider uppercase text-xs">Informasi Terkini</span>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mt-2 font-serif">Berita & Artikel</h2>
                </div>
                <a href="/berita" class="hidden md:inline-flex items-center text-sm font-semibold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition group mt-4 md:mt-0">
                    Lihat Semua Berita
                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div id="news-container" class="grid grid-cols-1 md:grid-cols-3 gap-8 content-loaded" style="display:none;"></div>

             <!-- Skeleton Loader -->
             <div class="grid grid-cols-1 md:grid-cols-3 gap-8 skeleton-loader">
                <?php for($i=0; $i<3; $i++): ?>
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm overflow-hidden h-full border border-gray-100 dark:border-slate-700">
                    <div class="h-48 w-full bg-gray-200 dark:bg-slate-700 skeleton"></div>
                    <div class="p-6 space-y-3">
                        <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-1/3 skeleton"></div>
                        <div class="h-6 bg-gray-200 dark:bg-slate-700 rounded w-full skeleton"></div>
                        <div class="h-6 bg-gray-200 dark:bg-slate-700 rounded w-2/3 skeleton"></div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>

            <div class="mt-8 text-center md:hidden">
                <a href="/berita" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-emerald-700 bg-emerald-100 hover:bg-emerald-200 w-full transition">
                    Lihat Semua Berita
                </a>
            </div>
        </div>
    </section>

    <!-- Galeri (Clean Grid) -->
    <section id="gallery-section" class="py-10 bg-white dark:bg-slate-800 transition-colors">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-emerald-600 dark:text-emerald-400 font-bold tracking-wider uppercase text-xs">Dokumentasi</span>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mt-2 font-serif">Galeri Kegiatan</h2>
                <div class="w-16 h-1 bg-emerald-500 mx-auto mt-4 rounded-full"></div>
            </div>
            
            <div id="gallery-slider" class="swiper w-full opacity-0 transition-opacity duration-1000">
                <div class="swiper-wrapper" id="gallery-container">
                     <!-- Slides input here -->
                </div>
            </div>

            <!-- Skeleton Loader -->
            <div id="gallery-skeleton" class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
                <?php for($i=0; $i<6; $i++): ?>
                    <div class="break-inside-avoid bg-gray-100 dark:bg-slate-700 rounded-xl overflow-hidden shadow-sm h-64 skeleton"></div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Dokumen (Light Professional) -->
    <section id="dokumen-section" class="py-20 bg-slate-50 dark:bg-slate-900 relative overflow-hidden transition-colors">
        <!-- Background Accent -->
        <div class="absolute top-0 right-0 w-1/2 h-full bg-emerald-500/5 dark:bg-slate-800/30 transform skew-x-12 translate-x-1/4"></div>

        <div class="max-w-5xl mx-auto px-4 relative z-10">
            <div class="text-center mb-12">
                 <span class="text-emerald-600 dark:text-emerald-400 font-bold tracking-wider uppercase text-xs">Transparansi Publik</span>
                 <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-900 dark:text-white font-serif">Dokumen & Regulasi</h2>
                 <p class="mt-4 text-slate-600 dark:text-slate-400 text-base max-w-2xl mx-auto leading-relaxed">Akses langsung ke dokumen resmi desa, peraturan, dan laporan anggaran sebagai wujud transparansi pemerintahan.</p>
            </div>

            <!-- Search Filter -->
             <div class="max-w-md mx-auto mb-8 relative">
                <input type="text" id="dokumen-search" placeholder="Cari dokumen atau regulasi..." class="w-full pl-12 pr-4 py-3 rounded-xl border border-emerald-200 dark:border-emerald-800 bg-white dark:bg-slate-800 text-slate-800 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all shadow-sm">
                <svg class="w-6 h-6 text-slate-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
             </div>

            <!-- Modern Document List -->
            <div id="dokumen-container" class="space-y-4"></div>

            <!-- Skeleton Loader -->
            <div id="dokumen-skeleton" class="space-y-4">
                <?php for($i=0; $i<3; $i++): ?>
                <div class="bg-white dark:bg-slate-800 rounded-lg p-6 border border-slate-200 dark:border-slate-700 flex items-center gap-4 skeleton-loader">
                    <div class="w-12 h-12 bg-slate-200 dark:bg-slate-700 rounded skeleton"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-1/3 skeleton"></div>
                        <div class="h-3 bg-slate-200 dark:bg-slate-700 rounded w-1/4 skeleton"></div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>

            <div class="mt-10 text-center">
                <a href="/dokumen" class="inline-flex items-center text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 font-semibold transition text-sm">
                    Lihat Arsip Lengkap
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer & Contact (Official Dark) -->
    <footer id="footer-section" class="bg-slate-950 text-white pt-16 pb-8 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-6 flex items-center gap-3 font-serif">
                        <img src="logo.png" alt="Logo Desa" class="w-10 h-10 object-contain">
                        Desa Batilai
                    </h3>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6">
                        Website resmi Desa Batilai, Kecamatan Pelaihari, Kabupaten Tanah Laut. Media informasi, transparansi dan pelayanan publik berbasis digital.
                    </p>
                    <div class="flex space-x-4 hidden">
                        <a href="#" class="text-slate-400 hover:text-white transition"><span class="sr-only">Facebook</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path></svg></a>
                        <a href="#" class="text-slate-400 hover:text-white transition"><span class="sr-only">Instagram</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.315 2zm-1.196 1.422c-2.68 0-3.003.01-4.045.058-1.043.047-1.61.218-1.99.364-.492.19-.845.418-1.216.789-.37.37-.599.724-.789 1.216-.147.38-.318.947-.365 1.99-.047 1.042-.057 1.365-.058 4.045v.232c0 2.68.01 3.003.058 4.045.047 1.043.218 1.61.365 1.99.19.492.418.845.789 1.216.37.37.724.599 1.216.789.38.147.947.318 1.99.365 1.042.047 1.365.057 4.045.058h.232c2.68 0 3.003-.01 4.045-.058 1.043-.047 1.61-.218 1.99-.365.492-.19.845-.418 1.216-.789.37-.37.599-.724.789-1.216.147-.38.318-.947.365-1.99.047-1.042.057-1.365.058-4.045v-.232c0-2.68-.01-3.003-.058-4.045-.047-1.043-.218-1.61-.365-1.99-.19-.492-.418-.845-.789-1.216-.37-.37-.724-.599-1.216-.789-.38-.147-.947-.318-1.99-.365-1.042-.047-1.365-.057-4.045-.058h-.232zM12.315 5.922a6.393 6.393 0 110 12.786 6.393 6.393 0 010-12.786zm0 1.422a4.971 4.971 0 100 9.942 4.971 4.971 0 000-9.942zm7.143-3.056a1.056 1.056 0 110 2.112 1.056 1.056 0 010-2.112z" clip-rule="evenodd"></path></svg></a>
                    </div>
                </div>

                <!-- Kontak -->
                <div class="lg:col-span-1">
                    <h3 class="text-white font-bold mb-6 font-serif">Hubungi Kami</h3>
                    <ul class="space-y-4 text-sm text-slate-400">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-3 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span id="footer-address">Jl. A. Yani KM.20, Desa Batilai, Kec. Takisung, Kab. Tanah Laut, Kalimantan Selatan</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span id="footer-phone">0812-3456-7890</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.463 1.065 2.876 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <a href="#" target="_blank" id="contact-wa-footer" class="hover:text-emerald-400 transition">0812-xxxx-xxxx</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span id="footer-email">admin@desabatilai.id</span>
                        </li>
                    </ul>
                </div>

                <!-- Peta (Enlarged and Full Iframe Support) -->
                <div class="h-80 lg:col-span-2 bg-slate-900 rounded-xl overflow-hidden shadow-lg border border-slate-800 relative" id="map-container">
                    <!-- Embed Map Placeholder -->
                    <iframe id="map-iframe" src="" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-slate-500">
                <p>&copy; <?= date('Y') ?> Pemerintah Desa Batilai. All rights reserved.</p>

            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>const BASE_URL = "<?= base_url() ?>";</script>
    <script src="<?= base_url('assets/js/home.js?v=' . time()) ?>"></script>
</body>
</html>
