<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Sambutan Kepala Desa
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="w-full max-w-4xl">
    <div class="mb-4">
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Sambutan Kepala Desa
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Kelola teks sambutan dan foto Kepala Desa yang akan ditampilkan pada halaman profil desa.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-900 dark:border-slate-800">
        <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800">
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Isi sambutan dan foto Kepala Desa akan muncul sebagai pengantar di halaman depan/profil desa.
            </p>
        </div>

        <form method="post"
            action="<?= base_url('admin/sambutan-kades/save') ?>"
            enctype="multipart/form-data"
            class="px-4 py-4 space-y-4">
            <?= csrf_field() ?>

            <input type="hidden" name="id" value="<?= esc($data['id'] ?? '') ?>">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Kolom teks -->
                <div class="space-y-4 md:col-span-2">
                    <!-- Judul sambutan -->
                    <div class="space-y-1.5">
                        <label for="judul"
                            class="text-xs font-medium text-slate-700 dark:text-slate-200">
                            Judul Sambutan <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="judul" id="judul"
                            value="<?= old('judul', $data['judul'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500
                                   dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                            placeholder="Contoh: Sambutan Kepala Desa Batilai">
                    </div>

                    <!-- Isi sambutan -->
                    <div class="space-y-1.5">
                        <label for="isi"
                            class="text-xs font-medium text-slate-700 dark:text-slate-200">
                            Isi Sambutan <span class="text-rose-500">*</span>
                        </label>
                        <textarea name="isi" id="isi" rows="8"
                            class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500
                                   dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                            placeholder="Tulis sambutan Kepala Desa di sini..."><?= old('isi', $data['isi'] ?? '') ?></textarea>
                        <p class="text-[11px] text-slate-400 dark:text-slate-500">
                            Anda dapat menyesuaikan isi sambutan sewaktu-waktu. Jika menggunakan editor WYSIWYG, arahkan ke textarea ini.
                        </p>
                    </div>

                    <!-- Status tampil -->
                    <div class="space-y-1.5">
                        <label for="is_active"
                            class="text-xs font-medium text-slate-700 dark:text-slate-200">
                            Status Tampil
                        </label>
                        <?php $currentStatus = old('is_active', $data['is_active'] ?? 1); ?>
                        <select name="is_active" id="is_active"
                            class="w-full sm:w-60 rounded-xl border border-slate-200 px-3 py-2 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500
                                   dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                            <option value="1" <?= $currentStatus == 1 ? 'selected' : '' ?>>Tampilkan di website</option>
                            <option value="0" <?= $currentStatus == 0 ? 'selected' : '' ?>>Sembunyikan</option>
                        </select>
                    </div>
                </div>

                <!-- Kolom foto -->
                <div class="space-y-3">
                    <div class="space-y-1.5">
                        <label for="foto_kades"
                            class="text-xs font-medium text-slate-700 dark:text-slate-200">
                            Foto Kepala Desa
                        </label>

                        <?php if (!empty($data['foto_kades'])): ?>
                            <div class="mb-2">
                                <p class="text-[11px] text-slate-400 dark:text-slate-500 mb-1">
                                    Foto saat ini:
                                </p>
                                <div class="w-32 h-32 rounded-2xl border border-slate-200 overflow-hidden bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                                    <img src="<?= base_url('file/pages/' . $data['foto_kades']) ?>"
                                        alt="Foto Kepala Desa"
                                        class="w-full h-full object-cover">
                                </div>
                            </div>
                        <?php endif; ?>

                        <input type="file" name="foto_kades" id="foto_kades"
                            accept="image/*"
                            class="block w-full text-xs text-slate-600 file:mr-3 file:px-3 file:py-1.5 file:rounded-xl
                                   file:border-0 file:text-xs file:font-medium file:bg-primary-50 file:text-primary-700
                                   hover:file:bg-primary-100
                                   dark:text-slate-300 dark:file:bg-primary-900/40 dark:file:text-primary-100">
                        <p class="text-[11px] text-slate-400 dark:text-slate-500">
                            Format: JPG, JPEG, PNG, WEBP. Maksimal 3 MB. Disarankan foto berdiri dengan latar netral.
                        </p>
                    </div>
                </div>
            </div>

            <div class="pt-2 flex items-center justify-end gap-2">
                <a href="<?= base_url('admin/dashboard') ?>"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border
                           border-rose-500 text-rose-600 text-xs md:text-sm
                           bg-white hover:bg-rose-50
                           dark:bg-slate-900 dark:border-rose-400 dark:text-rose-300 dark:hover:bg-rose-500/10">
                    Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border
                           border-primary-500 text-primary-600 text-xs md:text-sm
                           bg-white hover:bg-primary-50
                           dark:bg-slate-900 dark:border-primary-400 dark:text-primary-200 dark:hover:bg-primary-500/10">
                    Simpan Sambutan
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>