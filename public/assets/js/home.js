/**
 * Desa Batilai Homepage Logic
 * Handles API data fetching and UI rendering.
 */

$(document).ready(function () {
    // API Endpoints
    // API Endpoints
    // Use global BASE_URL if available (defined in layout), otherwise fallback to root
    const baseUrl = (typeof BASE_URL !== 'undefined') ? BASE_URL : '';
    // Ensure no double slashes if BASE_URL ends with /
    const cleanBaseUrl = baseUrl.endsWith('/') ? baseUrl.slice(0, -1) : baseUrl;
    const API_BASE = `${cleanBaseUrl}/api`;

    const textApi = 'val';
    const FALLBACK_IMAGE = 'https://via.placeholder.com/400x300?text=No+Image';

    // --- Utility Functions ---

    function formatDate(dateString) {
        if (!dateString) return '-';
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }

    function showSkeleton(selector) {
        $(selector).find('.skeleton-loader').show();
        $(selector).find('.content-loaded').hide();
    }

    function hideSkeleton(selector) {
        $(selector).find('.skeleton-loader').fadeOut(300, function () {
            $(selector).find('.content-loaded').fadeIn(300);
        });
    }

    // --- Theme & Search Logic ---
    function initTheme() {
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }

    function toggleTheme() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
        } else {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
        }
    }

    $('#theme-toggle-btn, #mobile-theme-btn').click(function () {
        toggleTheme();
    });

    // Search Handler (Global Redirect)
    // Search Handler (Global Redirect) - Removed in favor of HTML form
    // The main hero search is now a standard <form> submission to /berita


    // Document Search (Client-side Filter)
    $('#dokumen-search').on('keyup', function () {
        const val = $(this).val().toLowerCase();
        $('#dokumen-container > div').each(function () {
            const text = $(this).text().toLowerCase();
            $(this).toggle(text.indexOf(val) > -1);
        });
    });

    // Init Theme
    initTheme();



    // --- Dynamic Menu ---
    function loadMenu() {
        // Helper to normalize URL
        const formatUrl = (url) => {
            if (!url) return 'javascript:void(0)';
            if (url.startsWith('http') || url.startsWith('//') || url.startsWith('#') || url.startsWith('javascript:')) {
                return url;
            }
            // Ensure URL doesn't start with slash if we are appending to base_url which might already have trailing slash
            // CodeIgniter base_url() usually matches valid URL.
            // But let's handle "url" vs "/url"

            // If BASE_URL is defined globaly
            if (typeof BASE_URL !== 'undefined') {
                // Remove leading slash from url to avoid double slash if BASE_URL has it, or jumasihst strictly join
                const cleanUrl = url.startsWith('/') ? url.substring(1) : url;
                const cleanBase = BASE_URL.endsWith('/') ? BASE_URL : BASE_URL + '/';
                return cleanBase + cleanUrl;
            }

            return url.startsWith('/') ? url : '/' + url;
        };



        // Mobile Renderer
        const renderMobile = (items) => {
            let mobileHtml = '';

            const renderMobileItem = (item) => {


                const hasChildren = item.children && item.children.length > 0;
                const url = formatUrl(item.url);
                const target = item.target || '_self';

                if (hasChildren) {
                    return `
                        <div class="mobile-menu-item">
                            <button class="w-full flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-lg transition-colors" onclick="$(this).next().slideToggle(200)">
                                ${item.label}
                                <svg class="w-4 h-4 text-gray-400 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div class="hidden pl-4 space-y-1 overflow-hidden transition-all duration-200">
                                ${item.children.map(child => `
                                    <a href="${formatUrl(child.url)}" target="${child.target || '_self'}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-gray-50 dark:hover:bg-slate-800/50 rounded-lg">
                                        ${child.label}
                                    </a>
                                `).join('')}
                            </div>
                        </div>`;
                } else {
                    return `
                        <a href="${url}" target="${target}" class="block px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-lg transition-colors">
                            ${item.label}
                        </a>`;
                }
            };

            items.forEach(item => {
                mobileHtml += renderMobileItem(item);
            });

            // Default Items


            $('#mobile-menu-items').html(mobileHtml);
        };

        $.getJSON(`${API_BASE}/menu`, function (response) {
            if (response.status && response.data) {
                let desktopHtml = '';

                // Helper for desktop dropdown
                const renderDesktopItem = (item) => {
                    const hasChildren = item.children && item.children.length > 0;
                    const url = item.url ? item.url : 'javascript:void(0)';
                    const target = item.target || '_self';

                    if (hasChildren) {
                        return `
                        <div class="relative group">
                            <button class="flex items-center gap-1 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors uppercase tracking-wide leading-relaxed px-3 py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-800/50">
                                ${item.label}
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <!-- Dropdown -->
                            <div class="absolute top-full left-0 pt-2 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform translate-y-2 group-hover:translate-y-0 z-50">
                                <div class="bg-white dark:bg-slate-900 rounded-xl shadow-xl border border-gray-100 dark:border-slate-800 p-2 space-y-1">
                                    ${item.children.map(child => `
                                        <a href="${child.url}" target="${child.target || '_self'}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-slate-800 hover:text-emerald-600 dark:hover:text-emerald-400 rounded-lg transition-colors">
                                            ${child.label}
                                        </a>
                                    `).join('')}
                                </div>
                            </div>
                        </div>`;
                    } else {
                        return `<a href="${url}" target="${target}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors uppercase tracking-wide leading-relaxed px-3 py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-800/50">${item.label}</a>`;
                    }
                };

                response.data.forEach(item => {
                    desktopHtml += renderDesktopItem(item);
                });

                $('#desktop-menu').html(desktopHtml);

                // Mobile
                renderMobile(response.data);
            } else {
                renderMobile([]);
            }
        }).fail(function () {
            renderMobile([]);
        });
    }

    // --- Hero Section (Dynamic Slider) ---
    function loadBanner() {
        $.getJSON(`${API_BASE}/banner`, { limit: 5 }, function (response) {
            const container = $('#hero-slider');
            const controls = $('#hero-controls');

            if (response.status && response.data && response.data.length > 0) {
                let slidesHtml = '';
                let dotsHtml = '';

                response.data.forEach((banner, index) => {
                    const activeClass = index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0';
                    const activeDot = index === 0 ? 'bg-emerald-500 w-8' : 'bg-white/50 w-2 hover:bg-white/80';

                    // Button Logic
                    let buttonHtml = '';
                    if (banner.button_text) {
                        const btnUrl = banner.button_url || '#';
                        buttonHtml = `
                        <div class="mt-8 animate-fade-in-up delay-300">
                             <a href="${btnUrl}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-emerald-700 bg-white hover:bg-emerald-50 md:py-3 md:text-lg md:px-8 shadow-lg transition">
                                ${banner.button_text}
                            </a>
                        </div>`;
                    }

                    // Slide HTML
                    slidesHtml += `
                    <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out hero-slide ${activeClass}" data-index="${index}">
                        <!-- Background -->
                        <div class="absolute inset-0">
                             <img src="${banner.image_url || 'https://via.placeholder.com/1920x1080?text=Banner+Image'}" alt="Banner ${index}" class="w-full h-full object-cover">
                             <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-slate-900/60 to-slate-900/40"></div>
                        </div>

                        <!-- Content (Restored) -->
                        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center justify-center pb-20">
                            <div class="max-w-4xl text-center pt-20">
                                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-500/30 backdrop-blur-md mb-6 animate-fade-in-up">
                                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                    <span class="text-xs font-semibold text-emerald-100 uppercase tracking-widest">Website Resmi Pemerintah</span>
                                </div>
                                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6 animate-fade-in-up delay-100 drop-shadow-sm font-serif">
                                    ${banner.title ? banner.title.replace(/\n/g, '<br>') : 'Desa Batilai'}
                                </h1>
                                ${banner.subtitle ? `<p class="text-lg md:text-xl text-slate-300 mb-8 leading-relaxed max-w-2xl mx-auto animate-fade-in-up delay-200">${banner.subtitle}</p>` : ''}
                                ${buttonHtml}
                            </div>
                        </div>
                    </div>`;

                    // Dot HTML
                    dotsHtml += `<button class="h-2 rounded-full transition-all duration-300 ${activeDot}" onclick="goToSlide(${index})"></button>`;
                });

                container.html(slidesHtml);
                controls.html(dotsHtml);

                // Show controls if > 1 slide
                if (response.data.length > 1) {
                    $('#hero-prev, #hero-next').removeClass('hidden');
                    startSliderInterval();
                }
            }
        }).fail(function () {
            console.log('Banner API unavailable.');
        });
    }

    // --- Slider Logic ---
    let sliderInterval;
    const slideDuration = 6000;

    window.goToSlide = function (index) {
        const slides = $('.hero-slide');
        if (slides.length === 0) return;

        if (index >= slides.length) index = 0;
        if (index < 0) index = slides.length - 1;

        slides.removeClass('opacity-100 z-10').addClass('opacity-0 z-0');
        $(slides[index]).removeClass('opacity-0 z-0').addClass('opacity-100 z-10');
    };

    function nextSlide() {
        const current = $('.hero-slide.opacity-100').data('index');
        goToSlide(current + 1);
    }

    function startSliderInterval() {
        sliderInterval = setInterval(nextSlide, slideDuration);
    }

    // --- Sambutan Kades ---
    function loadSambutan() {
        $.getJSON(`${API_BASE}/sambutan-kades`, function (response) {
            if (response.status && response.data) {
                const data = response.data;
                const judul = data.judul || 'Sambutan Kepala Desa';
                const nama = data.nama_kades || 'Kepala Desa';
                const isi = data.isi ? data.isi.replace(/\n/g, '<br>') : '<p>Sedang memuat konten...</p>';
                const foto = data.foto_url || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(nama);

                $('#sambutan-judul').text(judul);
                $('#sambutan-nama').text(nama);
                $('#sambutan-isi').html(isi);
                $('#sambutan-foto').attr('src', foto);
                // Background effect removed in new design, but safer to keep selection valid
                $('#sambutan-bg-effect').attr('src', foto);
            }
        });
    }

    // --- 1. Statistik Demografi (Consolidated) ---
    function loadStats() {
        $.getJSON(`${API_BASE}/demografi`, function (response) {
            if (response.status && response.data) {
                const d = response.data;

                // Format numbers logic
                const fmt = (num) => Number(num || 0).toLocaleString('id-ID');

                // Wilayah Stats
                $('#stat-jarak').text((d.jarak_ke_kabupaten || '0') + ' Km');
                $('#stat-luas').text((d.luas_wilayah || '0') + ' Ha');
                $('#stat-kepadatan').text((d.kepadatan || '0') + '/km²');
                $('#stat-dusun').text(fmt(d.jumlah_dusun) + ' Dusun');
                $('#stat-rt').text(fmt(d.jumlah_rt) + ' RT');

                // Penduduk Stats
                $('#stat-penduduk').text(fmt(d.jumlah_penduduk) + ' Jiwa');
                $('#stat-kk').text(fmt(d.jumlah_kk) + ' KK');
            }
        }).fail(function () {
            console.error('Failed to load demografi stats');
            const targetIds = ['#stat-jarak', '#stat-luas', '#stat-kepadatan', '#stat-dusun', '#stat-rt', '#stat-penduduk', '#stat-kk'];
            targetIds.forEach(id => $(id).text('-'));
        });
    }


    // --- 2. Perangkat Desa (Swiper) ---
    function loadPerangkat() {
        const containerSelector = '#perangkat-container';
        const container = $(containerSelector);
        const skeletonWrapper = '#perangkat-section';

        $.getJSON(`${API_BASE}/perangkat`, { limit: 12 }, function (response) {
            if (response.status && response.data && response.data.length > 0) {
                let html = '';
                response.data.forEach(item => {
                    const name = item.nama || item.name;
                    const jabatan = item.jabatan || 'Perangkat Desa';
                    const img = item.foto_url || item.photo_url || item.cover_url || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(name);

                    // Swiper Slide
                    html += `
                    <div class="swiper-slide">
                         <div class="group relative rounded-xl overflow-hidden bg-white dark:bg-slate-800 shadow-sm border border-gray-100 dark:border-slate-700 aspect-[3/4] hover:shadow-lg transition-all duration-300">
                            <img src="${img}" alt="${name}" class="w-full h-full object-cover transition duration-300 group-hover:scale-105 select-none pointer-events-none" loading="lazy" onerror="this.src='https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=random'">
                            
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/90 via-transparent to-transparent opacity-90"></div>
                            
                            <div class="absolute bottom-0 left-0 w-full p-4">
                                <h3 class="font-bold text-white text-sm leading-tight line-clamp-1 mb-1">${name}</h3>
                                <p class="text-emerald-200 text-xs font-medium truncate uppercase tracking-wide opacity-90">${jabatan}</p>
                            </div>
                        </div>
                    </div>`;
                });
                container.html(html);

                // Init Swiper
                if ($('#perangkat-slider').length) {
                    const swiper = new Swiper('#perangkat-slider', {
                        slidesPerView: 2,
                        spaceBetween: 16,
                        loop: true,
                        autoplay: {
                            delay: 2500,
                            disableOnInteraction: false,
                        },
                        breakpoints: {
                            640: {
                                slidesPerView: 3,
                                spaceBetween: 20,
                            },
                            768: {
                                slidesPerView: 4,
                                spaceBetween: 24,
                            },
                            1024: {
                                slidesPerView: 5,
                                spaceBetween: 24,
                            },
                        },
                    });
                }

            } else {
                container.html('<div class="w-full text-center text-gray-500 py-4 text-sm">Belum ada data.</div>');
            }
            hideSkeleton(skeletonWrapper);

        }).fail(function () {
            // In case of error, just hide skeleton (or show error state)
            console.log('Failed load perangkat');
            hideSkeleton(skeletonWrapper);
        });
    }

    // --- 3. Berita & Informasi ---
    function loadNews() {
        const container = '#news-container';
        showSkeleton('#news-section');

        $.getJSON(`${API_BASE}/news/latest`, { limit: 3 }, function (response) {
            if (response.status && response.data && response.data.length > 0) {
                let html = '';
                response.data.forEach(item => {
                    const title = item.title || item.judul;
                    const date = formatDate(item.created_at || item.tanggal);
                    const img = item.cover_url || item.image_url || FALLBACK_IMAGE;
                    const slug = item.slug;
                    const content = item.content ? item.content.replace(/<[^>]*>?/gm, '').substring(0, 100) + '...' : '...';

                    // Clean Official News Card
                    html += `
                    <div class="group bg-white dark:bg-slate-800 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-slate-700 overflow-hidden flex flex-col h-full">
                        <!-- Image -->
                        <div class="relative h-48 overflow-hidden">
                             <img src="${img}" alt="${title}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                             <div class="absolute top-0 right-0 m-3 px-2 py-1 bg-white/90 backdrop-blur text-[10px] font-bold uppercase tracking-wider text-emerald-600 rounded shadow-sm">
                                Berita
                             </div>
                        </div>

                        <!-- Content -->
                        <div class="p-5 flex-1 flex flex-col">
                            <div class="text-xs text-gray-400 mb-2 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                ${date}
                            </div>
                            <h3 class="font-bold text-gray-800 dark:text-white text-lg mb-2 line-clamp-2 leading-snug group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                <a href="/berita/${slug}">${title}</a>
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm line-clamp-2 mb-4 flex-1">${content}</p>
                            
                            <a href="/berita/${slug}" class="inline-flex items-center text-sm font-semibold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 mt-auto">
                                Baca Selengkapnya <span class="group-hover:translate-x-1 transition-transform ml-1">&rarr;</span>
                            </a>
                        </div>
                    </div>`;
                });
                $(container).html(html);
            } else {
                $(container).html('<div class="col-span-full text-center text-gray-500 py-10">Belum ada berita terbaru.</div>');
            }
            hideSkeleton('#news-section');
        }).fail(function () {
            $(container).html('<div class="col-span-full text-center text-red-500 py-10">Gagal memuat berita.</div>');
            hideSkeleton('#news-section');
        });
    }

    // --- 4. Galeri (Swiper) ---
    function loadGallery() {
        const container = '#gallery-container';
        const skeleton = '#gallery-skeleton';

        $.getJSON(`${API_BASE}/gallery/latest`, { limit: 12 }, function (response) {
            if (response.status && response.data && response.data.length > 0) {
                let html = '';
                response.data.forEach(item => {
                    const img = item.file_url || item.file_path;
                    const title = item.judul || 'Dokumentasi Desa';

                    if (img) {
                        html += `
                        <div class="swiper-slide">
                            <div class="relative group rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 aspect-video">
                                <img src="${img}" alt="${title}" class="w-full h-full object-cover select-none pointer-events-none" loading="lazy">
                                
                                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <p class="text-white text-sm font-medium truncate">${title}</p>
                                </div>
                            </div>
                        </div>`;
                    }
                });

                $(container).html(html);

                // Init Swiper
                if ($('#gallery-slider').length) {
                    const swiper = new Swiper('#gallery-slider', {
                        slidesPerView: 1,
                        spaceBetween: 16,
                        loop: true,
                        autoplay: {
                            delay: 3000,
                            disableOnInteraction: false,
                        },
                        breakpoints: {
                            640: {
                                slidesPerView: 2,
                                spaceBetween: 20,
                            },
                            768: {
                                slidesPerView: 3,
                                spaceBetween: 24,
                            },
                        },
                    });
                }

                $(skeleton).fadeOut(500, function () {
                    $('#gallery-slider').removeClass('opacity-0');
                });

            } else {
                $(skeleton).hide();
                $('#gallery-slider').removeClass('opacity-0').html('<div class="text-center text-gray-500 py-10 w-full">Belum ada foto galeri.</div>');
            }
        }).fail(function () {
            $(skeleton).hide();
            $('#gallery-slider').removeClass('opacity-0').html('<div class="text-center text-red-500 py-10 w-full">Gagal memuat galeri.</div>');
        });
    }

    // --- 5. Dokumen ---
    function loadDocuments() {
        const container = '#dokumen-container';
        const skeleton = '#dokumen-skeleton';

        $.getJSON(`${API_BASE}/dokumen`, { page: 1, per_page: 5 }, function (response) {
            if (response.status && response.data && response.data.length > 0) {
                let html = '';
                response.data.forEach((item, index) => {
                    const title = item.judul || 'Dokumen Publik';
                    const category = item.kategori_nama || 'Umum';
                    const year = item.tahun || '';
                    const url = item.file_url || '#';
                    const date = item.created_at ? formatDate(item.created_at) : '';

                    let iconHtml = '<svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>';
                    if (item.mime === 'application/pdf' || (item.file_name && item.file_name.endsWith('.pdf'))) {
                        iconHtml = '<svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>';
                    }

                    // Official Item (Green Touches)
                    html += `
                    <div class="group bg-white dark:bg-slate-800 rounded-lg p-5 border border-emerald-100 dark:border-emerald-900/30 hover:shadow-md hover:border-emerald-300 dark:hover:border-emerald-700 transition-all duration-300 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 flex items-center justify-center shrink-0 border border-emerald-100 dark:border-emerald-800">
                            ${iconHtml}
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 bg-emerald-100 dark:bg-emerald-900/30 px-2 py-0.5 rounded border border-emerald-200 dark:border-emerald-800">${category}</span>
                                ${year ? `<span class="text-xs text-slate-500">${year}</span>` : ''}
                            </div>
                            <h3 class="font-bold text-slate-800 dark:text-white text-base truncate pr-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">${title}</h3>
                        </div>

                        <a href="${url}" target="_blank" class="p-2 text-emerald-600 dark:text-emerald-400 hover:text-white bg-emerald-50 dark:bg-emerald-900/20 hover:bg-emerald-600 dark:hover:bg-emerald-600 rounded-full transition-all border border-emerald-100 dark:border-emerald-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        </a>
                    </div>`;
                });

                $(container).html(html);
                $(skeleton).hide();

            } else {
                $(skeleton).hide();
                $(container).html('<div class="text-center text-slate-500 py-8 border border-dashed border-slate-800 rounded-xl text-sm">Belum ada dokumen.</div>');
            }
        }).fail(function () {
            $(skeleton).hide();
            $(container).html('<div class="text-center text-red-400 py-8 text-sm">Gagal memuat dokumen.</div>');
        });
    }

    // --- 6. Kontak & Profile (Merged) ---
    function loadProfile() {
        $.getJSON(`${API_BASE}/kontak`, function (response) {
            if (response.status && response.data) {
                const d = response.data; // Might be array or object
                const data = Array.isArray(d) ? d[0] : d;

                if (data) {
                    // 1. Top Bar
                    $('#contact-address').text(data.alamat); // Fallback if exists in top bar
                    $('#contact-phone').text(data.telepon);
                    $('#contact-email').text(data.email);

                    // 2. Footer
                    $('#footer-address').text(data.alamat);
                    $('#footer-phone').text(data.telepon);
                    $('#footer-email').text(data.email);

                    // WhatsApp Logic
                    if (data.whatsapp) {
                        let waNumber = '';
                        let waLink = '#';

                        if (typeof data.whatsapp === 'object') {
                            waNumber = data.whatsapp.number || 'Chat WhatsApp';
                            waLink = data.whatsapp.link || (data.whatsapp.number ? `https://wa.me/${data.whatsapp.number.replace(/[^0-9]/g, '')}` : '#');
                        } else {
                            // Assume string
                            waNumber = data.whatsapp;
                            waLink = `https://wa.me/${data.whatsapp.replace(/[^0-9]/g, '')}`;
                        }

                        // Top Bar
                        $('#contact-wa-link').attr('href', waLink);

                        // Footer
                        $('#contact-wa-footer').attr('href', waLink).text(waNumber);
                    }

                    // Maps Logic
                    // Maps Logic
                    // Field from API is 'link_maps'
                    const mapData = data.link_maps || data.maps || data.maps_embed;

                    if (mapData) {
                        if (mapData.includes('<iframe')) {
                            // Extract only the iframe tag
                            const iframeMatch = mapData.match(/<iframe.*?>.*?<\/iframe>/i);
                            let iframeHtml = iframeMatch ? iframeMatch[0] : mapData;

                            // Clean escaped quotes if present (common in some DB storage)
                            iframeHtml = iframeHtml.replace(/\\"/g, '"');

                            $('#map-container').empty().append(iframeHtml);

                            // Force styles on the injected iframe
                            $('#map-container iframe')
                                .removeAttr('width')
                                .removeAttr('height')
                                .addClass('w-full h-full border-0 rounded-xl block');
                        } else {
                            // Case: API returns URL string
                            $('#map-iframe').attr('src', mapData);
                        }
                    }
                }
            }
        });
    }
    // --- 7. Service Hours ---
    function loadServiceHours() {
        $.getJSON(`${API_BASE}/jam-pelayanan`, function (response) {
            if (response.status && response.data && Array.isArray(response.data)) {
                let html = '';
                response.data.forEach((item, index) => {
                    if (item.is_active == 1) {
                        // Check for Holiday (Libur)
                        let isHoliday = (!item.jam_mulai || item.jam_mulai.trim() === '') && (!item.jam_selesai || item.jam_selesai.trim() === '');
                        let timeDisplay = isHoliday ? 'Libur' : `${item.jam_mulai} - ${item.jam_selesai}`;
                        let badgeClass = isHoliday
                            ? 'bg-rose-100 text-rose-800 dark:bg-rose-900/50 dark:text-rose-200'
                            : 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-200';

                        html += `
                            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-emerald-100 dark:border-slate-700 hover:shadow-md transition-all flex items-start gap-4 h-full">
                                <div class="w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shrink-0">
                                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white text-lg mb-1">${item.hari}</h4>
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium ${badgeClass} mb-2">
                                        ${timeDisplay}
                                    </div>
                                    ${item.keterangan ? `<p class="text-xs text-gray-500 dark:text-gray-400 italic leading-relaxed">"${item.keterangan}"</p>` : ''}
                                </div>
                            </div>
                         `;
                    }
                });
                if (html) {
                    $('#service-hours-container').html(html);
                }
            }
        });
    }

    // --- Init ---

    // Mobile Menu Toggle (Moved to top to priority execution)
    $('#mobile-menu-btn').off('click').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const menu = $('#mobile-nav-overlay');
        const isVisible = menu.is(':visible');

        if (!isVisible) {
            // OPEN MENU
            menu.removeClass('hidden').hide().slideDown(250);
        } else {
            // CLOSE MENU
            menu.slideUp(250, function () {
                menu.addClass('hidden');
            });
        }
    });

    // Close menu when clicking outside
    $(document).on('click', function (e) {
        // If click is NOT on menu AND NOT on button
        if (!$(e.target).closest('#mobile-nav-overlay').length && !$(e.target).closest('#mobile-menu-btn').length) {
            $('#mobile-nav-overlay').slideUp(200, function () {
                $(this).addClass('hidden');
            });
        }
    });

    loadMenu();
    loadBanner();
    loadServiceHours();
    loadSambutan();
    loadStats();
    loadPerangkat();
    loadNews();
    loadGallery();
    loadDocuments();
    loadProfile();
});
