<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
<?= esc($pageTitle ?? 'Dashboard') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
$stats = $stats ?? [];

$chartJK            = $chartJK            ?? ['labels' => [], 'values' => []];
$chartDusun         = $chartDusun         ?? ['labels' => [], 'values' => []];
$chartPendidikan    = $chartPendidikan    ?? ['labels' => [], 'values' => []];
$chartPekerjaan     = $chartPekerjaan     ?? ['labels' => [], 'values' => []];
$chartAgama         = $chartAgama         ?? ['labels' => [], 'values' => []];
$chartStatusPenduduk = $chartStatusPenduduk ?? ['labels' => [], 'values' => []];
$chartStatusDasar   = $chartStatusDasar   ?? ['labels' => [], 'values' => []];
$chartUmur          = $chartUmur          ?? ['labels' => [], 'values' => []];
$chartBantuan       = $chartBantuan       ?? ['labels' => [], 'values' => []];

$latestBerita = $latestBerita ?? [];
$latestGalery = $latestGalery ?? [];

$cards = [
    ['key' => 'dusun',     'label' => 'Dusun',            'icon' => 'home'],
    ['key' => 'rt',        'label' => 'RT',               'icon' => 'list'],
    ['key' => 'penduduk',  'label' => 'Penduduk',         'icon' => 'users'],
    ['key' => 'penerima',  'label' => 'Penerima Bantuan', 'icon' => 'shield'],
    ['key' => 'perangkat', 'label' => 'Perangkat Desa',   'icon' => 'briefcase'],
    ['key' => 'berita',    'label' => 'Berita',           'icon' => 'news'],
    ['key' => 'galery',    'label' => 'Galery',           'icon' => 'image'],
    ['key' => 'banner',    'label' => 'Banner',           'icon' => 'photo'],
    ['key' => 'halaman',   'label' => 'Halaman Statis',   'icon' => 'doc'],
    ['key' => 'pengguna',  'label' => 'Pengguna',         'icon' => 'key'],
];

$iconSvg = function ($name) {
    switch ($name) {
        case 'users':
            return '<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M8 13.5c-2.2 0-4 1.3-4 3v1.5h8v-1.5c0-1.7-1.8-3-4-3z"/><circle cx="8" cy="8.5" r="2.5"/><path d="M16 12.5c1.7 0 3 1.1 3 2.6V18"/><circle cx="16" cy="8.5" r="2.1"/></svg>';
        case 'home':
            return '<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20V10l8-5 8 5v10"/><path d="M9 20v-6h6v6"/></svg>';
        case 'list':
            return '<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3.5" y="4.5" width="17" height="15" rx="2"/><path d="M7 9h10M7 12h10M7 15h6"/></svg>';
        case 'shield':
            return '<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.5 20 6v6c0 5-3.5 9-8 9s-8-4-8-9V6l8-3.5Z"/><path d="M8.5 12.5 11 15l4.5-5"/></svg>';
        case 'briefcase':
            return '<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="4" y="8" width="16" height="10" rx="1.5"/><path d="M9 8V6.5A1.5 1.5 0 0 1 10.5 5h3A1.5 1.5 0 0 1 15 6.5V8"/><path d="M4 12h16"/></svg>';
        case 'news':
            return '<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="4" y="5" width="16" height="14" rx="1.5"/><path d="M8 9h5M8 12h5M8 15h3"/><rect x="15" y="9" width="3" height="6" rx="0.6"/></svg>';
        case 'image':
            return '<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="4" y="6" width="16" height="12" rx="1.5"/><path d="M8 14l2.2-2.2L13.2 15l2.3-2.3L20 18"/><circle cx="9" cy="10" r="1.1"/></svg>';
        case 'photo':
            return '<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="4" y="5" width="16" height="14" rx="1.5"/><path d="M8 13l2.5-2.5L14 14l2-2 2 3"/><circle cx="9" cy="9" r="1.1"/></svg>';
        case 'doc':
            return '<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 3.5h7.5L19 8v12H7z"/><path d="M14.5 3.5V8H19"/><path d="M10 11h5M10 14h5M10 17h3"/></svg>';
        case 'key':
            return '<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10l-2 2-2-2"/><path d="M17 12a5 5 0 1 1-2-4"/><path d="M10 14l-2 2"/><path d="M8 16l-2 2"/></svg>';
    }
    return '<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="8"/></svg>';
};

$cardClass  = "rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900";
$headerClass = "px-4 py-3 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between gap-2";
?>

