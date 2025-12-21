<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Website Desa - Portal Informasi Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        /* ====== Theme: calm / minimal ====== */
        :root {
            --accent: #1f2937;
            /* slate-800 */
            --accent-2: #334155;
            /* slate-700 */
            --ring: rgba(15, 23, 42, .08);
            --border: rgba(15, 23, 42, .10);
            --shadow: 0 10px 30px rgba(2, 6, 23, .06);
        }

        .card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 1.25rem;
            box-shadow: 0 8px 20px rgba(2, 6, 23, .04);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow);
        }

        .pill {
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, .75);
            backdrop-filter: blur(8px);
        }

        /* Slider: simple fade */
        .slider-container {
            position: relative;
            overflow: hidden;
        }

        .slide {
            display: none;
        }

        .slide.active {
            display: block;
            animation: fade .6s ease;
        }

        @keyframes fade {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        /* Button: minimal */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            padding: .9rem 1.25rem;
            font-weight: 600;
            transition: all .2s ease;
            gap: .6rem;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 8px 20px rgba(2, 6, 23, .12);
        }

        .btn-primary:hover {
            background: #111827;
            transform: translateY(-1px);
        }

        .btn-ghost {
            background: #fff;
            border: 1px solid var(--border);
            color: #0f172a;
        }

        .btn-ghost:hover {
            background: #f8fafc;
            transform: translateY(-1px);
        }

        /* Dot */
        .dot {
            width: .6rem;
            height: .6rem;
            border-radius: 9999px;
            background: rgba(255, 255, 255, .45);
        }

        .dot.active {
            background: rgba(255, 255, 255, .95);
        }

        /* Navbar shadow on scroll */
        .nav-shadow {
            box-shadow: 0 10px 30px rgba(2, 6, 23, .08);
        }

        /* Small banner (calm) */
        .banner-dev {
            background: #0f172a;
            /* slate-900 */
            color: rgba(255, 255, 255, .92);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900">

    <!-- Calm Dev Banner -->
    <div class="banner-dev py-2 text-center text-xs md:text-sm fixed w-full top-0 z-50">
        <div class="container mx-auto px-4">
            <i class="fas fa-circle-info mr-2"></i>
            Website masih tahap pengembangan — data bersifat contoh/percobaan.
        </div>
    </div>

    <!-- Navbar (minimal) -->
    <nav class="bg-white/90 backdrop-blur border-b border-slate-200 fixed w-full top-9 z-40 transition-all" id="navbar">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-slate-900 text-white flex items-center justify-center font-bold">
                        DS
                    </div>
                    <div class="leading-tight">
                        <h1 class="text-lg md:text-xl font-bold text-slate-900">Desa Sejahtera</h1>
                        <p class="text-xs text-slate-500">Portal Informasi Digital</p>
                    </div>
                </div>

                <div class="hidden lg:flex items-center gap-7 text-sm">
                    <a class="text-slate-600 hover:text-slate-900 transition" href="#beranda">Beranda</a>
                    <a class="text-slate-600 hover:text-slate-900 transition" href="#statistik">Statistik</a>
                    <a class="text-slate-600 hover:text-slate-900 transition" href="#perangkat">Perangkat</a>
                    <a class="text-slate-600 hover:text-slate-900 transition" href="#berita">Berita</a>
                    <a class="text-slate-600 hover:text-slate-900 transition" href="#galeri">Galeri</a>
                    <a class="btn btn-primary" href="#kontak">
                        Kontak
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>

                <button class="lg:hidden text-slate-800">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Slider (neutral overlay) -->
    <section id="beranda" class="mt-24 slider-container">
        <!-- Slide 1 -->
        <div class="slide active relative h-[86vh] md:h-screen">
            <img src="https://images.unsplash.com/photo-1500076656116-558758c991c1?w=1920" class="w-full h-full object-cover" alt="Slide 1">
            <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/45 to-black/20"></div>

            <div class="absolute inset-0 flex items-center">
                <div class="container mx-auto px-6">
                    <div class="max-w-3xl">
                        <div class="inline-flex items-center gap-2 mb-5 px-4 py-2 rounded-full pill text-white/90 bg-white/10 border border-white/20">
                            <i class="fas fa-map-marker-alt"></i>
                            <span class="text-sm">Kecamatan Makmur, Kabupaten Jaya</span>
                        </div>

                        <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight">
                            Selamat Datang di<br>
                            <span class="text-white/90">Desa Sejahtera</span>
                        </h1>
                        <p class="mt-5 text-base md:text-lg text-white/80 leading-relaxed max-w-2xl">
                            Portal informasi dan layanan desa yang rapi, mudah diakses, dan transparan untuk warga.
                        </p>

                        <div class="mt-8 flex flex-col sm:flex-row gap-3">
                            <a href="#statistik" class="btn btn-primary">
                                Jelajahi
                                <i class="fas fa-arrow-down text-xs"></i>
                            </a>
                            <a href="#kontak" class="btn btn-ghost">
                                <i class="fas fa-phone text-xs"></i>
                                Hubungi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide relative h-[86vh] md:h-screen">
            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=1920" class="w-full h-full object-cover" alt="Slide 2">
            <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/45 to-black/20"></div>

            <div class="absolute inset-0 flex items-center">
                <div class="container mx-auto px-6">
                    <div class="max-w-3xl">
                        <div class="inline-flex items-center gap-2 mb-5 px-4 py-2 rounded-full pill text-white/90 bg-white/10 border border-white/20">
                            <i class="fas fa-leaf"></i>
                            <span class="text-sm">Lingkungan Hijau & Asri</span>
                        </div>
                        <h2 class="text-4xl md:text-6xl font-bold text-white leading-tight">
                            Desa Asri<br>
                            <span class="text-white/90">Lingkungan Bersih</span>
                        </h2>
                        <p class="mt-5 text-base md:text-lg text-white/80 leading-relaxed max-w-2xl">
                            Program kebersihan, penghijauan, dan gotong royong untuk kualitas hidup yang lebih baik.
                        </p>
                        <div class="mt-8">
                            <a href="#galeri" class="btn btn-primary">
                                Lihat Galeri
                                <i class="fas fa-images text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="slide relative h-[86vh] md:h-screen">
            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1920" class="w-full h-full object-cover" alt="Slide 3">
            <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/45 to-black/20"></div>

            <div class="absolute inset-0 flex items-center">
                <div class="container mx-auto px-6">
                    <div class="max-w-3xl">
                        <div class="inline-flex items-center gap-2 mb-5 px-4 py-2 rounded-full pill text-white/90 bg-white/10 border border-white/20">
                            <i class="fas fa-hands-helping"></i>
                            <span class="text-sm">Pelayanan & Administrasi</span>
                        </div>
                        <h2 class="text-4xl md:text-6xl font-bold text-white leading-tight">
                            Pelayanan Prima<br>
                            <span class="text-white/90">Untuk Warga</span>
                        </h2>
                        <p class="mt-5 text-base md:text-lg text-white/80 leading-relaxed max-w-2xl">
                            Informasi layanan desa, jam operasional, dan kontak yang jelas dan mudah ditemukan.
                        </p>
                        <div class="mt-8">
                            <a href="#kontak" class="btn btn-primary">
                                Layanan & Kontak
                                <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <button onclick="changeSlide(-1)" class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/15 hover:bg-white/25 text-white p-3 rounded-full backdrop-blur border border-white/20">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button onclick="changeSlide(1)" class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/15 hover:bg-white/25 text-white p-3 rounded-full backdrop-blur border border-white/20">
            <i class="fas fa-chevron-right"></i>
        </button>

        <div class="absolute bottom-7 left-1/2 -translate-x-1/2 flex gap-2">
            <button onclick="goToSlide(0)" class="dot slide-dot"></button>
            <button onclick="goToSlide(1)" class="dot slide-dot"></button>
            <button onclick="goToSlide(2)" class="dot slide-dot"></button>
        </div>
    </section>

    <!-- Statistik (minimal cards) -->
    <section id="statistik" class="py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-slate-200 bg-white text-slate-700 text-sm font-semibold">
                    Data Terkini
                </span>
                <h2 class="mt-4 text-3xl md:text-5xl font-bold text-slate-900">Statistik Penduduk</h2>
                <p class="mt-4 text-slate-600 max-w-2xl mx-auto">
                    Ringkasan demografi untuk mendukung perencanaan pembangunan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card p-6">
                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 rounded-xl bg-slate-900 text-white flex items-center justify-center">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="text-xs text-slate-500">Update: hari ini</span>
                    </div>
                    <div class="mt-5 text-3xl font-bold text-slate-900">5,432</div>
                    <div class="text-slate-600 mt-1">Total Penduduk</div>
                    <div class="mt-4 text-xs text-slate-500">+2.5% dari tahun lalu</div>
                </div>

                <div class="card p-6">
                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 rounded-xl bg-slate-100 text-slate-900 flex items-center justify-center border border-slate-200">
                            <i class="fas fa-male"></i>
                        </div>
                        <span class="text-xs text-slate-500">Proporsi</span>
                    </div>
                    <div class="mt-5 text-3xl font-bold text-slate-900">2,718</div>
                    <div class="text-slate-600 mt-1">Laki-laki</div>
                    <div class="mt-4 text-xs text-slate-500">50.04%</div>
                </div>

                <div class="card p-6">
                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 rounded-xl bg-slate-100 text-slate-900 flex items-center justify-center border border-slate-200">
                            <i class="fas fa-female"></i>
                        </div>
                        <span class="text-xs text-slate-500">Proporsi</span>
                    </div>
                    <div class="mt-5 text-3xl font-bold text-slate-900">2,714</div>
                    <div class="text-slate-600 mt-1">Perempuan</div>
                    <div class="mt-4 text-xs text-slate-500">49.96%</div>
                </div>

                <div class="card p-6">
                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 rounded-xl bg-slate-100 text-slate-900 flex items-center justify-center border border-slate-200">
                            <i class="fas fa-home"></i>
                        </div>
                        <span class="text-xs text-slate-500">Status</span>
                    </div>
                    <div class="mt-5 text-3xl font-bold text-slate-900">1,452</div>
                    <div class="text-slate-600 mt-1">Kepala Keluarga</div>
                    <div class="mt-4 text-xs text-slate-500">Data terverifikasi</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Perangkat Desa (tone down badges) -->
    <section id="perangkat" class="py-20 bg-white border-y border-slate-200">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-slate-200 bg-slate-50 text-slate-700 text-sm font-semibold">
                    Tim Kami
                </span>
                <h2 class="mt-4 text-3xl md:text-5xl font-bold">Perangkat Desa</h2>
                <p class="mt-4 text-slate-600 max-w-2xl mx-auto">Struktur organisasi pemerintahan desa.</p>
            </div>

            <div class="relative">
                <div id="perangkatSlider" class="flex transition-transform duration-700 ease-in-out">
                    <!-- Slide 1 -->
                    <div class="min-w-full px-2">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="card p-6 text-center">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400" class="w-28 h-28 rounded-full mx-auto object-cover border border-slate-200" alt="Kepala Desa">
                                <h3 class="mt-4 font-bold text-lg">Budi Santoso, S.Sos</h3>
                                <p class="text-slate-600 text-sm">Kepala Desa</p>
                                <div class="mt-4 inline-flex items-center gap-2 text-xs text-slate-600 px-3 py-2 rounded-full border border-slate-200 bg-slate-50">
                                    <i class="fas fa-calendar-alt"></i><span>Periode 2019–2025</span>
                                </div>
                            </div>

                            <div class="card p-6 text-center">
                                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400" class="w-28 h-28 rounded-full mx-auto object-cover border border-slate-200" alt="Sekretaris">
                                <h3 class="mt-4 font-bold text-lg">Siti Aminah, S.AP</h3>
                                <p class="text-slate-600 text-sm">Sekretaris Desa</p>
                                <div class="mt-4 flex justify-center gap-2">
                                    <span class="text-xs px-3 py-1 rounded-full border border-slate-200 bg-slate-50 text-slate-700">Administrasi</span>
                                    <span class="text-xs px-3 py-1 rounded-full border border-slate-200 bg-slate-50 text-slate-700">Keuangan</span>
                                </div>
                            </div>

                            <div class="card p-6 text-center">
                                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400" class="w-28 h-28 rounded-full mx-auto object-cover border border-slate-200" alt="Bendahara">
                                <h3 class="mt-4 font-bold text-lg">Ahmad Wijaya, SE</h3>
                                <p class="text-slate-600 text-sm">Bendahara Desa</p>
                                <div class="mt-4 flex justify-center gap-2">
                                    <span class="text-xs px-3 py-1 rounded-full border border-slate-200 bg-slate-50 text-slate-700">Keuangan</span>
                                    <span class="text-xs px-3 py-1 rounded-full border border-slate-200 bg-slate-50 text-slate-700">Pelaporan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="min-w-full px-2">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="card p-6 text-center">
                                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400" class="w-28 h-28 rounded-full mx-auto object-cover border border-slate-200" alt="Kaur">
                                <h3 class="mt-4 font-bold text-lg">Dedi Kusuma, ST</h3>
                                <p class="text-slate-600 text-sm">Kaur Pembangunan</p>
                                <div class="mt-4">
                                    <span class="text-xs px-3 py-1 rounded-full border border-slate-200 bg-slate-50 text-slate-700">Infrastruktur</span>
                                </div>
                            </div>

                            <div class="card p-6 text-center">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400" class="w-28 h-28 rounded-full mx-auto object-cover border border-slate-200" alt="Kaur">
                                <h3 class="mt-4 font-bold text-lg">Rina Lestari, S.Sos</h3>
                                <p class="text-slate-600 text-sm">Kaur Kesejahteraan</p>
                                <div class="mt-4">
                                    <span class="text-xs px-3 py-1 rounded-full border border-slate-200 bg-slate-50 text-slate-700">Sosial</span>
                                </div>
                            </div>

                            <div class="card p-6 text-center">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400" class="w-28 h-28 rounded-full mx-auto object-cover border border-slate-200" alt="Kasi">
                                <h3 class="mt-4 font-bold text-lg">Eko Prasetyo, S.IP</h3>
                                <p class="text-slate-600 text-sm">Kasi Pemerintahan</p>
                                <div class="mt-4">
                                    <span class="text-xs px-3 py-1 rounded-full border border-slate-200 bg-slate-50 text-slate-700">Pemerintahan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button onclick="changePerangkatSlide(-1)" class="absolute left-0 top-1/2 -translate-y-1/2 bg-white border border-slate-200 shadow-sm hover:shadow p-3 rounded-full">
                    <i class="fas fa-chevron-left text-slate-700"></i>
                </button>
                <button onclick="changePerangkatSlide(1)" class="absolute right-0 top-1/2 -translate-y-1/2 bg-white border border-slate-200 shadow-sm hover:shadow p-3 rounded-full">
                    <i class="fas fa-chevron-right text-slate-700"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Berita (no category colors) -->
    <section id="berita" class="py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-slate-200 bg-white text-slate-700 text-sm font-semibold">
                    <i class="fas fa-newspaper"></i> Update Terbaru
                </span>
                <h2 class="mt-4 text-3xl md:text-5xl font-bold">Berita & Kegiatan</h2>
                <p class="mt-4 text-slate-600 max-w-2xl mx-auto">Informasi terkini seputar kegiatan dan perkembangan desa.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card -->
                <article class="card overflow-hidden">
                    <div class="h-52 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600" class="w-full h-full object-cover hover:scale-105 transition duration-500" alt="Berita">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-4 text-xs text-slate-500">
                            <span><i class="fas fa-calendar mr-1"></i>15 Des 2024</span>
                            <span><i class="fas fa-user mr-1"></i>Admin</span>
                        </div>
                        <h3 class="mt-3 font-bold text-lg text-slate-900">Musyawarah Pembangunan Desa 2025</h3>
                        <p class="mt-2 text-slate-600 text-sm leading-relaxed">
                            Kegiatan musyawarah pembangunan desa melibatkan warga untuk menentukan program prioritas...
                        </p>
                        <a href="#" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-slate-900 hover:text-black">
                            Baca selengkapnya <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </article>

                <article class="card overflow-hidden">
                    <div class="h-52 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?w=600" class="w-full h-full object-cover hover:scale-105 transition duration-500" alt="Berita">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-4 text-xs text-slate-500">
                            <span><i class="fas fa-calendar mr-1"></i>10 Des 2024</span>
                            <span><i class="fas fa-user mr-1"></i>Admin</span>
                        </div>
                        <h3 class="mt-3 font-bold text-lg text-slate-900">Gotong Royong Membersihkan Lingkungan</h3>
                        <p class="mt-2 text-slate-600 text-sm leading-relaxed">
                            Warga desa bergotong royong menjaga kebersihan lingkungan untuk hidup lebih sehat...
                        </p>
                        <a href="#" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-slate-900 hover:text-black">
                            Baca selengkapnya <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </article>

                <article class="card overflow-hidden">
                    <div class="h-52 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=600" class="w-full h-full object-cover hover:scale-105 transition duration-500" alt="Berita">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-4 text-xs text-slate-500">
                            <span><i class="fas fa-calendar mr-1"></i>5 Des 2024</span>
                            <span><i class="fas fa-user mr-1"></i>Admin</span>
                        </div>
                        <h3 class="mt-3 font-bold text-lg text-slate-900">Pelatihan UMKM untuk Warga Desa</h3>
                        <p class="mt-2 text-slate-600 text-sm leading-relaxed">
                            Pelatihan untuk meningkatkan keterampilan dan ekonomi warga melalui UMKM...
                        </p>
                        <a href="#" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-slate-900 hover:text-black">
                            Baca selengkapnya <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </article>
            </div>

            <div class="text-center mt-10">
                <a href="#" class="btn btn-primary">
                    Lihat Semua Berita
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Galeri (keep simple) -->
    <section id="galeri" class="py-20 bg-white border-y border-slate-200">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-slate-200 bg-slate-50 text-slate-700 text-sm font-semibold">
                    <i class="fas fa-images"></i> Dokumentasi
                </span>
                <h2 class="mt-4 text-3xl md:text-5xl font-bold">Galeri Kegiatan</h2>
                <p class="mt-4 text-slate-600 max-w-2xl mx-auto">Dokumentasi visual berbagai kegiatan dan momen penting.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Reuse your images; overlay minimal -->
                <div class="card overflow-hidden h-56 md:h-72">
                    <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=500" class="w-full h-full object-cover hover:scale-105 transition duration-500" alt="Galeri">
                </div>
                <div class="card overflow-hidden h-56 md:h-72">
                    <img src="https://images.unsplash.com/photo-1517457373958-b7bdd4587205?w=500" class="w-full h-full object-cover hover:scale-105 transition duration-500" alt="Galeri">
                </div>
                <div class="card overflow-hidden h-56 md:h-72">
                    <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=500" class="w-full h-full object-cover hover:scale-105 transition duration-500" alt="Galeri">
                </div>
                <div class="card overflow-hidden h-56 md:h-72">
                    <img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?w=500" class="w-full h-full object-cover hover:scale-105 transition duration-500" alt="Galeri">
                </div>
            </div>
        </div>
    </section>

    <!-- Jam Pelayanan (white + border, no gradient) -->
    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-slate-200 bg-white text-slate-700 text-sm font-semibold">
                    <i class="fas fa-clock"></i> Waktu Layanan
                </span>
                <h2 class="mt-4 text-3xl md:text-5xl font-bold">Jam Pelayanan</h2>
                <p class="mt-4 text-slate-600 max-w-2xl mx-auto">Kami siap melayani dengan profesional dan ramah.</p>
            </div>

            <div class="max-w-4xl mx-auto grid md:grid-cols-2 gap-6">
                <div class="card p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-slate-900 text-white flex items-center justify-center">
                            <i class="fas fa-calendar-week"></i>
                        </div>
                        <div>
                            <div class="font-bold">Senin – Kamis</div>
                            <div class="text-sm text-slate-500">Hari kerja</div>
                        </div>
                    </div>
                    <div class="mt-5 text-2xl font-bold">08:00 – 15:00</div>
                    <div class="text-sm text-slate-500">WIB</div>
                </div>

                <div class="card p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-slate-100 border border-slate-200 text-slate-900 flex items-center justify-center">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div>
                            <div class="font-bold">Jumat</div>
                            <div class="text-sm text-slate-500">Hari kerja pendek</div>
                        </div>
                    </div>
                    <div class="mt-5 text-2xl font-bold">08:00 – 11:00</div>
                    <div class="text-sm text-slate-500">WIB</div>
                </div>

                <div class="card p-6 md:col-span-2">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-xl bg-slate-100 border border-slate-200 text-slate-900 flex items-center justify-center">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                            <div>
                                <div class="font-bold">Sabtu – Minggu</div>
                                <div class="text-sm text-slate-500">Akhir pekan</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-slate-900">TUTUP</div>
                            <div class="text-sm text-slate-500">Libur akhir pekan</div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 border border-slate-200 bg-white rounded-2xl p-6 text-sm text-slate-600">
                    <div class="font-semibold text-slate-900 mb-2"><i class="fas fa-info-circle mr-2"></i>Informasi</div>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2"><i class="fas fa-check text-xs"></i>Harap membawa persyaratan lengkap</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-xs"></i>Antrian dilayani sesuai urutan</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-xs"></i>Konfirmasi jika ada perubahan jadwal</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak & Maps (minimal icons) -->
    <section id="kontak" class="py-20 bg-white border-t border-slate-200">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-slate-200 bg-slate-50 text-slate-700 text-sm font-semibold">
                    <i class="fas fa-phone-alt"></i> Hubungi Kami
                </span>
                <h2 class="mt-4 text-3xl md:text-5xl font-bold">Kontak & Lokasi</h2>
                <p class="mt-4 text-slate-600 max-w-2xl mx-auto">Informasi kontak dan lokasi kantor desa.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="card p-6">
                        <div class="flex gap-4">
                            <div class="w-11 h-11 rounded-xl bg-slate-900 text-white flex items-center justify-center shrink-0">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <div class="font-bold">Alamat Kantor</div>
                                <p class="text-sm text-slate-600 mt-1">
                                    Jl. Desa Sejahtera No. 123, Kecamatan Makmur, Kabupaten Jaya, Provinsi Bahagia, Indonesia
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card p-6">
                        <div class="flex gap-4">
                            <div class="w-11 h-11 rounded-xl bg-slate-100 border border-slate-200 text-slate-900 flex items-center justify-center shrink-0">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <div class="font-bold">Telepon</div>
                                <p class="text-sm text-slate-600 mt-1">(021) 12345678 • +62 812-3456-7890</p>
                            </div>
                        </div>
                    </div>

                    <div class="card p-6">
                        <div class="flex gap-4">
                            <div class="w-11 h-11 rounded-xl bg-slate-100 border border-slate-200 text-slate-900 flex items-center justify-center shrink-0">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <div class="font-bold">Email</div>
                                <p class="text-sm text-slate-600 mt-1">info@desasejahtera.id • admin@desasejahtera.id</p>
                            </div>
                        </div>
                    </div>

                    <div class="card p-6">
                        <div class="font-bold mb-3">Media Sosial</div>
                        <div class="flex gap-2">
                            <a href="#" class="btn btn-ghost px-4 py-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-ghost px-4 py-2"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="btn btn-ghost px-4 py-2"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="btn btn-ghost px-4 py-2"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>

                <div class="card p-3 overflow-hidden min-h-[520px]">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127417.87169976443!2d114.5247295!3d-3.3186667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de423b1c106b5a5%3A0x5c3b7d596e1e3d48!2sBanjarmasin%2C%20Kota%20Banjarmasin%2C%20Kalimantan%20Selatan!5e0!3m2!1sid!2sid!4v1234567890"
                        width="100%" height="100%"
                        style="border:0; min-height: 520px; border-radius: 16px;"
                        allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer (simple) -->
    <footer class="bg-slate-950 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center font-bold">DS</div>
                        <div>
                            <div class="font-bold text-lg">Desa Sejahtera</div>
                            <div class="text-xs text-white/60">Portal Informasi Digital</div>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-white/65 max-w-xl">
                        Membangun desa yang maju, mandiri, dan berdaya saing melalui inovasi digital dan pemberdayaan masyarakat.
                    </p>
                </div>

                <div class="text-sm text-white/60">
                    <div>&copy; 2024 Desa Sejahtera</div>
                    <div class="mt-2 flex gap-4">
                        <a href="#" class="hover:text-white transition">Privasi</a>
                        <a href="#" class="hover:text-white transition">S&K</a>
                        <a href="#" class="hover:text-white transition">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to top -->
    <button id="scrollTop" class="fixed bottom-6 right-6 w-12 h-12 rounded-full bg-slate-900 text-white shadow-lg opacity-0 invisible transition-all hover:-translate-y-0.5 z-50">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // ===== Hero Slider =====
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.slide-dot');

        function setDotActive(idx) {
            dots.forEach((d, i) => d.classList.toggle('active', i === idx));
        }

        function showSlide(n) {
            slides[currentSlide].classList.remove('active');
            currentSlide = (n + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
            setDotActive(currentSlide);
        }

        function changeSlide(n) {
            showSlide(currentSlide + n);
        }

        function goToSlide(n) {
            showSlide(n);
        }

        setInterval(() => changeSlide(1), 6500);
        setDotActive(0);

        // ===== Perangkat Slider =====
        let currentPerangkatSlide = 0;
        const perangkatSlider = document.getElementById('perangkatSlider');
        const totalPerangkatSlides = 2;

        function changePerangkatSlide(direction) {
            currentPerangkatSlide += direction;
            if (currentPerangkatSlide < 0) currentPerangkatSlide = totalPerangkatSlides - 1;
            if (currentPerangkatSlide >= totalPerangkatSlides) currentPerangkatSlide = 0;
            perangkatSlider.style.transform = `translateX(-${currentPerangkatSlide * 100}%)`;
        }

        // ===== Smooth scroll =====
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', (e) => {
                const target = document.querySelector(a.getAttribute('href'));
                if (!target) return;
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });

        // ===== Navbar scroll shadow =====
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('nav-shadow', window.pageYOffset > 80);
        });

        // ===== Scroll to top =====
        const scrollTopBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 400) {
                scrollTopBtn.classList.remove('opacity-0', 'invisible');
                scrollTopBtn.classList.add('opacity-100', 'visible');
            } else {
                scrollTopBtn.classList.add('opacity-0', 'invisible');
                scrollTopBtn.classList.remove('opacity-100', 'visible');
            }
        });
        scrollTopBtn.addEventListener('click', () => window.scrollTo({
            top: 0,
            behavior: 'smooth'
        }));
    </script>
</body>

</html>