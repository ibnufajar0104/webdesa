<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
<?= esc($pageTitle ?? 'Banner') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="w-full max-w-full">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
                <?= esc($pageTitle ?? 'Banner') ?>
            </h2>
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Kelola banner untuk ditampilkan pada halaman utama website desa.
            </p>
        </div>
        <a href="<?= base_url('admin/banner') ?>"
            class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl border 
                        border-blue-500 text-blue-600 text-xs md:text-sm
                        hover:bg-blue-50 active:bg-blue-100
                        dark:border-blue-400 dark:text-blue-300 dark:hover:bg-blue-900/30">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">
        <div class="border-b border-slate-100 px-4 py-3 dark:border-slate-800">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                Form Banner
            </h3>
        </div>

        <div class="px-4 py-4 md:px-5 md:py-5 space-y-3">

            <?php if (!empty($errors)): ?>
                <div class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs text-red-700 dark:border-red-500/40 dark:bg-red-500/10 dark:text-red-100">
                    <ul class="list-disc list-inside space-y-0.5">
                        <?php foreach ($errors as $err): ?>
                            <li><?= esc($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/banner/save') ?>" method="post" class="space-y-3" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($banner['id'] ?? '') ?>">

                <div>
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="title">
                        Judul Banner
                    </label>
                    <input type="text" name="title" id="title"
                        value="<?= esc($banner['title'] ?? '') ?>"
                        class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                        placeholder="Misal: Selamat Datang di Desa Batilai" required>
                </div>

                <div class="grid gap-3 md:grid-cols-2">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="subtitle">
                            Subjudul (Opsional)
                        </label>
                        <input type="text" name="subtitle" id="subtitle"
                            value="<?= esc($banner['subtitle'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Misal: Maju, Mandiri dan Sejahtera">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="position">
                            Urutan Tampil
                        </label>
                        <input type="number" name="position" id="position" min="1"
                            value="<?= esc($banner['position'] ?? 1) ?>"
                            class="w-full max-w-[140px] rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                            Angka lebih kecil akan tampil lebih dulu.
                        </p>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="description">
                        Deskripsi Singkat (Opsional)
                    </label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                        placeholder="Tuliskan teks singkat yang tampil di banner..."><?= esc($banner['description'] ?? '') ?></textarea>
                </div>

                <div class="grid gap-3 md:grid-cols-[2fr,3fr]">
                    <div class="space-y-2">
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="image">
                            Gambar Banner
                        </label>

                        <?php if (!empty($banner['image'])): ?>
                            <div class="mb-2">
                                <div class="w-full max-w-[260px] aspect-[16/9] rounded-xl overflow-hidden border border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                                    <img src="<?= base_url('file/banner/' . $banner['image']) ?>"
                                        alt="banner"
                                        class="w-full h-full object-cover">
                                </div>
                            </div>
                        <?php endif; ?>

                        <input type="file" name="image" id="image"
                            accept="image/*"
                            class="block w-full text-xs text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-100 file:px-3 file:py-1.5 file:text-xs file:font-medium file:text-slate-700 hover:file:bg-slate-200 dark:text-slate-300 dark:file:bg-slate-800 dark:file:text-slate-100 dark:hover:file:bg-slate-700">

                        <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                            Disarankan rasio 16:9, ukuran maksimal &lt; 3 MB. Jika kosong, banner tetap tersimpan tanpa gambar.
                        </p>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">
                            Tombol (Opsional)
                        </label>
                        <div class="grid gap-2 md:grid-cols-2">
                            <div>
                                <input type="text" name="button_text" id="button_text"
                                    value="<?= esc($banner['button_text'] ?? '') ?>"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                                    placeholder="Teks tombol, misal: Selengkapnya">
                            </div>
                            <div>
                                <input type="text" name="button_url" id="button_url"
                                    value="<?= esc($banner['button_url'] ?? '') ?>"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                                    placeholder="URL tujuan, misal: https://...">
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="status">
                                Status
                            </label>
                            <select name="status" id="status"
                                class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                                <option value="active" <?= ($banner['status'] ?? '') === 'active' ? 'selected' : '' ?>>Aktif</option>
                                <option value="inactive" <?= ($banner['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Nonaktif</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="pt-3 mt-2 flex flex-col gap-2 border-t border-slate-100 
                                md:flex-row md:items-center md:justify-end dark:border-slate-800">

                    <a href="<?= base_url('admin/banner') ?>"
                        class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl border
                            border-red-500 text-red-600 text-xs md:text-sm
                            hover:bg-red-50 active:bg-red-100
                            dark:border-red-400 dark:text-red-300 dark:hover:bg-red-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl 
                            bg-primary-600 text-white text-xs md:text-sm font-medium 
                            hover:bg-primary-700 focus:outline-none focus:ring-2 
                            focus:ring-primary-500/70 focus:ring-offset-1 
                            focus:ring-offset-white dark:focus:ring-offset-slate-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>