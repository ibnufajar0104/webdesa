<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Kontak Desa
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="w-full max-w-4xl">
    <div class="mb-4">
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Kontak Desa
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Atur informasi kontak resmi desa yang akan ditampilkan pada website.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-900 dark:border-slate-800">
        <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800">
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Data kontak ini bersifat single entry, cukup diisi satu kali dan dapat diperbarui kapan saja.
            </p>
        </div>

        <form method="post"
            action="<?= base_url('admin/kontak/save') ?>"
            class="px-4 py-4 space-y-4">
            <?= csrf_field() ?>

            <input type="hidden" name="id" value="<?= esc($data['id'] ?? '') ?>">

            <!-- Alamat -->
            <div class="space-y-1.5">
                <label class="text-xs font-medium text-slate-700 dark:text-slate-200">
                    Alamat Kantor Desa <span class="text-rose-500">*</span>
                </label>
                <textarea name="alamat" rows="3"
                    class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                           focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500
                           dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                    placeholder="Tulis alamat lengkap kantor desa..."><?= old('alamat', $data['alamat'] ?? '') ?></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Telepon -->
                <div class="space-y-1.5">
                    <label class="text-xs font-medium text-slate-700 dark:text-slate-200">
                        Telepon Kantor
                    </label>
                    <input type="text" name="telepon"
                        value="<?= old('telepon', $data['telepon'] ?? '') ?>"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500
                               dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                        placeholder="Contoh: 0512-123456">
                </div>

                <!-- WhatsApp -->
                <div class="space-y-1.5">
                    <label class="text-xs font-medium text-slate-700 dark:text-slate-200">
                        WhatsApp Layanan
                    </label>
                    <input type="text" name="whatsapp"
                        value="<?= old('whatsapp', $data['whatsapp'] ?? '') ?>"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500
                               dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                        placeholder="Contoh: 6281234567890">
                    <p class="text-[11px] text-slate-400 dark:text-slate-500">
                        Gunakan format internasional tanpa spasi, contoh: 628xxxxxxxxxx.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Email -->
                <div class="space-y-1.5">
                    <label class="text-xs font-medium text-slate-700 dark:text-slate-200">
                        Email Resmi
                    </label>
                    <input type="email" name="email"
                        value="<?= old('email', $data['email'] ?? '') ?>"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500
                               dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                        placeholder="Contoh: desabatilai@example.com">
                </div>

                <!-- Website -->
                <div class="space-y-1.5">
                    <label class="text-xs font-medium text-slate-700 dark:text-slate-200">
                        Website Desa
                    </label>
                    <input type="text" name="website"
                        value="<?= old('website', $data['website'] ?? '') ?>"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500
                               dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                        placeholder="Contoh: https://desabatilai.go.id">
                </div>
            </div>

            <!-- Link Maps -->
            <div class="space-y-1.5">
                <label class="text-xs font-medium text-slate-700 dark:text-slate-200">
                    Link Google Maps
                </label>
                <textarea name="link_maps" rows="2"
                    class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                           focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500
                           dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                    placeholder="Tempelkan URL Google Maps lokasi kantor desa di sini..."><?= old('link_maps', $data['link_maps'] ?? '') ?></textarea>
                <p class="text-[11px] text-slate-400 dark:text-slate-500">
                    Anda dapat menggunakan URL berbagi lokasi dari Google Maps.
                </p>
            </div>

            <!-- Status -->
            <div class="space-y-1.5">
                <label class="text-xs font-medium text-slate-700 dark:text-slate-200">
                    Status Tampil
                </label>
                <?php $cur = old('is_active', $data['is_active'] ?? 1); ?>
                <select name="is_active"
                    class="w-full sm:w-52 rounded-xl border border-slate-200 px-3 py-2 text-sm
                           focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500
                           dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                    <option value="1" <?= $cur == 1 ? 'selected' : '' ?>>Tampilkan di website</option>
                    <option value="0" <?= $cur == 0 ? 'selected' : '' ?>>Sembunyikan</option>
                </select>
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
                    Simpan Kontak
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>