<!-- Header -->
<div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
    <div>
        <h2 class="text-base font-semibold text-slate-800 dark:text-slate-100">Dashboard</h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Ringkasan data & statistik utama Web Desa CMS.
        </p>
    </div>

    <div class="flex items-center gap-2">
        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px]
            border border-slate-200 bg-white text-slate-600
            dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300">
            Update: <?= date('d/m/Y H:i') ?>
        </span>
    </div>
</div>

<!-- STAT CARDS -->
<div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-5">
    <?php foreach ($cards as $c): ?>
        <div class="<?= $cardClass ?> p-4">
            <div class="flex items-center justify-between gap-3">
                <div class="min-w-0">
                    <p class="text-[11px] uppercase tracking-wide text-slate-500 dark:text-slate-400">
                        <?= esc($c['label']) ?>
                    </p>
                    <p class="mt-1 text-2xl leading-tight font-semibold text-slate-800 dark:text-slate-100">
                        <?= number_format((int)($stats[$c['key']] ?? 0), 0, ',', '.') ?>
                    </p>
                </div>

                <div class="shrink-0 w-10 h-10 rounded-xl bg-primary-600/10 text-primary-700
                            flex items-center justify-center
                            dark:bg-primary-500/10 dark:text-primary-200">
                    <?= $iconSvg($c['icon']) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- CHARTS -->
<div class="mt-4 grid gap-3 lg:grid-cols-12">

    <!-- JK -->
    <div class="lg:col-span-4 <?= $cardClass ?> overflow-hidden">
        <div class="<?= $headerClass ?>">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                Penduduk per Jenis Kelamin
            </h3>
        </div>
        <div class="p-4">
            <div class="relative min-h-[220px]">
                <canvas id="chartJK"></canvas>
            </div>
        </div>
    </div>

    <!-- Dusun -->
    <div class="lg:col-span-8 <?= $cardClass ?> overflow-hidden">
        <div class="<?= $headerClass ?>">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                Penduduk per Dusun (Top 10)
            </h3>

        </div>
        <div class="p-4">
            <div class="relative min-h-[240px]">
                <canvas id="chartDusun"></canvas>
            </div>
        </div>
    </div>

    <!-- Pendidikan -->
    <div class="lg:col-span-6 <?= $cardClass ?> overflow-hidden">
        <div class="<?= $headerClass ?>">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                Penduduk per Pendidikan (Top 10)
            </h3>
        </div>
        <div class="p-4">
            <div class="relative min-h-[260px]">
                <canvas id="chartPendidikan"></canvas>
            </div>
        </div>
    </div>

    <!-- Pekerjaan -->
    <div class="lg:col-span-6 <?= $cardClass ?> overflow-hidden">
        <div class="<?= $headerClass ?>">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                Penduduk per Pekerjaan (Top 10)
            </h3>
        </div>
        <div class="p-4">
            <div class="relative min-h-[260px]">
                <canvas id="chartPekerjaan"></canvas>
            </div>
        </div>
    </div>

    <!-- Agama -->
    <div class="lg:col-span-4 <?= $cardClass ?> overflow-hidden">
        <div class="<?= $headerClass ?>">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                Penduduk per Agama
            </h3>
        </div>
        <div class="p-4">
            <div class="relative min-h-[240px]">
                <canvas id="chartAgama"></canvas>
            </div>
        </div>
    </div>

    <!-- Status Penduduk -->
    <div class="lg:col-span-4 <?= $cardClass ?> overflow-hidden">
        <div class="<?= $headerClass ?>">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                Status Penduduk
            </h3>
        </div>
        <div class="p-4">
            <div class="relative min-h-[240px]">
                <canvas id="chartStatusPenduduk"></canvas>
            </div>
        </div>
    </div>

    <!-- Status Dasar -->
    <div class="lg:col-span-4 <?= $cardClass ?> overflow-hidden">
        <div class="<?= $headerClass ?>">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                Status Dasar
            </h3>
        </div>
        <div class="p-4">
            <div class="relative min-h-[240px]">
                <canvas id="chartStatusDasar"></canvas>
            </div>
        </div>
    </div>

    <!-- Bantuan -->
    <div class="lg:col-span-6 <?= $cardClass ?> overflow-hidden">
        <div class="<?= $headerClass ?>">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                Penerima Bantuan per Jenis Bantuan (Top 10)
            </h3>
        </div>
        <div class="p-4">
            <div class="relative min-h-[260px]">
                <canvas id="chartBantuan"></canvas>
            </div>
        </div>
    </div>

    <!-- Umur -->
    <div class="lg:col-span-6 <?= $cardClass ?> overflow-hidden">
        <div class="<?= $headerClass ?>">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                Statistik Umur
            </h3>
        </div>
        <div class="p-4">
            <div class="relative min-h-[220px]">
                <canvas id="chartUmur"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- LATEST -->
