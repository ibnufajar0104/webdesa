<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Artikel - Desa Batilai</title>
    <meta name="description" content="Informasi terkini dan berita seputar Desa Batilai, Kecamatan Pelaihari.">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#059669',
                        primaryDark: '#047857',
                        secondary: '#10b981',
                        accent: '#f59e0b',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        serif: ['Merriweather', 'serif'],
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html, body { transition: background-color 0.3s, color 0.3s; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-slate-900 dark:text-slate-100 flex flex-col min-h-screen font-sans antialiased">

    <!-- Top Bar (Official Info) -->
    <?= view('partials/topbar') ?>

    <!-- Navigation (Official Style) -->
    <?= view('partials/navbar') ?>

    <!-- Main Content -->
    <main class="flex-grow py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Page Header -->
            <div class="text-center mb-12">
                <span class="text-emerald-600 dark:text-emerald-400 font-bold tracking-wider uppercase text-xs md:text-sm">Informasi Desa</span>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mt-2 font-serif">Berita & Artikel</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-4 max-w-2xl mx-auto">
                    Kumpulan berita, artikel, dan informasi terkini seputar kegiatan dan perkembangan di Desa Batilai.
                </p>
            </div>

            <!-- Search Bar -->
            <div class="max-w-xl mx-auto mb-12 relative">
                <form id="search-form" class="relative">
                    <input type="text" id="search-input" name="q" placeholder="Cari berita..." class="w-full pl-6 pr-14 py-4 rounded-full border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 shadow-sm transition-all">
                    <button type="submit" class="absolute right-3 top-3 p-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>

            <!-- News Grid -->
            <div id="news-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Skeleton Loader -->
                <?php for($i=0; $i<6; $i++): ?>
                <div class="news-skeleton bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden animate-pulse">
                    <div class="h-48 bg-gray-200 dark:bg-slate-700"></div>
                    <div class="p-5 space-y-3">
                        <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-1/3"></div>
                        <div class="h-6 bg-gray-200 dark:bg-slate-700 rounded w-3/4"></div>
                        <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-full"></div>
                        <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-2/3"></div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>

            <!-- Empty State (Hidden) -->
            <div id="empty-state" class="hidden text-center py-20">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-slate-800 mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Tidak ada berita ditemukan</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Coba kata kunci lain atau kembali lagi nanti.</p>
            </div>

            <!-- Pagination -->
            <div id="pagination-container" class="mt-16 flex justify-center gap-2">
                <!-- Generated by JS -->
            </div>

        </div>
    </main>

    <!-- Footer & Contact (Official Dark) -->
    <?= view('partials/footer') ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>const BASE_URL = "<?= base_url() ?>";</script>
    <script src="<?= base_url('assets/js/home.js?v=' . time()) ?>"></script>
    <script>
        $(document).ready(function() {
            const API_BASE = "<?= base_url('api/news') ?>";
            const API_SEARCH = "<?= base_url('api/news/search') ?>";
            
            // State
            let currentPage = 1;
            let currentSearch = '';
            let perPage = 9;

            // Load initial from URL params
            const urlParams = new URLSearchParams(window.location.search);
            const q = urlParams.get('q');
            if (q) {
                currentSearch = q;
                $('#search-input').val(q);
            }
            const page = urlParams.get('page');
            if (page) {
                currentPage = parseInt(page);
            }

            fetchNews(currentPage, currentSearch);

            // Search Handler
            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                currentSearch = $('#search-input').val();
                currentPage = 1;
                updateUrl(currentPage, currentSearch);
                fetchNews(currentPage, currentSearch);
            });

            // Pagination Click Handler
            $(document).on('click', '.pagination-btn', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                if (page && page !== currentPage) {
                    currentPage = page;
                    updateUrl(currentPage, currentSearch);
                    fetchNews(currentPage, currentSearch);
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });

            function updateUrl(page, query) {
                const url = new URL(window.location);
                url.searchParams.set('page', page);
                if (query) {
                    url.searchParams.set('q', query);
                } else {
                    url.searchParams.delete('q');
                }
                window.history.pushState({}, '', url);
            }

            function fetchNews(page, query) {
                // Show skeletons
                $('#news-grid').html(generateSkeletons(6));
                $('#empty-state').addClass('hidden');
                $('#pagination-container').empty();

                const endpoint = query ? API_SEARCH : API_BASE;
                const params = {
                    page: page,
                    per_page: perPage,
                    q: query
                };

                $.getJSON(endpoint, params, function(response) {
                    if (response.status && response.data && response.data.length > 0) {
                        renderNews(response.data);
                        if (response.meta) {
                            renderPagination(response.meta);
                        }
                    } else {
                        $('#news-grid').empty();
                        $('#empty-state').removeClass('hidden');
                    }
                }).fail(function() {
                    $('#news-grid').html('<div class="col-span-full text-center text-red-500 py-10">Gagal memuat berita.</div>');
                });
            }

            function renderNews(news) {
                let html = '';
                news.forEach(item => {
                    const date = new Date(item.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
                    const img = item.cover_url || 'https://via.placeholder.com/400x300?text=No+Image';
                    const content = item.content ? item.content.replace(/<[^>]*>?/gm, '').substring(0, 100) + '...' : '...';
                    
                    html += `
                        <div class="group bg-white dark:bg-slate-800 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-slate-700 overflow-hidden flex flex-col h-full animate-fade-in-up">
                            <div class="relative h-48 overflow-hidden">
                                 <img src="${img}" alt="${item.title}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                                 <div class="absolute top-0 right-0 m-3 px-2 py-1 bg-white/90 backdrop-blur text-[10px] font-bold uppercase tracking-wider text-emerald-600 rounded shadow-sm">
                                    Berita
                                 </div>
                            </div>
                            <div class="p-5 flex-1 flex flex-col">
                                <div class="text-xs text-gray-400 mb-2 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    ${date}
                                </div>
                                <h3 class="font-bold text-gray-800 dark:text-white text-lg mb-2 line-clamp-2 leading-snug group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                    <a href="/berita/${item.slug}">${item.title}</a>
                                </h3>
                                <p class="text-gray-500 dark:text-gray-400 text-sm line-clamp-2 mb-4 flex-1">${content}</p>
                                <a href="/berita/${item.slug}" class="inline-flex items-center text-sm font-semibold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 mt-auto">
                                    Baca Selengkapnya <span class="group-hover:translate-x-1 transition-transform ml-1">&rarr;</span>
                                </a>
                            </div>
                        </div>
                    `;
                });
                $('#news-grid').html(html);
            }

            function renderPagination(meta) {
                const totalPage = meta.totalPage;
                const current = meta.page;
                let html = '';

                if (totalPage <= 1) return;

                // Prev
                if (current > 1) {
                    html += `<button class="pagination-btn px-4 py-2 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-slate-700 hover:text-emerald-600 transition" data-page="${current - 1}">&larr;</button>`;
                }

                // Page Numbers (Simple Logic: All pages if < 7, otherwise ellipsis)
                // For simplicity/robustness, let's show max 5 pages around current
                let start = Math.max(1, current - 2);
                let end = Math.min(totalPage, current + 2);

                if (start > 1) html += `<button class="pagination-btn px-3 py-2 text-gray-500" disabled>...</button>`;

                for (let i = start; i <= end; i++) {
                    const activeClass = i === current ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white dark:bg-slate-800 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-slate-700 hover:bg-emerald-50 dark:hover:bg-slate-700';
                    html += `<button class="pagination-btn px-4 py-2 border rounded-lg font-medium transition ${activeClass}" data-page="${i}">${i}</button>`;
                }

                if (end < totalPage) html += `<button class="pagination-btn px-3 py-2 text-gray-500" disabled>...</button>`;

                // Next
                if (current < totalPage) {
                    html += `<button class="pagination-btn px-4 py-2 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-slate-700 hover:text-emerald-600 transition" data-page="${current + 1}">&rarr;</button>`;
                }

                $('#pagination-container').html(html);
            }

            function generateSkeletons(count) {
                let html = '';
                for(let i=0; i<count; i++) {
                    html += `
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden animate-pulse">
                        <div class="h-48 bg-gray-200 dark:bg-slate-700"></div>
                        <div class="p-5 space-y-3">
                            <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-1/3"></div>
                            <div class="h-6 bg-gray-200 dark:bg-slate-700 rounded w-3/4"></div>
                            <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-full"></div>
                            <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-2/3"></div>
                        </div>
                    </div>`;
                }
                return html;
            }
        });
    </script>
</body>
</html>
