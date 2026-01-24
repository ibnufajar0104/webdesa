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
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af', // blue-800
                        secondary: '#3b82f6', // blue-500
                        accent: '#f59e0b', // amber-500
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Navigation -->
    <nav class="bg-white/90 backdrop-blur-md shadow-sm fixed w-full z-50 transition-all" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="#" class="flex-shrink-0 flex items-center gap-3">
                        <!-- Logo Placeholder -->
                        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold shadow-md">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div class="leading-tight">
                            <h1 class="text-xl font-bold text-gray-900 tracking-tight">Desa Batilai</h1>
                            <p class="text-xs text-blue-600 font-semibold tracking-wide uppercase">Kec. Pelaihari, Kab. Tanah Laut</p>
                        </div>
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div id="desktop-menu" class="hidden md:flex items-center space-x-8">
                    <!-- Dynamic Menu -->
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button id="mobile-menu-btn" type="button" class="text-gray-500 hover:text-gray-900 focus:outline-none p-2 rounded-md">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden bg-white border-b border-gray-100 shadow-xl">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="#" class="block px-3 py-2 text-base font-medium text-blue-600 bg-blue-50 rounded-md">Beranda</a>
                <a href="#perangkat-section" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 rounded-md">Perangkat</a>
                <a href="#news-section" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 rounded-md">Berita</a>
                <a href="#gallery-section" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 rounded-md">Galeri</a>
                <a href="#dokumen-section" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 rounded-md">Dokumen</a>
                <a href="#footer-section" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 rounded-md">Kontak</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative bg-blue-900 min-h-[600px] flex items-center justify-center text-white overflow-hidden pb-20 pt-28" id="hero-section">
        <!-- Background Image (Subtle) -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" alt="Background" class="w-full h-full object-cover opacity-10 scale-105" id="hero-bg">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900 via-blue-900/90 to-blue-900/80"></div>
        </div>
        
        <div class="relative z-10 px-4 max-w-7xl mx-auto w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left: Banner Text -->
                <div class="text-left fade-in order-2 lg:order-1">
                    <div class="inline-block mb-4 px-3 py-1 bg-blue-500/30 backdrop-blur-sm rounded-full border border-blue-400/30 text-blue-100 text-sm font-medium" id="hero-badge">Site Under Construction</div>
                    <h1 class="text-4xl md:text-6xl font-extrabold mb-6 tracking-tight drop-shadow-sm leading-tight" id="hero-title">Selamat Datang di <br><span class="text-blue-200">Desa Batilai</span></h1>
                    <p class="text-xl md:text-2xl text-blue-200 font-medium mb-6" id="hero-subtitle">Kecamatan Pelaihari</p>
                    <p class="text-lg text-blue-100 mb-8 max-w-xl font-light leading-relaxed" id="hero-desc">Pusat informasi dan layanan digital resmi Pemerintahan Desa Batilai.</p>
                    <div class="flex flex-col sm:flex-row gap-4" id="hero-cta-container">
                        <a href="#news-section" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-blue-500/50 transition transform hover:-translate-y-1 text-center" id="hero-cta-primary">Lihat Kabar Desa</a>
                        <a href="#footer-section" class="bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white border border-white/30 font-semibold py-3 px-8 rounded-full transition text-center">Hubungi Kami</a>
                    </div>
                </div>

                <!-- Right: Banner Image -->
                <div class="relative order-1 lg:order-2 fade-in delay-200">
                    <div class="aspect-w-16 aspect-h-9 rounded-2xl overflow-hidden shadow-2xl border-4 border-white/10 ring-1 ring-white/20 transform hover:scale-[1.01] transition duration-500">
                         <img src="https://via.placeholder.com/800x600?text=Banner+Image" alt="Banner Utama" class="w-full h-full object-cover" id="hero-img-right">
                    </div>
                </div>
            </div>
        </div>

    </header>

    <!-- Sambutan Kepala Desa Section -->
    <section id="sambutan-section" class="py-20 bg-gray-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-12">
                    <!-- Foto Kades -->
                    <div class="md:col-span-4 lg:col-span-3 bg-blue-600 relative min-h-[300px] md:min-h-full">
                         <img src="https://ui-avatars.com/api/?name=Kepala+Desa" alt="Kepala Desa" class="absolute inset-0 w-full h-full object-cover mix-blend-overlay" id="sambutan-bg-effect">
                         <img src="https://ui-avatars.com/api/?name=Kepala+Desa" alt="Kepala Desa" class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-full max-w-[250px] object-cover object-bottom" id="sambutan-foto">
                         <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-blue-900/80 to-transparent"></div>
                         <div class="absolute bottom-6 left-0 w-full text-center text-white px-4">
                            <h3 class="font-bold text-lg leading-tight" id="sambutan-nama">Nama Kepala Desa</h3>
                             <p class="text-xs text-blue-200 font-medium uppercase tracking-wider">Kepala Desa Batilai</p>
                         </div>
                    </div>
                    
                    <!-- Text Sambutan -->
                    <div class="md:col-span-8 lg:col-span-9 p-8 md:p-12 flex flex-col justify-center">
                        <span class="inline-block py-1 px-3 rounded-full bg-blue-100 text-blue-600 text-xs font-bold tracking-wide uppercase mb-4 w-max">Sambutan Kepala Desa</span>
                        <h2 class="text-3xl font-bold text-gray-900 mb-6 leading-tight" id="sambutan-judul">Sambutan Kepala Desa</h2>
                        <div class="prose prose-blue text-gray-600 mb-8" id="sambutan-isi">
                            <p>Memuat sambutan...</p>
                        </div>
                         <!-- Signature or Quote can go here -->
                         <div class="mt-auto pt-6 border-t border-gray-100 flex items-center justify-between">
                             <p class="text-sm text-gray-500 italic">"Membangun Desa, Membangun Bangsa"</p>
                              <!-- Optional Read More -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-gray-50 px-4 -mt-10 mb-10" id="stats-section">
        <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-5 gap-4 md:gap-6">
            <!-- Stat Item -->
            <div class="bg-white rounded-2xl shadow-lg p-4 md:p-6 text-center transform hover:scale-105 transition duration-300 border-b-4 border-blue-500">
                <div class="text-blue-500 mb-2">
                    <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div class="text-xl md:text-3xl font-extrabold text-gray-900" id="stat-penduduk">...</div>
                <div class="text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wide mt-1">Penduduk</div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-4 md:p-6 text-center transform hover:scale-105 transition duration-300 border-b-4 border-green-500">
                <div class="text-green-500 mb-2">
                    <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </div>
                <div class="text-xl md:text-3xl font-extrabold text-gray-900" id="stat-kk">...</div>
                <div class="text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wide mt-1">Kepala Keluarga</div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-4 md:p-6 text-center transform hover:scale-105 transition duration-300 border-b-4 border-yellow-500">
                <div class="text-yellow-500 mb-2">
                    <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-1.447-.894L15 7m0 13V7"></path></svg>
                </div>
                <div class="text-xl md:text-3xl font-extrabold text-gray-900" id="stat-wilayah">...</div>
                <div class="text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wide mt-1">Luas Wilayah</div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-4 md:p-6 text-center transform hover:scale-105 transition duration-300 border-b-4 border-purple-500">
                <div class="text-purple-500 mb-2">
                    <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div class="text-xl md:text-3xl font-extrabold text-gray-900" id="stat-rw">0</div>
                <div class="text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wide mt-1">RW</div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-4 md:p-6 text-center transform hover:scale-105 transition duration-300 border-b-4 border-red-500">
                <div class="text-red-500 mb-2">
                    <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div class="text-xl md:text-3xl font-extrabold text-gray-900" id="stat-dusun">0</div>
                <div class="text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wide mt-1">Dusun</div>
            </div>
        </div>
    </section>

    <!-- Perangkat Desa -->
    <section id="perangkat-section" class="py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <span class="text-blue-600 font-bold tracking-wider uppercase text-sm">Pemerintahan</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Perangkat Desa</h2>
                <div class="w-20 h-1.5 bg-blue-600 mx-auto mt-4 rounded-full"></div>
            </div>

            <div id="perangkat-container" class="flex overflow-x-auto snap-x gap-6 pb-8 no-scrollbar content-loaded" style="display:none;"></div>

            <!-- Skeleton Loader -->
            <div class="flex overflow-hidden gap-6 pb-8 skeleton-loader">
                <?php for($i=0; $i<4; $i++): ?>
                <div class="bg-white rounded-xl shadow-sm overflow-hidden min-w-[280px] flex-shrink-0">
                    <div class="h-64 w-full bg-gray-200 skeleton"></div>
                    <div class="p-4 space-y-3">
                        <div class="h-5 bg-gray-200 rounded w-3/4 mx-auto skeleton"></div>
                        <div class="h-4 bg-gray-200 rounded w-1/2 mx-auto skeleton"></div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Berita Baru -->
    <section id="news-section" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div class="text-center md:text-left w-full">
                    <span class="text-blue-600 font-bold tracking-wider uppercase text-sm">Informasi Terkini</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Berita & Artikel</h2>
                    <div class="w-20 h-1.5 bg-blue-600 md:mx-0 mx-auto mt-4 rounded-full"></div>
                </div>
                <a href="/berita" class="hidden md:inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-blue-700 bg-blue-100 hover:bg-blue-200 transition">
                    Lihat Semua Berita
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div id="news-container" class="grid grid-cols-1 md:grid-cols-3 gap-8 content-loaded" style="display:none;"></div>

             <!-- Skeleton Loader -->
             <div class="grid grid-cols-1 md:grid-cols-3 gap-8 skeleton-loader">
                <?php for($i=0; $i<3; $i++): ?>
                <div class="bg-white rounded-xl shadow-sm overflow-hidden h-full border border-gray-100">
                    <div class="h-48 w-full bg-gray-200 skeleton"></div>
                    <div class="p-6 space-y-3">
                        <div class="h-4 bg-gray-200 rounded w-1/3 skeleton"></div>
                        <div class="h-6 bg-gray-200 rounded w-full skeleton"></div>
                        <div class="h-6 bg-gray-200 rounded w-2/3 skeleton"></div>
                        <div class="h-16 bg-gray-200 rounded w-full skeleton"></div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>

            <div class="mt-8 text-center md:hidden">
                <a href="/berita" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200">
                    Lihat Semua Berita
                </a>
            </div>
        </div>
    </section>

    <!-- Galeri -->
    <section id="gallery-section" class="py-20 px-4 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Galeri Desa</h2>
                <p class="mt-4 text-gray-500">Potret kegiatan dan keindahan Desa Batilai</p>
            </div>
            
            <div id="gallery-container">
                <!-- Fallback Loading -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 animate-pulse">
                    <div class="h-64 bg-gray-200 rounded-xl"></div>
                    <div class="h-64 bg-gray-200 rounded-xl"></div>
                    <div class="h-64 bg-gray-200 rounded-xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dokumen -->
    <section id="dokumen-section" class="py-20 bg-white">
       <div class="max-w-5xl mx-auto px-4">
            <div class="bg-blue-900 rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
                <div class="p-10 md:w-1/3 bg-blue-800 text-white flex flex-col justify-center">
                    <h3 class="text-2xl font-bold mb-4">Dokumen Publik</h3>
                    <p class="text-blue-200 mb-6">Unduh dokumen resmi desa, peraturan, dan laporan transparansi anggaran.</p>
                    <a href="#" class="inline-block bg-white text-blue-900 font-bold py-3 px-6 rounded-lg text-center hover:bg-gray-100 transition">
                        Arsip Lengkap
                    </a>
                </div>
                <div class="p-6 md:w-2/3 bg-white">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-12">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Dokumen</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Tanggal</th>
                                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="dokumen-body">
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center">
                                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                                        <p class="mt-2 text-sm text-gray-500">Memuat data...</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
       </div>
    </section>

    <!-- Footer & Contact -->
    <footer id="footer-section" class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 bg-blue-600 rounded flex items-center justify-center text-sm">DB</span>
                        Desa Batilai
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        Website resmi Desa Batilai, Kecamatan Pelaihari, Kabupaten Tanah Laut. Media transparansi dan pelayanan publik berbasis digital.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition"><span class="sr-only">Facebook</span><svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path></svg></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><span class="sr-only">Instagram</span><svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.315 2zm-1.196 1.422c-2.68 0-3.003.01-4.045.058-1.043.047-1.61.218-1.99.364-.492.19-.845.418-1.216.789-.37.37-.599.724-.789 1.216-.147.38-.318.947-.365 1.99-.047 1.042-.057 1.365-.058 4.045v.232c0 2.68.01 3.003.058 4.045.047 1.043.218 1.61.365 1.99.19.492.418.845.789 1.216.37.37.724.599 1.216.789.38.147.947.318 1.99.365 1.042.047 1.365.057 4.045.058h.232c2.68 0 3.003-.01 4.045-.058 1.043-.047 1.61-.218 1.99-.365.492-.19.845-.418 1.216-.789.37-.37.599-.724.789-1.216.147-.38.318-.947.365-1.99.047-1.042.057-1.365.058-4.045v-.232c0-2.68-.01-3.003-.058-4.045-.047-1.043-.218-1.61-.365-1.99-.19-.492-.418-.845-.789-1.216-.37-.37-.724-.599-1.216-.789-.38-.147-.947-.318-1.99-.365-1.042-.047-1.365-.057-4.045-.058h-.232zM12.315 5.922a6.393 6.393 0 110 12.786 6.393 6.393 0 010-12.786zm0 1.422a4.971 4.971 0 100 9.942 4.971 4.971 0 000-9.942zm7.143-3.056a1.056 1.056 0 110 2.112 1.056 1.056 0 010-2.112z" clip-rule="evenodd"></path></svg></a>
                    </div>
                </div>

                <!-- Kontak -->
                <div class="lg:col-span-1">
                    <h3 class="text-white font-bold mb-6">Hubungi Kami</h3>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-3 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span id="contact-address">Jl. A. Yani KM.20, Desa Batilai, Kec. Pelaihari, Kab. Tanah Laut, Kalimantan Selatan</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span id="contact-phone">0812-3456-7890</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span id="contact-email">admin@desabatilai.id</span>
                        </li>
                    </ul>
                </div>

                <!-- Jam Operasional -->
                <div>
                     <h3 class="text-white font-bold mb-6">Jam Operasional</h3>
                     <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex justify-between"><span>Senin - Kamis</span> <span class="text-white">08:00 - 16:00</span></li>
                        <li class="flex justify-between"><span>Jumat</span> <span class="text-white">08:00 - 11:30</span></li>
                        <li class="flex justify-between"><span>Sabtu - Minggu</span> <span class="text-red-400">Tutup</span></li>
                     </ul>
                </div>

                <!-- Peta -->
                <div class="h-48 bg-gray-800 rounded-xl overflow-hidden shadow-lg relative" id="map-container">
                    <!-- Embed Map Placeholder -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15923.447597143977!2d114.75549005!3d-3.83785005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de6f3d7b88950d9%3A0x4030bfbcaf7d0e0!2sBatilai%2C%20Kec.%20Pelaihari%2C%20Kabupaten%20Tanah%20Laut%2C%20Kalimantan%20Selatan!5e0!3m2!1sid!2sid!4v1646123456789" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                <p>&copy; <?= date('Y') ?> Pemerintah Desa Batilai. All rights reserved.</p>
                <div class="mt-4 md:mt-0">
                    Dibuat dengan <span class="text-red-500">♥</span> untuk Indonesia
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <!-- jQuery (Lightweight, CDN) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Custom Logic -->
    <script src="<?= base_url('assets/js/home.js') ?>"></script>
</body>
</html>
