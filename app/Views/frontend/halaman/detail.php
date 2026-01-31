<?= $this->extend('layout/default') ?>

<?= $this->section('meta') ?>
<title><?= $page['title'] ?> - Desa Batilai</title>
<meta name="description" content="<?= substr(strip_tags($page['content']), 0, 160) ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<!-- Hero Section -->
<section class="relative py-16 overflow-hidden bg-gradient-to-br from-emerald-600 to-teal-800 dark:from-slate-900 dark:to-slate-800">
    <!-- Different Pattern: Wave -->
    <div class="absolute inset-x-0 bottom-0 opacity-10 pointer-events-none">
        <svg class="w-full h-24" viewBox="0 0 100 100" preserveAspectRatio="none">
             <path d="M0 50 Q 50 100 100 50 L 100 100 L 0 100 Z" fill="white" />
        </svg>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 text-center text-white">
        <h1 class="text-3xl md:text-5xl font-bold mb-4 tracking-tight">
             <?= $page['title'] ?>
        </h1>
        <div class="text-emerald-100 dark:text-slate-400 text-lg md:text-xl max-w-2xl mx-auto flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span><?= \CodeIgniter\I18n\Time::parse($page['updated_at'])->toLocalizedString('d MMMM yyyy') ?></span>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-white dark:bg-slate-900 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- Main Content -->
            <div class="lg:col-span-8">
                <article class="prose prose-lg prose-emerald dark:prose-invert max-w-none bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
                    <!-- Featured Image (Optional, if Page has one) -->
                    <!-- 
                    <?php if (!empty($page['image_url'])): ?>
                    <div class="rounded-xl overflow-hidden mb-8 shadow-md">
                        <img src="<?= $page['image_url'] ?>" alt="<?= $page['title'] ?>" class="w-full h-auto object-cover">
                    </div>
                    <?php endif; ?>
                     -->

                    <!-- Body Content -->
                    <div class="content-body">
                        <?= $page['content'] ?>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-8">
                
                <!-- Search Widget -->
                <div class="bg-slate-50 dark:bg-slate-800 p-6 rounded-2xl border border-slate-100 dark:border-slate-700">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Cari Halaman
                    </h3>
                    <form action="/halaman/search" method="get" class="relative">
                        <input type="text" name="q" placeholder="Ketik kata kunci..." class="w-full pl-4 pr-10 py-3 rounded-xl bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
                        <button type="submit" class="absolute right-3 top-3 text-slate-400 hover:text-emerald-500">
                           <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>
                </div>

                <!-- Related Pages -->
                <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6 pb-3 border-b border-slate-100 dark:border-slate-700 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        Halaman Lainnya
                    </h3>
                    
                    <div class="space-y-4">
                        <?php if (!empty($related_pages)): ?>
                            <?php foreach ($related_pages as $item): ?>
                            <a href="<?= site_url('halaman/' . $item['slug']) ?>" class="group block">
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 w-2 h-2 rounded-full bg-slate-300 group-hover:bg-emerald-500 transition-colors"></div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-slate-600 dark:text-slate-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors line-clamp-2">
                                            <?= $item['title'] ?>
                                        </h4>
                                        <p class="text-xs text-slate-400 mt-1"><?= \CodeIgniter\I18n\Time::parse($item['updated_at'])->toLocalizedString('d MMMM yyyy') ?></p>
                                    </div>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-sm text-slate-400 italic">Tidak ada halaman lain.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
