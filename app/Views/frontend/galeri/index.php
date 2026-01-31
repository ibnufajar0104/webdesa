<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<!-- Profile Header (Instagram Style) -->
<section class="bg-white dark:bg-slate-950 pt-10 pb-8 border-b border-slate-200 dark:border-slate-800">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="flex flex-col md:flex-row items-center gap-8">
            <div class="shrink-0">
                <div class="w-24 h-24 md:w-32 md:h-32 rounded-full p-1 bg-gradient-to-tr from-emerald-400 to-teal-600">
                    <div class="w-full h-full rounded-full bg-white dark:bg-slate-900 p-1">
                        <img src="<?= base_url('logo.png') ?>" alt="Desa Batilai" class="w-full h-full rounded-full object-cover">
                    </div>
                </div>
            </div>
            <div class="text-center md:text-left">
                <div class="flex flex-col md:flex-row items-center gap-4 mb-3">
                    <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Desa Batilai Gallery</h1>
                    <?php if(!empty($pager_meta['total'])): ?>
                    <span class="px-4 py-1.5 bg-slate-100 dark:bg-slate-800 rounded-lg text-sm font-semibold text-slate-600 dark:text-slate-300">
                        <?= number_format($pager_meta['total']) ?> Postingan
                    </span>
                    <?php endif; ?>
                </div>
                <p class="text-slate-600 dark:text-slate-400 max-w-lg">
                    Dokumentasi kegiatan, pembangunan, dan momen spesial warga Desa Batilai. 
                    Transparansi visual untuk masyarakat.
                </p>
                <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-2">
                    <span class="text-xs font-bold text-blue-600 bg-blue-50 dark:bg-blue-900/20 px-3 py-1 rounded-full">#KegiatanDesa</span>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 px-3 py-1 rounded-full">#Pembangunan</span>
                    <span class="text-xs font-bold text-rose-600 bg-rose-50 dark:bg-rose-900/20 px-3 py-1 rounded-full">#WargaBatilai</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-8 bg-white dark:bg-slate-950 min-h-screen">
    <div class="container mx-auto px-4 max-w-5xl">
        
        <?php if(empty($gallery)): ?>
            <div class="text-center py-20 flex flex-col items-center">
                <div class="w-20 h-20 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center text-slate-400 mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <h3 class="text-lg font-medium text-slate-800 dark:text-slate-200">Belum ada postingan</h3>
                <p class="text-slate-500">Galeri foto desa masih kosong saat ini.</p>
            </div>
        <?php else: ?>
            
            <div class="grid grid-cols-2 md:grid-cols-3 gap-1 md:gap-4">
                <?php foreach($gallery as $item): ?>
                    <div class="relative group aspect-square bg-slate-100 dark:bg-slate-800 overflow-hidden cursor-pointer" onclick="openModal('<?= esc($item['file_url']) ?>', '<?= esc($item['judul']) ?>', '<?= esc($item['caption']) ?>', '<?= esc($item['created_at']) ?>')">
                        <img src="<?= $item['file_url'] ?>" alt="<?= esc($item['judul']) ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                        
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <div class="text-white text-center p-4 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <h3 class="font-bold text-sm md:text-base line-clamp-1 mb-1"><?= esc($item['judul']) ?></h3>
                                <p class="text-xs text-white/80"><?= date('d M Y', strtotime($item['created_at'])) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if (!empty($pager_meta['totalPage']) && $pager_meta['totalPage'] > 1): ?>
                <div class="mt-12 flex justify-center">
                    <div class="flex space-x-1">
                        <?php 
                        $curr = $pager_meta['page']; 
                        $total = $pager_meta['totalPage'];
                        $start = max(1, $curr - 2);
                        $end = min($total, $curr + 2);
                        ?>
                        
                        <?php if ($curr > 1): ?>
                            <a href="<?= base_url('galeri') ?>?page=<?= $curr - 1 ?>" class="px-4 py-2 border border-slate-300 rounded-lg text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-400 dark:hover:bg-slate-800">Prev</a>
                        <?php endif; ?>

                        <?php for ($i = $start; $i <= $end; $i++): ?>
                            <a href="<?= base_url('galeri') ?>?page=<?= $i ?>" 
                               class="px-4 py-2 border <?= $i == $curr ? 'border-emerald-600 bg-emerald-600 text-white' : 'border-slate-300 text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-400 dark:hover:bg-slate-800' ?> rounded-lg">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($curr < $total): ?>
                            <a href="<?= base_url('galeri') ?>?page=<?= $curr + 1 ?>" class="px-4 py-2 border border-slate-300 rounded-lg text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-400 dark:hover:bg-slate-800">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</section>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/90 backdrop-blur-sm" onclick="closeModal()"></div>
    
    <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
        <div class="bg-white dark:bg-slate-900 rounded-lg overflow-hidden flex flex-col md:flex-row max-w-5xl w-full max-h-[90vh] shadow-2xl pointer-events-auto transform transition-all scale-95 opacity-0" id="modalContent">
            
            <!-- Close Button Mobile -->
            <button onclick="closeModal()" class="absolute top-2 right-2 md:hidden z-10 bg-black/50 text-white p-2 rounded-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Image Side -->
            <div class="bg-black flex items-center justify-center w-full md:w-3/5 lg:w-2/3 h-[50vh] md:h-auto">
                <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain">
            </div>

            <!-- Content Side -->
            <div class="w-full md:w-2/5 lg:w-1/3 flex flex-col bg-white dark:bg-slate-900 h-full md:max-h-[80vh] md:h-auto">
                <div class="p-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                         <div class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-700 overflow-hidden">
                             <img src="<?= base_url('logo.png') ?>" class="w-full h-full object-cover">
                         </div>
                         <span class="font-bold text-sm text-slate-900 dark:text-white">Desa Batilai</span>
                    </div>
                    <!-- Close Desktop -->
                    <button onclick="closeModal()" class="text-slate-400 hover:text-red-500 hidden md:block">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="p-6 overflow-y-auto flex-1">
                    <h3 id="modalTitle" class="text-xl font-bold text-slate-900 dark:text-white mb-3"></h3>
                    <p id="modalCaption" class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed whitespace-pre-line"></p>
                    
                    <div class="mt-6 pt-6 border-t border-slate-100 dark:border-slate-800">
                        <p id="modalDate" class="text-xs font-semibold text-slate-400 uppercase tracking-widest"></p>
                    </div>
                </div>

                <!-- Footer (Buttons Removed) -->
                <!-- <div class="p-4 border-t border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50"></div> -->
            </div>
        </div>
    </div>
</div>

<script>
    function formatDate(dateString) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }

    function openModal(imgUrl, title, caption, date) {
        const modal = document.getElementById('imageModal');
        const content = document.getElementById('modalContent');
        
        document.getElementById('modalImage').src = imgUrl;
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalCaption').textContent = caption;
        document.getElementById('modalDate').textContent = formatDate(date);

        modal.classList.remove('hidden');
        // Animation
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
        
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('imageModal');
        const content = document.getElementById('modalContent');
        
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }
</script>

<?= $this->endSection() ?>
