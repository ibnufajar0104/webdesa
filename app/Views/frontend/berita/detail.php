<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Desa Batilai</title>
    <meta name="description" content="Berita dan Artikel Desa Batilai">
    
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
        .prose img { border-radius: 0.75rem; margin-top: 2rem; margin-bottom: 2rem; width: 100%; object-fit: cover; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-slate-900 dark:text-slate-100 flex flex-col min-h-screen font-sans antialiased">

    <!-- Top Bar (Official Info) -->
    <?= view('partials/topbar') ?>

    <!-- Navigation (Official Style) -->
    <?= view('partials/navbar') ?>

    <!-- Main Content -->
    <main class="flex-grow pt-10 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12">
                
                <!-- Left Column: News Detail -->
                <div class="w-full lg:w-2/3">
                    <!-- Skeleton Loader -->
                    <div id="detail-skeleton" class="animate-pulse space-y-6">
                        <div class="h-8 bg-gray-200 dark:bg-slate-700 rounded w-3/4"></div>
                        <div class="h-64 bg-gray-200 dark:bg-slate-700 rounded-xl w-full"></div>
                        <div class="space-y-3">
                            <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-full"></div>
                            <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-full"></div>
                            <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-5/6"></div>
                        </div>
                    </div>

                    <!-- Actual Content -->
                    <article id="detail-content" class="hidden">
                        <header class="mb-8">
                            <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span id="news-date"></span>
                                </span>
                            </div>
                            <h1 id="news-title" class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white font-serif leading-tight"></h1>
                        </header>

                        <figure class="mb-10 relative group rounded-2xl overflow-hidden shadow-lg">
                            <img id="news-image" src="" alt="Cover Image" class="w-full h-auto object-cover group-hover:scale-105 transition duration-700">
                        </figure>

                        <div id="news-body" class="prose prose-lg prose-emerald dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed">
                            <!-- Injected HTML -->
                        </div>
                    </article>
                </div>

                <!-- Right Column: Sidebar (Related News) -->
                <aside class="w-full lg:w-1/3 space-y-8">
                     <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-700 sticky top-24">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 font-serif border-l-4 border-emerald-500 pl-3">Berita Lainnya</h3>
                        <div id="related-news-container" class="space-y-6">
                            <!-- Skeleton Related -->
                             <div class="animate-pulse space-y-6">
                                <div class="flex gap-4">
                                    <div class="w-20 h-20 bg-gray-200 dark:bg-slate-700 rounded-lg shrink-0"></div>
                                    <div class="flex-1 space-y-2">
                                        <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-full"></div>
                                        <div class="h-3 bg-gray-200 dark:bg-slate-700 rounded w-1/2"></div>
                                    </div>
                                </div>
                             </div>
                        </div>
                     </div>
                </aside>

            </div>
        </div>
    </main>

    <!-- Footer & Contact (Official Dark) -->
    <?= view('partials/footer') ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Reusing home.js for navbar logic -->
    <script>const BASE_URL = "<?= base_url() ?>";</script>
    <script src="<?= base_url('assets/js/home.js') ?>"></script> 
    
    <script>
        const SLUG = "<?= $slug ?>";
        const API_NEWS = "<?= base_url('api/news') ?>";

        $(document).ready(function() {
            // Fetch Detail
            $.getJSON(`${API_NEWS}/${SLUG}`, function(response) {
                if(response.status && response.data) {
                    const d = response.data;
                    
                    // Populate Main Content
                    $('#news-title').text(d.title);
                    $('#news-date').text(formatDate(d.created_at));
                    $('#news-image').attr('src', d.cover_url);
                    $('#news-body').html(d.content);
                    document.title = `${d.title} - Desa Batilai`;

                    // Show content, hide skeleton
                    $('#detail-skeleton').addClass('hidden');
                    $('#detail-content').fadeIn();

                    // Populate Related
                    if(response.other_news && response.other_news.length > 0) {
                         let relatedHtml = '';
                         response.other_news.forEach(item => {
                             relatedHtml += `
                                <a href="/berita/${item.slug}" class="flex gap-4 group hover:bg-gray-50 dark:hover:bg-slate-700/50 p-2 rounded-lg transition">
                                    <div class="w-20 h-20 shrink-0 rounded-lg overflow-hidden shadow-sm">
                                        <img src="${item.cover_url}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <h4 class="text-sm font-bold text-gray-900 dark:text-white line-clamp-2 group-hover:text-emerald-600 transition-colors">${item.title}</h4>
                                        <span class="text-xs text-gray-400 mt-1">${formatDate(item.created_at)}</span>
                                    </div>
                                </a>
                             `;
                         });
                         $('#related-news-container').html(relatedHtml);
                    } else {
                        $('#related-news-container').html('<p class="text-gray-500 text-sm">Tidak ada berita lain.</p>');
                    }

                } else {
                    $('#detail-content').html('<div class="text-center py-20 text-red-500">Berita tidak ditemukan</div>').removeClass('hidden');
                    $('#detail-skeleton').addClass('hidden');
                }
            }).fail(function() {
                 $('#detail-content').html('<div class="text-center py-20 text-red-500">Gagal memuat berita</div>').removeClass('hidden');
                 $('#detail-skeleton').addClass('hidden');
            });

            function formatDate(dateString) {
                if(!dateString) return '';
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                return new Date(dateString).toLocaleDateString('id-ID', options);
            }
        });
    </script>
</body>
</html>
