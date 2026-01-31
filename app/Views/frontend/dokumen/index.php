<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<!-- Hero Section (Premium Gradient) -->
<section class="relative py-16 overflow-hidden bg-gradient-to-br from-emerald-600 to-teal-800 dark:from-slate-900 dark:to-slate-800">
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
        </svg>
    </div>
    <div class="container mx-auto px-4 relative z-10 text-center text-white">
        <h1 class="text-3xl md:text-5xl font-bold mb-4 tracking-tight"><?= esc($title) ?></h1>
        <p class="text-emerald-100 dark:text-slate-400 text-lg md:text-xl max-w-2xl mx-auto">
            Akses terbuka dokumen publik, regulasi, dan laporan pertanggungjawaban pemerintah desa.
        </p>
    </div>
</section>

<section class="py-12 bg-white dark:bg-slate-950 min-h-screen">
    <div class="container mx-auto px-4 -mt-20 relative z-20">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- LEFT COLUMN: Main Content -->
            <div class="w-full lg:w-3/4">
                
                <!-- Search Card -->
                <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-800 mb-8">
                    <form action="<?= base_url('dokumen') ?>" method="get" class="flex flex-col md:flex-row gap-4">
                        <?php if($curr_cat): ?>
                            <input type="hidden" name="kategori" value="<?= esc($curr_cat) ?>">
                        <?php endif; ?>
                        
                        <div class="relative flex-grow">
                            <input type="text" name="q" value="<?= esc($keyword) ?>" 
                                   placeholder="Cari dokumen, peraturan, atau laporan..." 
                                   class="w-full pl-12 pr-4 py-4 rounded-xl border border-emerald-100 bg-emerald-50/30 text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all dark:bg-slate-800 dark:border-slate-700 dark:text-white dark:placeholder-slate-500">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-emerald-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            </span>
                        </div>
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-8 rounded-xl transition-transform active:scale-95 shadow-lg shadow-emerald-200 dark:shadow-none">
                            Cari
                        </button>
                    </form>
                </div>

                <!-- Documents List -->
                <?php if (empty($documents)): ?>
                    <div class="text-center py-20 bg-slate-50 dark:bg-slate-900 rounded-2xl border border-dashed border-slate-300 dark:border-slate-700">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white dark:bg-slate-800 text-slate-300 mb-6 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Tidak ada dokumen ditemukan</h3>
                        <p class="text-slate-500 dark:text-slate-400">Coba gunakan kata kunci lain atau pilih kategori berbeda.</p>
                        <?php if ($keyword || $curr_cat): ?>
                            <a href="<?= base_url('dokumen') ?>" class="inline-block mt-6 px-6 py-2.5 bg-emerald-100 text-emerald-700 hover:bg-emerald-200 rounded-full text-sm font-bold transition">Reset Filter</a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="space-y-4">
                        <?php foreach ($documents as $doc): ?>
                            <div class="group relative bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-4 hover:shadow-lg hover:shadow-emerald-100/50 hover:border-emerald-200 dark:hover:border-emerald-900 hover:-translate-y-0.5 transition-all duration-300">
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center dark:bg-red-900/20 dark:text-red-400 group-hover:scale-105 transition-transform duration-300 border border-red-100 dark:border-red-900/30">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                                        </div>
                                    </div>
                                    <div class="flex-grow min-w-0">
                                        <div class="flex flex-wrap items-center gap-2 mb-1">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-100 dark:bg-emerald-900/30 dark:text-emerald-400 dark:border-emerald-900/50">
                                                <?= esc($doc['kategori_nama'] ?? 'Umum') ?>
                                            </span>
                                            <span class="text-[11px] font-medium text-slate-400 dark:text-slate-500 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                                <?= date('d M Y', strtotime($doc['tanggal'])) ?>
                                            </span>
                                        </div>
                                        <h3 class="text-lg font-bold text-slate-900 mb-1 group-hover:text-emerald-700 transition-colors dark:text-white dark:group-hover:text-emerald-400 leading-snug truncate">
                                            <?= esc($doc['judul']) ?>
                                        </h3>
                                        <?php if (!empty($doc['nomor'])): ?>
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="px-1.5 py-0.5 bg-slate-100 text-slate-600 rounded text-[11px] font-mono dark:bg-slate-800 dark:text-slate-400">No: <?= esc($doc['nomor']) ?></span>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <p class="text-slate-600 dark:text-slate-400 text-sm line-clamp-2 mb-3 leading-relaxed"><?= esc($doc['ringkasan'] ?? '') ?></p>
                                        
                                        <div class="flex items-center pt-3 border-t border-slate-100 dark:border-slate-800">
                                            <?php if (!empty($doc['file_url'])): ?>
                                                <a href="<?= $doc['file_url'] ?>" target="_blank" class="inline-flex items-center text-xs font-bold text-emerald-600 hover:text-emerald-800 dark:text-emerald-400 dark:hover:text-emerald-300 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                    Unduh Dokumen
                                                </a>
                                            <?php else: ?>
                                                <span class="text-xs text-slate-400 italic flex items-center">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                    File tidak tersedia
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination (Premium Style) -->
                    <?php if (!empty($pager_meta['totalPage']) && $pager_meta['totalPage'] > 1): ?>
                        <div class="mt-12 flex justify-center">
                            <nav class="flex items-center gap-2 p-2 bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800">
                                <?php 
                                $curr = $pager_meta['page']; 
                                $total = $pager_meta['totalPage'];
                                $start = max(1, $curr - 2);
                                $end = min($total, $curr + 2);
                                ?>
                                
                                <?php if ($curr > 1): ?>
                                    <a href="<?= base_url('dokumen') ?>?page=<?= $curr - 1 ?>&kategori=<?= $curr_cat ?>&q=<?= $keyword ?>" class="w-10 h-10 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-50 hover:text-emerald-600 transition dark:text-slate-400 dark:hover:bg-slate-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                    </a>
                                <?php endif; ?>

                                <?php for ($i = $start; $i <= $end; $i++): ?>
                                    <a href="<?= base_url('dokumen') ?>?page=<?= $i ?>&kategori=<?= $curr_cat ?>&q=<?= $keyword ?>" 
                                       class="w-10 h-10 flex items-center justify-center rounded-lg font-bold transition <?= $i == $curr ? 'bg-emerald-600 text-white shadow-md shadow-emerald-200 dark:shadow-none' : 'text-slate-600 hover:bg-slate-50 hover:text-emerald-600 dark:text-slate-400 dark:hover:bg-slate-800' ?>">
                                        <?= $i ?>
                                    </a>
                                <?php endfor; ?>

                                <?php if ($curr < $total): ?>
                                    <a href="<?= base_url('dokumen') ?>?page=<?= $curr + 1 ?>&kategori=<?= $curr_cat ?>&q=<?= $keyword ?>" class="w-10 h-10 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-50 hover:text-emerald-600 transition dark:text-slate-400 dark:hover:bg-slate-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                <?php endif; ?>
                            </nav>
                        </div>
                    <?php endif; ?>

                <?php endif; ?>
            </div>

            <!-- RIGHT COLUMN: Sidebar (Premium) -->
            <div class="w-full lg:w-1/4">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 sticky top-24 shadow-sm">
                    <h3 class="font-bold text-slate-900 mb-6 text-lg dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                        Kategori Dokumen
                    </h3>
                    <div class="space-y-1">
                        <a href="<?= base_url('dokumen') ?>" 
                           class="flex items-center justify-between group px-4 py-3 rounded-xl text-sm font-semibold transition-all <?= $curr_cat === '' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'text-slate-600 hover:bg-slate-50 hover:text-emerald-600 hover:translate-x-1 dark:text-slate-400 dark:hover:bg-slate-800' ?>">
                            <span>Semua Kategori</span>
                            <?php if($curr_cat === ''): ?>
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <?php endif; ?>
                        </a>
                        <?php foreach ($categories as $cat): ?>
                             <a href="<?= base_url('dokumen') ?>?kategori=<?= esc($cat['slug']) ?>" 
                               class="flex items-center justify-between group px-4 py-3 rounded-xl text-sm font-semibold transition-all <?= $curr_cat === $cat['slug'] ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'text-slate-600 hover:bg-slate-50 hover:text-emerald-600 hover:translate-x-1 dark:text-slate-400 dark:hover:bg-slate-800' ?>">
                                <span><?= esc($cat['nama']) ?></span>
                                <?php if($curr_cat === $cat['slug']): ?>
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>
