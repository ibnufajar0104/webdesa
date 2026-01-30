<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Demografi Desa
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="w-full max-w-4xl">
    <div class="mb-4">
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Demografi Desa
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Kelola data demografi dasar desa seperti jarak ke pusat pemerintahan, luas wilayah, dan kepadatan penduduk.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-900 dark:border-slate-800">
        <form method="post" action="<?= base_url('admin/demografi/save') ?>" class="px-4 py-4 space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= esc($data['id'] ?? '') ?>">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Jarak ke Kabupaten -->
                <div class="space-y-1.5">
                    <label for="jarak_ke_kabupaten" class="text-xs font-medium text-slate-700 dark:text-slate-200">
                        Jarak ke Kabupaten (km) <span class="text-rose-500">*</span>
                    </label>
                    <input type="number" step="0.01" name="jarak_ke_kabupaten" id="jarak_ke_kabupaten"
                        value="<?= old('jarak_ke_kabupaten', $data['jarak_ke_kabupaten'] ?? '') ?>"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                        placeholder="0.00">
                </div>

                <!-- Luas Wilayah -->
                <div class="space-y-1.5">
                    <label for="luas_wilayah" class="text-xs font-medium text-slate-700 dark:text-slate-200">
                        Luas Wilayah (Ha) <span class="text-rose-500">*</span>
                    </label>
                    <input type="number" step="0.01" name="luas_wilayah" id="luas_wilayah"
                        value="<?= old('luas_wilayah', $data['luas_wilayah'] ?? '') ?>"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                        placeholder="0.00">
                </div>

                <!-- Kepadatan Penduduk -->
                <div class="space-y-1.5">
                    <label for="kepadatan" class="text-xs font-medium text-slate-700 dark:text-slate-200">
                        Kepadatan (jiwa/km²) <span class="text-rose-500">*</span>
                    </label>
                    <input type="number" step="0.01" name="kepadatan" id="kepadatan"
                        value="<?= old('kepadatan', $data['kepadatan'] ?? '') ?>"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                        placeholder="0.00">
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl border border-primary-500 text-primary-600 text-sm bg-white hover:bg-primary-50 dark:bg-slate-900 dark:border-primary-400 dark:text-primary-200 dark:hover:bg-primary-500/10">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
