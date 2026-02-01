<?= $this->extend('layout/default') ?>

<?= $this->section('meta') ?>
<title>Statistik Penduduk - Desa Batilai</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
// Helper untuk extract single value dari array group (untuk gender)
$getVal = function($arr, $keyStr) {
    foreach($arr as $r) {
        if(($r['key'] ?? '') === $keyStr) return $r['total'];
    }
    return 0;
};

// Helper format angka (handle masked <5)
$fmt = function($val) {
    if(is_numeric($val)) return number_format($val, 0, ',', '.');
    return $val; // return as string (e.g. "<5")
};

// Extract totals
$totalPenduduk = $overview['total'] ?? 0;
$totalKK = $kk['total_kk'] ?? 0;
$totalL = $getVal($overview['gender'] ?? [], 'L');
$totalP = $getVal($overview['gender'] ?? [], 'P');
?>

<!-- Hero Section with Pattern -->
<section class="relative pt-12 pb-24 overflow-hidden bg-gradient-to-br from-emerald-600 to-teal-900 dark:from-slate-900 dark:to-slate-900">
    <!-- Background Gradients -->
    <div class="absolute inset-0 pointer-events-none">
        <!-- Light Mode Accents -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-white/10 rounded-full blur-3xl -mr-20 -mt-20 mix-blend-overlay dark:hidden"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-teal-400/20 rounded-full blur-3xl -ml-20 dark:hidden"></div>
        
        <!-- Dark Mode Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-transparent to-black/20 dark:from-slate-900 dark:via-slate-900 dark:to-emerald-950/40"></div>
    </div>
    
    <!-- Abstract Pattern Overlay -->
    <div class="absolute inset-0 opacity-[0.05] pointer-events-none bg-[url('https://grainy-gradients.vercel.app/noise.svg')] bg-cover"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8">
            <!-- Left: Text Content -->
            <div class="w-full md:w-2/3 text-left space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm self-start shadow-sm">
                    <span class="flex h-1.5 w-1.5 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-200 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-300"></span>
                    </span>
                    <span class="text-[10px] font-bold tracking-wide text-emerald-100 uppercase">Data Kependudukan</span>
                </div>

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-white leading-tight drop-shadow-sm">
                    Statistik & Demografi <br>
                    <span class="text-emerald-100">Desa Batilai</span>
                </h1>

                <p class="text-sm md:text-base text-emerald-100/90 leading-relaxed max-w-lg border-l-2 border-emerald-400/30 pl-4 font-medium">
                    Menyajikan data kependudukan secara transparan, akurat, dan <em>real-time</em> sebagai wujud keterbukaan informasi publik.
                </p>
            </div>

            <!-- Right: Neat Element (Glass Card) -->
            <div class="w-full md:w-auto">
                <div class="flex items-center gap-4 bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 shadow-xl ring-1 ring-white/10 hover:bg-white/15 transition-colors">
                    <div class="p-3 bg-white/20 rounded-xl text-white shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-xs text-emerald-100 uppercase tracking-wider font-bold">Total Penduduk</span>
                        <span class="text-2xl font-bold text-white tracking-tight"><?= number_format($overview['total'] ?? 0, 0, ',', '.') ?> <span class="text-sm font-medium text-emerald-200">Jiwa</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-12 bg-slate-50 dark:bg-slate-950 -mt-10">
    <div class="container mx-auto px-4 space-y-12 -mt-20 relative z-20">

        <!-- 1. OVERVIEW CARDS (Floating effect) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 relative z-20">
            <!-- Total Penduduk -->
            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 hover:-translate-y-1 transition-transform duration-300">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Penduduk</p>
                        <h3 class="text-3xl font-bold text-slate-800 dark:text-slate-100 mt-1"><?= $fmt($totalPenduduk) ?></h3>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center dark:bg-emerald-900/30 dark:text-emerald-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-1.5 overflow-hidden">
                    <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 100%"></div>
                </div>
                <p class="text-xs text-slate-400 mt-2">Jiwa</p>
            </div>

            <!-- Total KK -->
            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 hover:-translate-y-1 transition-transform duration-300">
                 <div class="flex items-start justify-between mb-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Kepala Keluarga</p>
                        <h3 class="text-3xl font-bold text-slate-800 dark:text-slate-100 mt-1"><?= $fmt($totalKK) ?></h3>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center dark:bg-blue-900/30 dark:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                </div>
                 <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-1.5 overflow-hidden">
                    <div class="bg-blue-500 h-1.5 rounded-full" style="width: 100%"></div>
                </div>
                <p class="text-xs text-slate-400 mt-2">Kartu Keluarga</p>
            </div>

            <!-- Laki-laki -->
            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 hover:-translate-y-1 transition-transform duration-300">
                 <div class="flex items-start justify-between mb-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Laki-laki</p>
                        <h3 class="text-3xl font-bold text-slate-800 dark:text-slate-100 mt-1"><?= $fmt($totalL) ?></h3>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center dark:bg-indigo-900/30 dark:text-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
                <?php 
                    $pctL = ($totalPenduduk > 0 && is_numeric($totalL)) ? ($totalL / $totalPenduduk) * 100 : 0;
                ?>
                 <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-1.5 overflow-hidden">
                    <div class="bg-indigo-500 h-1.5 rounded-full" style="width: <?= $pctL ?>%"></div>
                </div>
                <p class="text-xs text-slate-400 mt-2"><?= round($pctL, 1) ?>% dari total</p>
            </div>

            <!-- Perempuan -->
            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 hover:-translate-y-1 transition-transform duration-300">
                 <div class="flex items-start justify-between mb-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Perempuan</p>
                        <h3 class="text-3xl font-bold text-slate-800 dark:text-slate-100 mt-1"><?= $fmt($totalP) ?></h3>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center dark:bg-rose-900/30 dark:text-rose-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
                <?php 
                    $pctP = ($totalPenduduk > 0 && is_numeric($totalP)) ? ($totalP / $totalPenduduk) * 100 : 0;
                ?>
                 <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-1.5 overflow-hidden">
                    <div class="bg-rose-500 h-1.5 rounded-full" style="width: <?= $pctP ?>%"></div>
                </div>
                <p class="text-xs text-slate-400 mt-2"><?= round($pctP, 1) ?>% dari total</p>
            </div>
        </div>

        <!-- 2. Tren Populasi (AJAX) -->
        <div>
            <div class="flex items-center gap-3 mb-6">
                <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Tren Populasi</h2>
                <div class="h-px bg-slate-200 dark:bg-slate-800 flex-grow"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Tren Tahunan -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-slate-800 dark:text-slate-100">Tren Tahunan</h3>
                        <select id="filterTahun" class="text-sm border-slate-200 dark:border-slate-700 rounded-lg bg-slate-50 dark:bg-slate-800 py-1 px-3 focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="2" <?= ($rangeTahun ?? 5) == 2 ? 'selected' : '' ?>>2 Tahun Terakhir</option>
                            <option value="5" <?= ($rangeTahun ?? 5) == 5 ? 'selected' : '' ?>>5 Tahun Terakhir</option>
                            <option value="10" <?= ($rangeTahun ?? 5) == 10 ? 'selected' : '' ?>>10 Tahun Terakhir</option>
                        </select>
                    </div>
                    <div class="relative h-64 w-full">
                        <canvas id="chartTahun"></canvas>
                    </div>
                </div>

                <!-- Tren Bulanan -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-slate-800 dark:text-slate-100">Tren Bulanan</h3>
                         <select id="filterBulan" class="text-sm border-slate-200 dark:border-slate-700 rounded-lg bg-slate-50 dark:bg-slate-800 py-1 px-3 focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="12" <?= ($rangeBulan ?? 24) == 12 ? 'selected' : '' ?>>12 Bulan Terakhir</option>
                            <option value="24" <?= ($rangeBulan ?? 24) == 24 ? 'selected' : '' ?>>24 Bulan Terakhir</option>
                            <option value="36" <?= ($rangeBulan ?? 24) == 36 ? 'selected' : '' ?>>36 Bulan Terakhir</option>
                        </select>
                    </div>
                    <div class="relative h-64 w-full">
                        <canvas id="chartBulan"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Demografi Charts (Rearranged Layout) -->
        <div class="space-y-8">

            <!-- Row 1: Usia & Agama -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <!-- Sebaran Usia (Large) -->
                 <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 shadow-sm h-full flex flex-col min-h-[500px]">
                    <div class="flex items-center justify-between mb-6 shrink-0">
                        <h3 class="font-bold text-2xl text-slate-800 dark:text-slate-100">Sebaran Usia</h3>
                        <div class="px-3 py-1.5 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 text-sm font-bold text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-800">
                            Dominan: <?= !empty($overview['usia']) ? esc($overview['usia'][0]['label']) : '-' ?> Thn
                        </div>
                    </div>
                    
                    <?php if(!empty($overview['usia'])): ?>
                        <div class="space-y-3 custom-scrollbar overflow-y-auto flex-grow pr-2 max-h-[600px]">
                            <?php 
                            $maxVal = 0;
                            $totalUsia = 0;
                            foreach($overview['usia'] as $r) {
                                $val = is_numeric($r['total']) ? (int)$r['total'] : 0;
                                $maxVal = max($maxVal, $val);
                                $totalUsia += $val;
                            }

                            foreach($overview['usia'] as $r): 
                                 $count = $r['total'];
                                 $label = $r['label'];
                                 $num = is_numeric($count) ? (int)$count : 0; 
                                 $percent = ($maxVal > 0) ? ($num / $maxVal) * 100 : 0;
                                 $share = ($totalUsia > 0) ? ($num / $totalUsia) * 100 : 0;
                                 
                                 $barColor = $percent > 70 ? 'bg-gradient-to-r from-emerald-500 to-teal-400' : 
                                            ($percent > 40 ? 'bg-gradient-to-r from-emerald-400 to-teal-300' : 'bg-slate-300 dark:bg-slate-700');
                                 $textColor = $percent > 70 ? 'text-emerald-700 dark:text-emerald-400' : 'text-slate-600 dark:text-slate-400';
                            ?>
                            <div class="group">
                                <div class="flex justify-between text-sm mb-1.5">
                                    <span class="font-medium text-slate-600 dark:text-slate-300 w-20"><?= esc($label) ?> Thn</span>
                                    <div class="flex-grow mx-3 pt-2">
                                         <div class="w-full bg-slate-100 rounded-full h-2 dark:bg-slate-800 overflow-hidden">
                                            <div class="<?= $barColor ?> h-2 rounded-full transition-all duration-1000 ease-out group-hover:brightness-110" style="width: <?= $percent ?>%"></div>
                                        </div>
                                    </div>
                                    <div class="text-right w-16">
                                         <span class="font-bold <?= $textColor ?>"><?= $fmt($count) ?></span>
                                         <span class="text-xs text-slate-400 ml-1 block sm:inline">(<?= round($share, 1) ?>%)</span>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="flex flex-col items-center justify-center p-12 text-center text-slate-400 h-full">
                            <p>Data usia belum tersedia.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Agama (Standard) -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-sm h-full">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-xl text-slate-800 dark:text-slate-100">Agama</h3>
                        <div class="w-10 h-10 rounded-full bg-rose-50 dark:bg-rose-900/30 text-rose-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                        </div>
                    </div>
                    
                    <div class="space-y-4 overflow-y-auto custom-scrollbar max-h-[500px] pr-2">
                         <?php if(!empty($overview['agama'])): ?>
                            <?php 
                            $totalAgama = 0;
                            foreach($overview['agama'] as $r) {
                                if(is_numeric($r['total'])) $totalAgama += $r['total'];
                            }

                            foreach($overview['agama'] as $r): 
                                 $count = $r['total'];
                                 $label = $r['label'];
                                 $num = is_numeric($count) ? $count : 0;
                                 $percentA = ($totalAgama > 0) ? ($num / $totalAgama) * 100 : 0;
                            ?>
                            <div class="relative">
                                 <div class="flex items-center justify-between mb-1 z-10 relative">
                                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-200"><?= esc($label) ?></span>
                                    <span class="text-sm font-bold text-slate-800 dark:text-slate-100"><?= $fmt($count) ?> <span class="text-xs text-slate-400 font-normal ml-0.5">(<?= round($percentA, 1) ?>%)</span></span>
                                </div>
                                <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2">
                                    <div class="bg-rose-500 h-2 rounded-full" style="width: <?= $percentA ?>%"></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                             <p class="text-slate-400 text-sm text-center">Data tidak tersedia.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <!-- Row 2: Pendidikan & Pekerjaan -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Pendidikan (Standard) -->
                 <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-sm h-full">
                    <div class="flex items-center justify-between mb-6">
                         <h3 class="font-bold text-xl text-slate-800 dark:text-slate-100">Pendidikan Terakhir</h3>
                         <div class="w-10 h-10 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>
                         </div>
                    </div>

                    <div class="overflow-y-auto custom-scrollbar max-h-[500px] pr-2">
                        <table class="w-full text-sm text-left">
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                <?php if(!empty($overview['pendidikan'])): ?>
                                    <?php foreach($overview['pendidikan'] as $r): ?>
                                    <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                        <td class="py-3 pl-2 text-slate-700 dark:text-slate-300 font-medium"><?= esc($r['label']) ?></td>
                                        <td class="py-3 pr-2 text-right font-bold text-indigo-600 dark:text-indigo-400"><?= $fmt($r['total']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="2" class="py-4 text-center text-slate-400">Data Kosong</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pekerjaan (Large) -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 shadow-sm h-full flex flex-col min-h-[500px] relative">
                     <div class="flex items-center justify-between mb-6 shrink-0">
                         <h3 class="font-bold text-2xl text-slate-800 dark:text-slate-100">Pekerjaan Utama</h3>
                          <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-900/30 text-amber-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                         </div>
                    </div>
                    
                    <div class="overflow-y-auto custom-scrollbar flex-grow pr-2 max-h-[600px]">
                        <table class="w-full text-sm text-left">
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800 border-t border-slate-100 dark:border-slate-800">
                                <?php if(!empty($overview['pekerjaan'])): ?>
                                    <?php foreach($overview['pekerjaan'] as $r): ?>
                                    <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                        <td class="py-3.5 pl-2 text-slate-700 dark:text-slate-300 font-medium"><?= esc($r['label']) ?></td>
                                        <td class="py-3.5 pr-2 text-right font-bold text-slate-800 dark:text-slate-100"><?= $fmt($r['total']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="2" class="py-12 text-center text-slate-400">Data Kosong</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Fade element -->
                    <div class="absolute bottom-0 left-0 w-full h-20 bg-gradient-to-t from-white dark:from-slate-900 to-transparent pointer-events-none rounded-b-3xl"></div>
                </div>
            </div>

        </div>

        <!-- 4. Wilayah Sections (Glassy Tables) -->
        <div>
            <div class="flex items-center gap-3 mb-6">
                <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Statistik Kewilayahan</h2>
                <div class="h-px bg-slate-200 dark:bg-slate-800 flex-grow"></div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Per Dusun -->
                <div class="bg-white dark:bg-slate-900 rounded-3xl overflow-hidden shadow-sm border border-slate-200 dark:border-slate-800">
                    <div class="p-6 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
                        <h3 class="font-bold text-slate-800 dark:text-slate-100">Per Dusun</h3>
                    </div>
                    <div class="p-0">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-slate-50/50 text-slate-500 dark:text-slate-400">
                                <tr>
                                    <th class="py-3 px-6 font-medium">Nama Dusun</th>
                                    <th class="py-3 px-6 text-right font-medium">Total Penduduk</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                <?php if(!empty($wilayah['dusun'])): ?>
                                    <?php foreach($wilayah['dusun'] as $d): ?>
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                        <td class="py-3 px-6 font-medium text-slate-700 dark:text-slate-300 flex items-center gap-2">
                                            <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                            <?= esc($d['nama_dusun'] ?? '-') ?>
                                        </td>
                                        <td class="py-3 px-6 text-right font-bold text-slate-800 dark:text-slate-200"><?= $fmt($d['total']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="2" class="text-center py-6 text-slate-400">Data Dusun Kosong</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Per RT -->
                <div class="bg-white dark:bg-slate-900 rounded-3xl overflow-hidden shadow-sm border border-slate-200 dark:border-slate-800">
                     <div class="p-6 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
                         <h3 class="font-bold text-slate-800 dark:text-slate-100">Per RT</h3>
                    </div>
                    <div class="overflow-x-auto max-h-96 custom-scrollbar">
                         <table class="w-full text-sm text-left">
                            <thead class="bg-slate-50/50 text-slate-500 dark:text-slate-400 sticky top-0 backdrop-blur-sm">
                                <tr>
                                    <th class="py-3 px-6 font-medium">RT</th>
                                    <th class="py-3 px-6 font-medium">Dusun</th>
                                    <th class="py-3 px-6 text-right font-medium">Populasi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                <?php if(!empty($wilayah['rt'])): ?>
                                    <?php foreach($wilayah['rt'] as $r): ?>
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                        <td class="py-3 px-6 font-medium text-slate-700 dark:text-slate-300">
                                            <span class="inline-flex items-center justify-center px-2 py-1 rounded bg-slate-100 dark:bg-slate-800 text-xs text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-700">RT <?= esc($r['no_rt'] ?? '-') ?></span>
                                        </td>
                                        <td class="py-3 px-6 text-slate-500 dark:text-slate-400 text-xs"><?= esc($r['nama_dusun'] ?? '-') ?></td>
                                        <td class="py-3 px-6 text-right font-bold text-slate-800 dark:text-slate-200"><?= $fmt($r['total']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="3" class="text-center py-6 text-slate-400">Data RT Kosong</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Initialize Charts -->
<script>
    const isDark = document.documentElement.classList.contains('dark');
    const colorLine = isDark ? '#10b981' : '#059669'; // emerald-500 / 600
    const colorGrid = isDark ? '#1e293b' : '#f1f5f9'; // slate-800 / 100
    const colorText = isDark ? '#94a3b8' : '#64748b'; // slate-400 / 500

    let chartTahunInstance = null;
    let chartBulanInstance = null;

    // Data from Controller (Initial Load)
    const initialTahun = <?= json_encode($tren['tahun'] ?? []) ?>;
    const initialBulan = <?= json_encode($tren['bulan'] ?? []) ?>;

    const parseChartData = (data) => {
        return {
            labels: data.map(item => item.periode),
            values: data.map(item => item.total ? parseInt(item.total) : (item.total_row ? parseInt(item.total_row) : 0))
        };
    };

    const createChart = (ctx, data, labelStr) => {
        // Gradient fill
        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)'); 
        gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

        const parsed = parseChartData(data);

        return new Chart(ctx, {
            type: 'line',
            data: {
                labels: parsed.labels,
                datasets: [{
                    label: labelStr,
                    data: parsed.values,
                    borderColor: colorLine,
                    backgroundColor: gradient,
                    borderWidth: 2,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: colorLine,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: isDark ? '#1e293b' : '#fff',
                        titleColor: isDark ? '#f1f5f9' : '#1e293b',
                        bodyColor: isDark ? '#cbd5e1' : '#475569',
                        borderColor: isDark ? '#334155' : '#e2e8f0',
                        borderWidth: 1
                    }
                },
                scales: {
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: { color: colorText }
                    },
                    y: {
                        grid: { color: colorGrid, borderDash: [5, 5] },
                        ticks: { color: colorText },
                        beginAtZero: false
                    }
                }
            }
        });
    };

    // Initialize
    if(document.getElementById('chartTahun')) {
        const ctx = document.getElementById('chartTahun').getContext('2d');
        chartTahunInstance = createChart(ctx, initialTahun, 'Total Populasi');
    }

    if(document.getElementById('chartBulan')) {
        const ctx = document.getElementById('chartBulan').getContext('2d');
        chartBulanInstance = createChart(ctx, initialBulan, 'Total Populasi');
    }

    // AJAX Handler
    const updateChart = async (type, range, chartInstance) => {
        try {
            const response = await fetch(`<?= base_url('statistik/tren-data') ?>?by=${type}&range=${range}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const data = await response.json();
            const parsed = parseChartData(data);

            chartInstance.data.labels = parsed.labels;
            chartInstance.data.datasets[0].data = parsed.values;
            chartInstance.update();

        } catch (error) {
            console.error('Failed to fetch chart data:', error);
        }
    };

    // Listeners
    document.getElementById('filterTahun').addEventListener('change', function() {
        updateChart('year', this.value, chartTahunInstance);
    });

    document.getElementById('filterBulan').addEventListener('change', function() {
        updateChart('month', this.value, chartBulanInstance);
    });

</script>

<!-- Custom Scrollbar Style for Webkit -->
<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #cbd5e1;
        border-radius: 20px;
    }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #475569;
    }
</style>

<?= $this->endSection() ?>
