<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<?php
// Helper format angka
$fmt = function($val) {
    if(is_numeric($val)) return number_format($val, 0, ',', '.');
    return $val;
};

// Overview Data
$totalPenerima = $overview['total_penerima_unik'] ?? 0;
$totalProgram = $overview['total_row'] ?? 0; // Using total_row as proxy for total programs if specific count isn't available, or maybe check total_row of overview is not total programs.
// Wait, checking API: total_row in overview is total records. 
// Ah, total_program is NOT in overview API response. 
// I need to count $byBantuan rows for total programs.

// Let's check keys again.
// Overview API: total_row, total_penerima_unik, status, nominal... NO total_program.
// ByBantuan API: list of programs. So I can count $byBantuan.

$totalPenerima = $overview['total_penerima_unik'] ?? 0;
$totalProgram = isset($byBantuan) ? count($byBantuan) : 0;
// $totalDana = $overview['nominal']['sum'] ?? 0; 
?>

<!-- Hero Section -->
<section class="relative py-16 overflow-hidden bg-gradient-to-br from-emerald-600 to-teal-800 dark:from-slate-900 dark:to-slate-800">
    <!-- Background Patterns -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
        </svg>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 text-center text-white">
        <h1 class="text-3xl md:text-5xl font-bold mb-4 tracking-tight">
            Statistik Penerima Bantuan
        </h1>
        <p class="text-emerald-100 dark:text-slate-400 text-lg md:text-xl max-w-2xl mx-auto">
            Transparansi data penerima manfaat program bantuan pemerintah desa untuk kesejahteraan masyarakat.
        </p>
    </div>
</section>

<section class="py-12 bg-white dark:bg-slate-950 transition-colors">
    <div class="container mx-auto px-4 -mt-20 relative z-20">
        
        <!-- 1. OVERVIEW CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 max-w-4xl mx-auto">
            
            <!-- Total Penerima -->
            <div class="bg-white dark:bg-slate-900 p-8 rounded-2xl shadow-xl border border-emerald-100 dark:border-slate-800 flex items-center justify-between group hover:-translate-y-1 transition-transform duration-300">
                <div>
                    <h3 class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Total Penerima Manfaat</h3>
                    <p class="text-4xl font-extrabold text-slate-900 dark:text-white">
                        <?= $fmt($totalPenerima) ?>
                        <span class="text-lg font-medium text-slate-400 font-sans">Jiwa/KK</span>
                    </p>
                </div>
                <div class="w-16 h-16 bg-emerald-50 dark:bg-emerald-900/20 rounded-2xl flex items-center justify-center text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>

            <!-- Total Program -->
            <div class="bg-white dark:bg-slate-900 p-8 rounded-2xl shadow-xl border border-teal-100 dark:border-slate-800 flex items-center justify-between group hover:-translate-y-1 transition-transform duration-300">
                <div>
                    <h3 class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Program Bantuan</h3>
                    <p class="text-4xl font-extrabold text-slate-900 dark:text-white">
                        <?= $fmt($totalProgram) ?>
                        <span class="text-lg font-medium text-slate-400 font-sans">Program</span>
                    </p>
                </div>
                <div class="w-16 h-16 bg-teal-50 dark:bg-teal-900/20 rounded-2xl flex items-center justify-center text-teal-600 dark:text-teal-400 group-hover:scale-110 transition-transform">
                    <!-- Icon: List/Clipboard instead of generic -->
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
            </div>

        </div>

        <!-- 2. Program Breakdown Grid -->
        <div class="mb-8">
            <div class="text-center mb-10">
                <span class="text-emerald-600 dark:text-emerald-400 font-bold tracking-wider uppercase text-xs">Rincian Data</span>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white mt-2 font-serif">Program Bantuan Desa</h2>
            </div>

            <?php if(!empty($byBantuan)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach($byBantuan as $r): 
                         $count = $r['total_penerima_unik'] ?? 0;
                         $name = $r['nama_bantuan'] ?? $r['program'] ?? 'Program Lainnya';
                    ?>
                    <div class="group bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 dark:border-slate-800 hover:border-emerald-200 dark:hover:border-emerald-900 relative overflow-hidden">
                        
                        <!-- Decorative bg -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 dark:bg-emerald-900/10 rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>

                        <div class="relative z-10">
                            <!-- Icon: Users/Group instead of dollar -->
                            <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            
                            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-2 leading-snug group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                <?= esc($name) ?>
                            </h3>
                            
                            <div class="flex items-end gap-2 mt-4">
                                <span class="text-3xl font-extrabold text-slate-900 dark:text-slate-100">
                                    <?= $fmt($count) ?>
                                </span>
                                <span class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-1.5">Penerima</span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-16 bg-slate-50 dark:bg-slate-900 rounded-2xl border border-dashed border-slate-300 dark:border-slate-700">
                    <svg class="w-16 h-16 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <p class="text-lg text-slate-500 dark:text-slate-400 font-medium">Belum ada data program bantuan yang tersedia.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<?= $this->endSection() ?>
