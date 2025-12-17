<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?><?= esc($pageTitle ?? 'Identitas RT') ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="w-full max-w-full">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100"><?= esc($pageTitle ?? 'Identitas RT') ?></h2>
            <p class="text-xs text-slate-500 dark:text-slate-400">Form identitas RT (relasi ke Master RT).</p>
        </div>
        <a href="<?= base_url('admin/rt-identitas') ?>"
            class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl border border-blue-500 text-blue-600 text-xs md:text-sm hover:bg-blue-50 dark:border-blue-400 dark:text-blue-300 dark:hover:bg-blue-900/30">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">
        <div class="border-b border-slate-100 px-4 py-3 dark:border-slate-800">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Form Identitas RT</h3>
        </div>

        <div class="px-4 py-4 md:px-5 md:py-5 space-y-3">
            <?php if (!empty($errors)): ?>
                <div class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs text-red-700 dark:border-red-500/40 dark:bg-red-500/10 dark:text-red-100">
                    <ul class="list-disc list-inside space-y-0.5">
                        <?php foreach ($errors as $err): ?><li><?= esc($err) ?></li><?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/rt-identitas/save') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($row['id'] ?? '') ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="rt_id">RT</label>
                        <select name="rt_id" id="rt_id" required
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">- Pilih RT -</option>
                            <?php foreach (($rtList ?? []) as $r): ?>
                                <option value="<?= $r['id'] ?>" <?= (string)($row['rt_id'] ?? '') === (string)$r['id'] ? 'selected' : '' ?>>
                                    RT <?= esc($r['no_rt']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">Satu RT hanya boleh punya satu identitas.</p>
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
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="nama_ketua">Nama Ketua RT</label>
                        <input type="text" name="nama_ketua" id="nama_ketua" required
                            value="<?= esc($row['nama_ketua'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Nama ketua RT">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="nik_ketua">NIK Ketua (opsional)</label>
                        <input type="text" name="nik_ketua" id="nik_ketua"
                            value="<?= esc($row['nik_ketua'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="no_hp_ketua">No HP/WA (opsional)</label>
                        <input type="text" name="no_hp_ketua" id="no_hp_ketua"
                            value="<?= esc($row['no_hp_ketua'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="email_ketua">Email (opsional)</label>
                        <input type="email" name="email_ketua" id="email_ketua"
                            value="<?= esc($row['email_ketua'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="alamat_sekretariat">Alamat Sekretariat (opsional)</label>
                        <textarea name="alamat_sekretariat" id="alamat_sekretariat" rows="2"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"><?= esc($row['alamat_sekretariat'] ?? '') ?></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="sk_nomor">No SK (opsional)</label>
                        <input type="text" name="sk_nomor" id="sk_nomor"
                            value="<?= esc($row['sk_nomor'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="sk_tanggal">Tanggal SK (opsional)</label>
                        <input type="date" name="sk_tanggal" id="sk_tanggal"
                            value="<?= esc($row['sk_tanggal'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="tmt_mulai">TMT Mulai (opsional)</label>
                        <input type="date" name="tmt_mulai" id="tmt_mulai"
                            value="<?= esc($row['tmt_mulai'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="tmt_selesai">TMT Selesai (opsional)</label>
                        <input type="date" name="tmt_selesai" id="tmt_selesai"
                            value="<?= esc($row['tmt_selesai'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="keterangan">Keterangan (opsional)</label>
                        <textarea name="keterangan" id="keterangan" rows="2"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"><?= esc($row['keterangan'] ?? '') ?></textarea>
                    </div>

                </div>

                <div class="pt-3 mt-2 flex flex-col gap-2 border-t border-slate-100 md:flex-row md:items-center md:justify-end dark:border-slate-800">
                    <a href="<?= base_url('admin/rt-identitas') ?>"
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