<div class="mt-4 grid gap-3 lg:grid-cols-12">

    <!-- LATEST BERITA -->
    <div class="lg:col-span-6 <?= $cardClass ?> overflow-hidden">
        <div class="<?= $headerClass ?>">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                Berita Terbaru
            </h3>
            <a href="<?= base_url('admin/berita') ?>"
                class="text-[11px] text-primary-700 hover:underline dark:text-primary-300">
                Lihat semua
            </a>
        </div>

        <div class="p-4">
            <?php if (empty($latestBerita)): ?>
                <div class="text-xs text-slate-500 dark:text-slate-400">Belum ada berita.</div>
            <?php else: ?>
                <ul class="space-y-2">
                    <?php foreach ($latestBerita as $b): ?>
                        <li class="flex items-start justify-between gap-3 rounded-2xl border border-slate-100 p-3
                                   dark:border-slate-800 hover:border-primary-200 dark:hover:border-primary-500/40 transition">
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-slate-800 dark:text-slate-100 line-clamp-2">
                                    <?= esc($b['title'] ?? '-') ?>
                                </p>
                                <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                                    <?= esc($b['tanggal'] ?? '-') ?>
                                </p>
                            </div>
                            <a href="<?= base_url('admin/berita/edit/' . (int)($b['id'] ?? 0)) ?>"
                                class="shrink-0 inline-flex items-center px-3 py-1 rounded-full
                                      border border-slate-200 text-[11px] text-slate-700 hover:bg-slate-50
                                      dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">
                                Edit
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <!-- LATEST GALERY -->
    <div class="lg:col-span-6 <?= $cardClass ?> overflow-hidden">
        <div class="<?= $headerClass ?>">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                Galery Terbaru
            </h3>
            <a href="<?= base_url('admin/galery') ?>"
                class="text-[11px] text-primary-700 hover:underline dark:text-primary-300">
                Lihat semua
            </a>
        </div>

        <div class="p-4">
            <?php if (empty($latestGalery)): ?>
                <div class="text-xs text-slate-500 dark:text-slate-400">Belum ada galery.</div>
            <?php else: ?>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    <?php foreach ($latestGalery as $g): ?>
                        <?php
                        $file     = (string)($g['file'] ?? '');
                        $safeFile = $file ? basename($file) : '';
                        $imgUrl   = $safeFile ? base_url('file/galery/' . $safeFile) : '';
                        ?>
                        <a href="<?= base_url('admin/galery/edit/' . (int)($g['id'] ?? 0)) ?>"
                            class="group rounded-2xl border border-slate-100 overflow-hidden
                                  hover:border-primary-300 hover:shadow-sm transition
                                  dark:border-slate-800 dark:hover:border-primary-500/40">
                            <div class="aspect-[4/3] bg-slate-100 dark:bg-slate-800 overflow-hidden">
                                <?php if ($imgUrl): ?>
                                    <img src="<?= esc($imgUrl) ?>"
                                        alt="<?= esc($g['title'] ?? 'Galery') ?>"
                                        class="w-full h-full object-cover group-hover:scale-[1.03] transition">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-xs text-slate-500 dark:text-slate-300">
                                        No Image
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="p-2.5">
                                <p class="text-xs font-medium text-slate-800 dark:text-slate-100 line-clamp-1">
                                    <?= esc($g['title'] ?? '-') ?>
                                </p>
                                <p class="mt-0.5 text-[11px] text-slate-500 dark:text-slate-400">
                                    <?= esc($g['created_at'] ?? '-') ?>
                                </p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
    (() => {
        // ===== data dari PHP =====
        const chartJK = <?= json_encode($chartJK, JSON_UNESCAPED_UNICODE) ?>;
        const chartDusun = <?= json_encode($chartDusun, JSON_UNESCAPED_UNICODE) ?>;
        const chartPendidikan = <?= json_encode($chartPendidikan, JSON_UNESCAPED_UNICODE) ?>;
        const chartPekerjaan = <?= json_encode($chartPekerjaan, JSON_UNESCAPED_UNICODE) ?>;
        const chartAgama = <?= json_encode($chartAgama, JSON_UNESCAPED_UNICODE) ?>;
        const chartStatusPenduduk = <?= json_encode($chartStatusPenduduk, JSON_UNESCAPED_UNICODE) ?>;
        const chartStatusDasar = <?= json_encode($chartStatusDasar, JSON_UNESCAPED_UNICODE) ?>;
        const chartUmur = <?= json_encode($chartUmur, JSON_UNESCAPED_UNICODE) ?>;
        const chartBantuan = <?= json_encode($chartBantuan, JSON_UNESCAPED_UNICODE) ?>;

        // simpan instance chart biar bisa di-update saat theme berubah
        const instances = {};

        const isDark = () => document.documentElement.classList.contains('dark');

        // Ambil warna dari CSS (kalau ada) -> fallback aman
        const cssVar = (name, fallback) => {
            const v = getComputedStyle(document.documentElement).getPropertyValue(name).trim();
            return v || fallback;
        };

        const applyChartTheme = () => {
            const dark = isDark();

            // kalau kamu punya variable tailwind/css sendiri, bisa ganti var ini sesuai kebutuhan
            const textColor = dark ? 'rgba(226,232,240,.90)' : 'rgba(30,41,59,.90)';
            const gridColor = dark ? 'rgba(148,163,184,.18)' : 'rgba(148,163,184,.25)';
            const tickColor = dark ? 'rgba(226,232,240,.85)' : 'rgba(30,41,59,.85)';

            Chart.defaults.color = textColor;
            Chart.defaults.borderColor = gridColor;

            // update opsi per chart (ticks/grid/legend) biar benar-benar berubah
            Object.values(instances).forEach((ch) => {
                if (!ch) return;

                // scales
                if (ch.options?.scales) {
                    for (const axis of Object.keys(ch.options.scales)) {
                        const sc = ch.options.scales[axis];
                        sc.ticks = sc.ticks || {};
                        sc.grid = sc.grid || {};
                        sc.ticks.color = tickColor;
                        sc.grid.color = gridColor;
                        // border axis
                        sc.border = sc.border || {};
                        sc.border.color = gridColor;
                    }
                }

                // legend label color
                if (ch.options?.plugins?.legend?.labels) {
                    ch.options.plugins.legend.labels.color = tickColor;
                }

                ch.update('none');
            });
        };

        const destroyIfAny = (id) => {
            if (instances[id]) {
                instances[id].destroy();
                delete instances[id];
            }
        };

        const makeBar = (id, data, horizontal = false) => {
            const el = document.getElementById(id);
            if (!el) return;

            destroyIfAny(id);

            instances[id] = new Chart(el, {
                type: 'bar',
                data: {
                    labels: data?.labels || [],
                    datasets: [{
                        label: 'Total',
                        data: data?.values || [],
                        borderWidth: 1,
                        borderRadius: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: horizontal ? 'y' : 'x',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: !horizontal
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        };

        const makeDoughnut = (id, data) => {
            const el = document.getElementById(id);
            if (!el) return;

            destroyIfAny(id);

            instances[id] = new Chart(el, {
                type: 'doughnut',
                data: {
                    labels: data?.labels || [],
                    datasets: [{
                        data: data?.values || [],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 10,
                                boxHeight: 10
                            }
                        }
                    }
                }
            });
        };

        // ===== Render awal =====
        makeDoughnut('chartJK', chartJK);
        makeBar('chartDusun', chartDusun, true);

        makeBar('chartPendidikan', chartPendidikan, true);
        makeBar('chartPekerjaan', chartPekerjaan, true);

        makeDoughnut('chartAgama', chartAgama);
        makeDoughnut('chartStatusPenduduk', chartStatusPenduduk);
        makeDoughnut('chartStatusDasar', chartStatusDasar);

        makeBar('chartBantuan', chartBantuan, true);
        makeBar('chartUmur', chartUmur, false);

        // set theme sesuai kondisi saat ini
        applyChartTheme();

        // ===== Hook ke tombol theme kamu =====
        const themeToggle = document.getElementById('themeToggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                // class dark berubah oleh script kamu → tunggu 1 tick baru apply
                setTimeout(applyChartTheme, 0);
            });
        }

        // Optional: kalau theme berubah dari tempat lain (mis. class diubah manual)
        // pakai MutationObserver biar otomatis
        const obs = new MutationObserver(() => applyChartTheme());
        obs.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ['class']
        });
    })();
</script>


<?= $this->endSection() ?>