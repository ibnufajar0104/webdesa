<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?><?= esc($pageTitle ?? 'Penerima Bantuan') ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="w-full max-w-full">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100"><?= esc($pageTitle ?? 'Penerima Bantuan') ?></h2>
            <p class="text-xs text-slate-500 dark:text-slate-400">Form data penerima bantuan (relasi penduduk).</p>
        </div>
        <a href="<?= base_url('admin/penerima-bantuan') ?>"
            class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl border border-blue-500 text-blue-600 text-xs md:text-sm hover:bg-blue-50 dark:border-blue-400 dark:text-blue-300 dark:hover:bg-blue-900/30">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">
        <div class="border-b border-slate-100 px-4 py-3 dark:border-slate-800">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Form Penerima Bantuan</h3>
        </div>

        <div class="px-4 py-4 md:px-5 md:py-5 space-y-3">
            <?php if (!empty($errors)): ?>
                <div class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs text-red-700 dark:border-red-500/40 dark:bg-red-500/10 dark:text-red-100">
                    <ul class="list-disc list-inside space-y-0.5">
                        <?php foreach ($errors as $err): ?><li><?= esc($err) ?></li><?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/penerima-bantuan/save') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($row['id'] ?? '') ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <!-- Penduduk -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Penduduk</label>
                        <select id="penduduk_id" name="penduduk_id"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100" required>
                            <?php if (!empty($pendudukSelected)): ?>
                                <option value="<?= (int)$pendudukSelected['id'] ?>" selected><?= esc($pendudukSelected['text']) ?></option>
                            <?php endif; ?>
                        </select>
                        <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">Ketik nama atau NIK untuk mencari.</p>
                    </div>

                    <!-- Bantuan -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Jenis Bantuan</label>
                        <select name="bantuan_id"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100" required>
                            <option value="">- Pilih Bantuan -</option>
                            <?php foreach (($bantuanList ?? []) as $b): ?>
                                <option value="<?= $b['id'] ?>" <?= ((string)($row['bantuan_id'] ?? '') === (string)$b['id']) ? 'selected' : '' ?>>
                                    <?= esc($b['nama_bantuan']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Tahun -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Tahun</label>
                        <input type="number" name="tahun" required
                            value="<?= esc($row['tahun'] ?? date('Y')) ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>

                    <!-- Periode -->
                    <!-- <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Periode (opsional)</label>
                        <input type="text" name="periode" maxlength="30"
                            value="<?= esc($row['periode'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Contoh: Tahap 1 / Jan-Mar">
                    </div> -->

                    <!-- Tanggal Terima -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Tanggal Terima (opsional)</label>
                        <input type="date" name="tanggal_terima"
                            value="<?= esc($row['tanggal_terima'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>

                    <!-- Nominal -->
                    <!-- <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Nominal (opsional)</label>
                        <input type="number" step="0.01" name="nominal"
                            value="<?= esc($row['nominal'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Contoh: 300000">
                    </div> -->

                    <!-- Status -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Status</label>
                        <select name="status"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="1" <?= (int)($row['status'] ?? 1) === 1 ? 'selected' : '' ?>>Diterima</option>
                            <option value="0" <?= (int)($row['status'] ?? 1) === 0 ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>

                    <!-- Keterangan -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Keterangan (opsional)</label>
                        <textarea name="keterangan" rows="3"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Catatan tambahan..."><?= esc($row['keterangan'] ?? '') ?></textarea>
                    </div>
                </div>

                <div class="pt-3 mt-2 flex flex-col gap-2 border-t border-slate-100 md:flex-row md:items-center md:justify-end dark:border-slate-800">
                    <a href="<?= base_url('admin/penerima-bantuan') ?>"
                        class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl border border-red-500 text-red-600 text-xs md:text-sm hover:bg-red-50 dark:border-red-400 dark:text-red-300 dark:hover:bg-red-900/30">
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl bg-primary-600 text-white text-xs md:text-sm font-medium hover:bg-primary-700">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(function() {
        const baseUrl = "<?= rtrim(base_url(), '/') ?>/";

        $('#penduduk_id').select2({
            width: '100%',
            placeholder: 'Cari penduduk (nama / NIK)...',
            allowClear: true,
            ajax: {
                url: baseUrl + 'admin/penerima-bantuan/penduduk-options',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term || ''
                    };
                },
                processResults: function(data) {
                    return data;
                }
            }
        });
    });
</script>

<?= $this->endSection() ?>