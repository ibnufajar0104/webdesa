<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Jam Pelayanan
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="w-full max-w-3xl">
    <div class="mb-4">
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Jam Pelayanan
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Atur jadwal pelayanan kantor desa yang akan ditampilkan pada halaman website.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-900 dark:border-slate-800">
        <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800">
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Data jam pelayanan ini bersifat single entry, cukup diisi satu kali dan dapat diperbarui kapan saja.
            </p>
        </div>

        <form method="post" action="<?= base_url('admin/jam-pelayanan/save') ?>" class="px-4 py-4 space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= esc($data['id'] ?? '') ?>">

            <div class="space-y-1.5">
                <label class="text-xs font-medium">Hari Pelayanan <span class="text-rose-500">*</span></label>
                <input type="text" name="hari"
                    value="<?= old('hari', $data['hari'] ?? '') ?>"
                    class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                           focus:outline-none focus:ring-2 focus:ring-primary-500/60
                           dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                    placeholder="Contoh: Senin - Jumat">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-xs font-medium">Jam Mulai</label>
                    <input type="text" name="jam_mulai"
                        value="<?= old('jam_mulai', $data['jam_mulai'] ?? '') ?>"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                               dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                        placeholder="08:00 WITA">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-medium">Jam Selesai</label>
                    <input type="text" name="jam_selesai"
                        value="<?= old('jam_selesai', $data['jam_selesai'] ?? '') ?>"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                               dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                        placeholder="15:00 WITA">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-medium">Keterangan (Opsional)</label>
                <textarea name="keterangan" rows="3"
                    class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                           dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                    placeholder="Contoh: Istirahat pukul 12:00 - 13:00 WITA"><?= old('keterangan', $data['keterangan'] ?? '') ?></textarea>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-medium">Status Tampil</label>
                <?php $cur = old('is_active', $data['is_active'] ?? 1); ?>
                <select name="is_active"
                    class="w-full sm:w-52 rounded-xl border border-slate-200 px-3 py-2 text-sm
                           dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                    <option value="1" <?= $cur == 1 ? 'selected' : '' ?>>Tampilkan</option>
                    <option value="0" <?= $cur == 0 ? 'selected' : '' ?>>Sembunyikan</option>
                </select>
            </div>

            <div class="pt-2 flex items-center justify-end gap-2">
                <a href="<?= base_url('admin/dashboard') ?>"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-rose-500 text-rose-600 text-xs md:text-sm
                           bg-white hover:bg-rose-50 dark:bg-slate-900 dark:border-rose-400 dark:text-rose-300">
                    Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-primary-500 text-primary-600 text-xs md:text-sm
                           bg-white hover:bg-primary-50 dark:bg-slate-900 dark:border-primary-400 dark:text-primary-200">
                    Simpan Jam Pelayanan
                </button>
            </div>

        </form>
    </div>
</div>

<?= $this->endSection() ?>