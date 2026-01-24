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

    // --- Hero Section (Dynamic) ---
    // --- Dynamic Menu ---
    function loadMenu() {
        $.getJSON(`${API_BASE}/menu`, function (response) {
            if (response.status && response.data) {
                let html = '';
                response.data.forEach(item => {
                    const url = item.url;
                    const label = item.label;
                    const target = item.target || '_self';

                    // Simple styling for top-level items
                    html += `<a href="${url}" target="${target}" class="text-gray-600 hover:text-blue-600 transition font-medium text-sm lg:text-base">${label}</a>`;
                });
                // Add default Contact button at the end
                html += `<a href="#footer-section" class="px-5 py-2.5 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition shadow-md hover:shadow-lg text-sm font-semibold">Kontak</a>`;

                $('#desktop-menu').html(html);
            }
        });
    }

    // --- Hero Section (Dynamic) ---
    function loadBanner() {
        // Fetch Banner Data
        $.getJSON(`${API_BASE}/banner`, { limit: 5 }, function (response) {
            if (response.status && response.data && response.data.length > 0) {
                // Take the first active banner
                const banner = response.data[0];

                // Update DOM elements
                if (banner.title) $('#hero-title').html(banner.title.replace(/\n/g, '<br>'));
                if (banner.subtitle) $('#hero-subtitle').text(banner.subtitle);
                if (banner.description) $('#hero-desc').text(banner.description);

                if (banner.image_url) {
                    $('#hero-img-right').attr('src', banner.image_url);
                    // Also set background for effect if needed, or keep static
                }

                if (banner.button_text) {
                    $('#hero-cta-primary').text(banner.button_text);
                }

                if (banner.button_url) {
                    $('#hero-cta-primary').attr('href', banner.button_url);
                }
            }
        }).fail(function () {
            console.log('Banner API unavailable, using default.');
        });
    }

    // --- Sambutan Kades ---
    function loadSambutan() {
        $.getJSON(`${API_BASE}/sambutan-kades`, function (response) {
            if (response.status && response.data) {
                const data = response.data;
                const judul = data.judul || 'Sambutan Kepala Desa';
                const isi = data.isi || '<p>Selamat datang di website resmi Desa Batilai...</p>'; // Expecting HTML or text
                const foto = data.foto_url || 'https://ui-avatars.com/api/?name=Kepala+Desa';
                // Jika API tidak mengembalikan nama kades secara eksplisit, bisa hardcode atau ambil dari data lain.
                // Disini kita asumsi data.nama ada, atau default.
                const nama = data.nama || 'Nama Kepala Desa';

                $('#sambutan-judul').text(judul);
                $('#sambutan-isi').html(isi);
                $('#sambutan-foto').attr('src', foto);
                $('#sambutan-bg-effect').attr('src', foto); // Blur effect bg

                // Jika API punya field nama
                // $('#sambutan-nama').text(nama); 
            }
        }).fail(function () {
            console.log('Sambutan API unavailable.');
            $('#sambutan-judul').text('Sambutan Kepala Desa');
            $('#sambutan-isi').html('<p>Selamat datang di website resmi kami. Mohon maaf, saat ini konten sambutan sedang tidak dapat dimuat.</p>');
        });
    }

    // --- 1. Statistik Ringkas ---
    function loadStats() {
        $.when(
            $.getJSON(`${API_BASE}/penduduk/stats/overview`),
            $.getJSON(`${API_BASE}/penduduk/stats/kk`)
        ).done(function (overviewRes, kkRes) {
            // Extract Data safely
            // Overview structure check needed, but robust fallback used
            const popData = overviewRes[0] || {};
            const kkData = kkRes[0] || {};

            const pop = popData.data?.total || 0;
            const kk = kkData.data?.total_kk || 0;

            // Manual Constants
            const area = '12.5';
            const rw = '4'; // Manual value for RW
            const dusun = '4'; // Manual value for Dusun

            $('#stat-penduduk').text(Number(pop).toLocaleString('id-ID'));
            $('#stat-kk').text(Number(kk).toLocaleString('id-ID'));
            $('#stat-wilayah').text(area + ' km²');
            $('#stat-rw').text(rw);
            $('#stat-dusun').text(dusun);

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

        // showSkeleton('#perangkat-section'); // Skeleton explicitly in HTML

        $.getJSON(`${API_BASE}/perangkat`, { limit: 10 }, function (response) {
            if (response.status && response.data && response.data.length > 0) {
                let html = '';
                response.data.forEach(item => {
                    const name = item.nama || item.name;
                    const jabatan = item.jabatan || 'Perangkat Desa';
                    const img = item.foto_url || item.photo_url || item.cover_url || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(name);

                    html += `
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition card-hoverable overflow-hidden group min-w-[280px] snap-center flex-shrink-0 border border-gray-100">
                        <div class="aspect-w-3 aspect-h-4 bg-gray-200 overflow-hidden relative">
                            <img src="${img}" alt="${name}" class="w-full h-80 object-cover object-top group-hover:scale-105 transition duration-500" loading="lazy" onerror="this.src='https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=random'">
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-4 pt-12">
                                <h3 class="font-bold text-white text-lg leading-tight">${name}</h3>
                                <p class="text-blue-300 text-sm font-medium mt-1">${jabatan}</p>
                            </div>
                        </div>
                    </div>`;
                });
                container.html(html);

                // --- Auto Scroll Logic ---
                let scrollInterval;
                const scrollAmount = 300; // Approx card width + gap
                const scrollDelay = 3000; // 3 seconds

                function startAutoScroll() {
                    stopAutoScroll();
                    scrollInterval = setInterval(function () {
                        const currentScroll = container.scrollLeft();
                        const maxScroll = container[0].scrollWidth - container[0].clientWidth;

                        if (currentScroll + 10 >= maxScroll) {
                            // Reset to start smoothly
                            container.animate({ scrollLeft: 0 }, 800);
                        } else {
                            // Scroll next
                            container.animate({ scrollLeft: currentScroll + scrollAmount }, 500);
                        }
                    }, scrollDelay);
                }

                function stopAutoScroll() {
                    if (scrollInterval) clearInterval(scrollInterval);
                }

                // Start immediately
                startAutoScroll();

                // Pause on Hover
                container.on('mouseenter', stopAutoScroll);
                container.on('mouseleave', startAutoScroll);
                // Also pause on touch interaction for mobile
                container.on('touchstart', stopAutoScroll);
                container.on('touchend', function () {
                    setTimeout(startAutoScroll, 2000); // Resume after a delay
                });

            } else {
                container.html('<div class="col-span-full text-center text-gray-500 w-full py-10">Belum ada data perangkat desa.</div>');
            }
            hideSkeleton('#perangkat-section');
        }).fail(function () {
            container.html('<div class="col-span-full text-center text-red-500 w-full py-10">Gagal memuat data.</div>');
            hideSkeleton('#perangkat-section');
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
                    const img = item.cover_url || FALLBACK_IMAGE;
                    const slug = item.slug;
                    const content = item.content || 'Klik untuk membaca selengkapnya...';

                    html += `
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition card-hoverable overflow-hidden flex flex-col h-full">
                        <div class="relative h-48 overflow-hidden">
                             <img src="${img}" alt="${title}" class="w-full h-full object-cover transition duration-300 transform hover:scale-110">
                             <div class="absolute top-0 right-0 bg-blue-600 text-white text-xs font-bold px-3 py-1 m-2 rounded-full">
                                Berita
                             </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="text-gray-400 text-xs mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                ${date}
                            </div>
                            <h3 class="font-bold text-gray-800 text-xl mb-3 line-clamp-2 leading-tight hover:text-blue-600 transition">
                                <a href="/berita/${slug}">${title}</a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-4">${content}</p>
                            <div class="mt-auto">
                                <a href="/berita/${slug}" class="inline-flex items-center text-blue-600 font-semibold text-sm hover:underline">
                                    Baca Selengkapnya 
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>`;
                });
                $(container).html(html);
            } else {
                $(container).html('<div class="col-span-full text-center text-gray-500 w-full">Belum ada berita terbaru.</div>');
            }
            hideSkeleton('#news-section');
        }).fail(function () {
            $(container).html('<div class="col-span-full text-center text-red-500 w-full">Gagal memuat berita.</div>');
            hideSkeleton('#news-section');
        });
    }

    // --- 4. Galeri ---
    function loadGallery() {
        const container = '#gallery-container';
        // Simple Masonry or Grid
        $.getJSON(`${API_BASE}/gallery/latest`, { limit: 6 }, function (response) {
            if (response.status && response.data && response.data.length > 0) {
                let html = '<div class="masonry-grid">';
                response.data.forEach(item => {
                    const img = item.cover_url || item.url || item.path;
                    const title = item.title || item.nama || '';
                    if (img) {
                        html += `
                        <div class="masonry-item relative group rounded-xl overflow-hidden shadow-sm mb-4 break-inside-avoid">
                            <img src="${img}" alt="${title}" class="w-full h-auto transform group-hover:scale-105 transition duration-500" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                                <span class="text-white text-sm font-medium truncate w-full">${title}</span>
                            </div>
                        </div>`;
                    }
                });
                html += '</div>';
                $(container).html(html);
            } else {
                $(container).html('<div class="text-center text-gray-500 py-10 w-full">Belum ada foto galeri.</div>');
            }
        });
    }

    // --- 5. Dokumen ---
    function loadDocuments() {
        const container = '#dokumen-body';
        $.getJSON(`${API_BASE}/dokumen/latest`, { limit: 5 }, function (response) {
            if (response.status && response.data && response.data.length > 0) {
                let html = '';
                response.data.forEach((item, index) => {
                    const name = item.name || item.judul;
                    const date = formatDate(item.created_at);
                    const url = item.download_url || item.url || '#'; // Assume API provides this or construct it

                    html += `
                    <tr class="hover:bg-blue-50 transition border-b border-gray-100 last:border-0">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">${index + 1}</td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">${name}</div>
                            <div class="text-xs text-blue-500 md:hidden mt-1">${date}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">${date}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="${url}" class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-1.5 rounded-full text-xs transition shadow-sm inline-flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Unduh
                            </a>
                        </td>
                    </tr>`;
                });
                $(container).html(html);
            } else {
                $(container).html('<tr><td colspan="4" class="px-6 py-10 text-center text-gray-500">Belum ada dokumen publik.</td></tr>');
            }
        });
    }

    // --- 6. Kontak & Profile (Merged) ---
    function loadProfile() {
        $.getJSON(`${API_BASE}/kontak`, function (response) {
            if (response.status && response.data) {
                const d = response.data; // Might be array or object
                const data = Array.isArray(d) ? d[0] : d;

                if (data) {
                    $('#contact-address').text(data.alamat);
                    $('#contact-phone').text(data.telepon);
                    $('#contact-email').text(data.email);

                    if (data.maps_embed) {
                        $('#map-container').html(data.maps_embed);
                        // Force style the iframe
                        $('#map-container iframe').addClass('w-full h-full rounded-xl shadow-inner');
                    }
                }
            }
        });
    }

    // --- Init ---
    loadMenu();
    loadBanner();
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
        const isOpen = menu.hasClass('active');
        if (isOpen) {
            menu.removeClass('active');
        } else {
            menu.addClass('active');
        }
    });
});
