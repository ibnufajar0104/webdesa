/**
 * Desa Batilai Homepage Logic
 * Handles API data fetching and UI rendering.
 */

$(document).ready(function () {
    // API Endpoints
    const textApi = 'val';
    const API_BASE = '/api';
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
    function handleSearch(query) {
        if (query && query.trim().length > 0) {
            window.location.href = '/berita?q=' + encodeURIComponent(query);
        }
    }

    $('#hero-search-input').on('keypress', function (e) {
        if (e.which === 13) handleSearch($(this).val());
    });

    $('#hero-search-btn').click(function () {
        handleSearch($('#hero-search-input').val());
    });

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
        $.getJSON(`${API_BASE}/menu`, function (response) {
            if (response.status && response.data) {
                let html = '';
                // Desktop
                response.data.forEach(item => {
                    const url = item.url;
                    const label = item.label;
                    const target = item.target || '_self';
                    html += `<a href="${url}" target="${target}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors uppercase tracking-wide leading-relaxed px-2 py-1">${label}</a>`;
                });
                $('#desktop-menu').html(html);

                // Mobile
                let mobileHtml = '';
                response.data.forEach(item => {
                    mobileHtml += `<a href="${item.url}" class="block px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-lg">${item.label}</a>`;
                });
                // Add default mobile items
                mobileHtml += `
                 <a href="#perangkat-section" class="block px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-lg">Pemerintahan</a>
                 <a href="#news-section" class="block px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-lg">Berita</a>
                 <a href="#gallery-section" class="block px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-lg">Galeri</a>
                 <a href="#footer-section" class="block px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-lg">Kontak</a>`;

                $('#mobile-menu-items').html(mobileHtml);
            }
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
                const isi = data.isi ? data.isi.replace(/\n/g, '<br>') : '<p>Sedang memuat konten...</p>';
                const foto = data.foto_url || 'https://ui-avatars.com/api/?name=Kepala+Desa';

                $('#sambutan-judul').text(judul);
                $('#sambutan-isi').html(isi);
                $('#sambutan-foto').attr('src', foto);
                // Background effect removed in new design, but safer to keep selection valid
                $('#sambutan-bg-effect').attr('src', foto);
            }
        });
    }

    // --- 1. Statistik Ringkas ---
    function loadStats() {
        $.when(
            $.getJSON(`${API_BASE}/penduduk/stats/overview`),
            $.getJSON(`${API_BASE}/penduduk/stats/kk`)
        ).done(function (overviewRes, kkRes) {
            const popData = overviewRes[0] || {};
            const kkData = kkRes[0] || {};

            const pop = popData.data?.total || 0;
            const kk = kkData.data?.total_kk || 0;

            // Update Dynamic Stats
            $('#stat-penduduk').text(Number(pop).toLocaleString('id-ID') + ' Jiwa');
            $('#stat-kk').text(Number(kk).toLocaleString('id-ID') + ' KK');

            // Dummy Data is handled by static HTML, no need to inject here unless we want to randomness.
            // Keeping it simple as requested.

        }).fail(function () {
            console.error('Failed to load stats');
            $('#stat-penduduk').text('-');
            $('#stat-kk').text('-');
        });
    }


    // --- 2. Perangkat Desa ---
    function loadPerangkat() {
        const containerSelector = '#perangkat-container';
        const container = $(containerSelector);
        const skeletonWrapper = '#perangkat-section';

        $.getJSON(`${API_BASE}/perangkat`, { limit: 6 }, function (response) {
            if (response.status && response.data && response.data.length > 0) {
                let html = '';
                response.data.forEach(item => {
                    const name = item.nama || item.name;
                    const jabatan = item.jabatan || 'Perangkat Desa';
                    const img = item.foto_url || item.photo_url || item.cover_url || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(name);

                    // Official Profile Card
                    html += `
                    <div class="group relative rounded-xl overflow-hidden bg-white dark:bg-slate-800 shadow-sm border border-gray-100 dark:border-slate-700 aspect-[3/4] hover:shadow-lg transition-all duration-300">
                        <img src="${img}" alt="${name}" class="w-full h-full object-cover transition duration-300 group-hover:scale-105" loading="lazy" onerror="this.src='https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=random'">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/90 via-transparent to-transparent opacity-90"></div>
                        
                        <div class="absolute bottom-0 left-0 w-full p-4">
                            <h3 class="font-bold text-white text-sm leading-tight line-clamp-1 mb-1">${name}</h3>
                            <p class="text-emerald-200 text-xs font-medium truncate uppercase tracking-wide opacity-90">${jabatan}</p>
                        </div>
                    </div>`;
                });
                container.html(html);

            } else {
                container.html('<div class="col-span-full text-center text-gray-500 w-full py-4 text-sm">Belum ada data.</div>');
            }
            hideSkeleton(skeletonWrapper);

        }).fail(function () {
            container.html('<div class="col-span-full text-center text-red-500 w-full py-4 text-xs">Gagal memuat.</div>');
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

    // --- 4. Galeri ---
    function loadGallery() {
        const container = '#gallery-container';
        const skeleton = '#gallery-skeleton';

        $.getJSON(`${API_BASE}/gallery/latest`, { limit: 10 }, function (response) {
            if (response.status && response.data && response.data.length > 0) {
                let html = '<div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">';
                response.data.forEach(item => {
                    const img = item.file_url || item.file_path;
                    const title = item.judul || 'Dokumentasi Desa';
                    const caption = item.caption || '';

                    if (img) {
                        html += `
                        <div class="break-inside-avoid relative group rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                            <img src="${img}" alt="${title}" class="w-full h-auto" loading="lazy">
                            
                            <!-- Simple Overlay -->
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <p class="text-white text-sm font-medium truncate">${title}</p>
                            </div>
                        </div>`;
                    }
                });
                html += '</div>';

                $(container).html(html);
                $(skeleton).fadeOut(500, function () {
                    $(container).removeClass('opacity-0');
                });

            } else {
                $(skeleton).hide();
                $(container).removeClass('opacity-0').html('<div class="text-center text-gray-500 py-10">Belum ada foto galeri.</div>');
            }
        }).fail(function () {
            $(skeleton).hide();
            $(container).removeClass('opacity-0').html('<div class="text-center text-red-500 py-10">Gagal memuat galeri.</div>');
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

                    // Official Dark Item
                    html += `
                    <div class="group bg-slate-800 rounded-lg p-5 border border-slate-700 hover:border-emerald-500/50 hover:bg-slate-750 transition-all duration-300 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-slate-700/50 flex items-center justify-center shrink-0">
                            ${iconHtml}
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-400 bg-emerald-900/30 px-2 py-0.5 rounded">${category}</span>
                                ${year ? `<span class="text-xs text-slate-500">${year}</span>` : ''}
                            </div>
                            <h3 class="text-white font-medium text-base truncate pr-2 group-hover:text-emerald-300 transition-colors">${title}</h3>
                        </div>

                        <a href="${url}" target="_blank" class="p-2 text-slate-400 hover:text-white bg-slate-700 hover:bg-emerald-600 rounded-full transition-all">
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
                        const waLink = data.whatsapp.link || (data.whatsapp.number ? `https://wa.me/${data.whatsapp.number}` : '#');
                        const waNumber = data.whatsapp.number || 'Chat WhatsApp';

                        // Top Bar
                        $('#contact-wa-link').attr('href', waLink);

                        // Footer
                        $('#contact-wa-footer').attr('href', waLink).text(waNumber);
                    }

                    // Maps Logic
                    if (data.maps) {
                        if (data.maps.includes('<iframe')) {
                            // Extract only the iframe tag to avoid printing surrounding text/URLs
                            const iframeMatch = data.maps.match(/<iframe.*?>.*?<\/iframe>/i);
                            const iframeHtml = iframeMatch ? iframeMatch[0] : data.maps;

                            $('#map-container').empty().append(iframeHtml);

                            // Force styles on the injected iframe
                            $('#map-container iframe')
                                .removeAttr('width')
                                .removeAttr('height')
                                .addClass('w-full h-full border-0 rounded-xl block');
                        } else {
                            // Case: API returns URL string
                            $('#map-iframe').attr('src', data.maps);
                        }
                    } else if (data.maps_embed) {
                        // Fallback: If API provides full embed code
                        $('#map-container').html(data.maps_embed);
                        $('#map-container iframe').addClass('w-full h-full rounded-xl opacity-80 hover:opacity-100 transition duration-500');
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

    // Mobile Menu Toggle
    $('#mobile-menu-btn').click(function () {
        const menu = $('#mobile-menu');
        const isOpen = !menu.hasClass('hidden');
        if (isOpen) {
            menu.addClass('hidden');
        } else {
            menu.removeClass('hidden');
        }
    });
});
