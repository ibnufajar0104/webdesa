<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?><?= esc($pageTitle ?? 'Galery') ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="w-full max-w-full">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100"><?= esc($pageTitle ?? 'Galery') ?></h2>
            <p class="text-xs text-slate-500 dark:text-slate-400">Form foto galery.</p>
        </div>
        <a href="<?= base_url('admin/galery') ?>"
            class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl border border-blue-500 text-blue-600 text-xs md:text-sm hover:bg-blue-50 dark:border-blue-400 dark:text-blue-300 dark:hover:bg-blue-900/30">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">
        <div class="border-b border-slate-100 px-4 py-3 dark:border-slate-800">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Form Galery</h3>
        </div>

        <div class="px-4 py-4 md:px-5 md:py-5 space-y-3">
            <?php if (!empty($errors)): ?>
                <div class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs text-red-700 dark:border-red-500/40 dark:bg-red-500/10 dark:text-red-100">
                    <ul class="list-disc list-inside space-y-0.5">
                        <?php foreach ($errors as $err): ?><li><?= esc($err) ?></li><?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/galery/save') ?>" method="post" class="space-y-4" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($row['id'] ?? '') ?>">
                <input type="hidden" name="file_path_old" value="<?= esc($row['file_path'] ?? '') ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="judul">Judul (opsional)</label>
                        <input type="text" name="judul" id="judul"
                            value="<?= esc($row['judul'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="caption">Caption (opsional)</label>
                        <textarea name="caption" id="caption" rows="3"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"><?= esc($row['caption'] ?? '') ?></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="urut">Urut</label>
                        <input type="number" name="urut" id="urut" required
                            value="<?= esc($row['urut'] ?? 0) ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="is_active">Status</label>
                        <select name="is_active" id="is_active"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="1" <?= (int)($row['is_active'] ?? 1) === 1 ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= (int)($row['is_active'] ?? 1) === 0 ? 'selected' : '' ?>>Non Aktif</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="foto_file">
                            Foto <?= !empty($row['id']) ? '(opsional jika tidak diganti)' : '(wajib)' ?>
                        </label>

                        <input type="file" name="foto_file" id="foto_file" accept="image/*"
                            class="block w-full text-xs text-slate-700 dark:text-slate-100
                file:mr-2 file:rounded-lg file:border-0
                file:bg-slate-100 file:px-2.5 file:py-1.5 file:text-xs
                hover:file:bg-slate-200
                dark:file:bg-slate-800 dark:hover:file:bg-slate-700">

                        <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                            Format: JPG, PNG, WEBP. Maksimal 5MB.
                        </p>

                        <?php if (!empty($row['file_path'])): ?>
                            <?php $basename = basename($row['file_path']); ?>
                            <a href="<?= base_url('file/galery/' . $basename) ?>" target="_blank"
                                class="mt-2 inline-flex items-center gap-2 text-[11px] text-sky-600 hover:underline dark:text-sky-300">
                                <span>Lihat foto saat ini</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="pt-3 mt-2 flex flex-col gap-2 border-t border-slate-100 md:flex-row md:items-center md:justify-end dark:border-slate-800">
                    <a href="<?= base_url('admin/galery') ?>"
                        class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl border border-red-500 text-red-600 text-xs md:text-sm hover:bg-red-50 dark:border-red-400 dark:text-red-300 dark:hover:bg-red-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl bg-primary-600 text-white text-xs md:text-sm font-medium hover:bg-primary-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>