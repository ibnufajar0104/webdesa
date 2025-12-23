<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
<?= esc($pageTitle ?? 'Dokumen') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="w-full max-w-full">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
                <?= esc($pageTitle ?? 'Dokumen') ?>
            </h2>
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Kelola dokumen publik untuk ditampilkan di website desa.
            </p>
        </div>

        <a href="<?= base_url('admin/dokumen') ?>"
            class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl border border-blue-500 text-blue-600 text-xs md:text-sm
                   hover:bg-blue-50 active:bg-blue-100 dark:border-blue-400 dark:text-blue-300 dark:hover:bg-blue-900/30">
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
                Form Dokumen
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

            <form action="<?= base_url('admin/dokumen/save') ?>" method="post" class="space-y-3" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($row['id'] ?? '') ?>">

                <div class="grid gap-3 md:grid-cols-2">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">
                            Kategori
                        </label>
                        <select name="kategori_id"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach (($kategori ?? []) as $k): ?>
                                <option value="<?= esc($k['id']) ?>" <?= (string)($row['kategori_id'] ?? '') === (string)$k['id'] ? 'selected' : '' ?>>
                                    <?= esc($k['nama']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">
                            Status
                        </label>
                        <select name="is_active"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="1" <?= (string)($row['is_active'] ?? '1') === '1' ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= (string)($row['is_active'] ?? '1') === '0' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">
                        Judul Dokumen
                    </label>
                    <input type="text" name="judul" value="<?= esc($row['judul'] ?? '') ?>"
                        class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                        placeholder="Misal: APBDes Tahun 2025" required>
                </div>

                <div class="grid gap-3 md:grid-cols-3">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Nomor (opsional)</label>
                        <input type="text" name="nomor" value="<?= esc($row['nomor'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Misal: 03/2025">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Tahun (opsional)</label>
                        <input type="number" name="tahun" value="<?= esc($row['tahun'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="2025">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Tanggal (opsional)</label>
                        <input type="date" name="tanggal" value="<?= esc($row['tanggal'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">
                        Ringkasan (opsional)
                    </label>
                    <textarea name="ringkasan" rows="4"
                        class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                        placeholder="Ringkasan dokumen..."><?= esc($row['ringkasan'] ?? '') ?></textarea>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-200">
                        File Dokumen <?= !empty($row['id']) ? '(opsional saat edit)' : '(wajib)' ?>
                    </label>

                    <?php if (!empty($row['file_path'])): ?>
                        <div class="text-xs">
                            <a class="underline text-sky-600 dark:text-sky-300" target="_blank"
                                href="<?= base_url('file/dokumen/' . $row['file_path']) ?>">
                                Lihat file saat ini
                            </a>
                            <div class="text-[11px] text-slate-500 dark:text-slate-400">
                                <?= esc($row['file_name'] ?? '') ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <input type="file" name="dokumen_file"
                        class="block w-full text-xs text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-100 file:px-3 file:py-1.5 file:text-xs file:font-medium file:text-slate-700 hover:file:bg-slate-200 dark:text-slate-300 dark:file:bg-slate-800 dark:file:text-slate-100 dark:hover:file:bg-slate-700">

                    <p class="text-[11px] text-slate-500 dark:text-slate-400">
                        Format: PDF/DOC/DOCX/XLS/XLSX/PPT/PPTX/JPG/PNG • Maks 15MB
                    </p>
                </div>

                <div class="pt-3 mt-2 flex flex-col gap-2 border-t border-slate-100 md:flex-row md:items-center md:justify-end dark:border-slate-800">
                    <a href="<?= base_url('admin/dokumen') ?>"
                        class="inline-flex h-9 items-center px-3 rounded-xl border border-red-500 text-red-600 text-xs md:text-sm
                               hover:bg-red-50 active:bg-red-100 dark:border-red-400 dark:text-red-300 dark:hover:bg-red-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex h-9 items-center px-3 rounded-xl bg-primary-600 text-white text-xs md:text-sm font-medium hover:bg-primary-700">
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