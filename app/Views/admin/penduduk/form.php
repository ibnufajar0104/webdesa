<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
<?= esc($pageTitle ?? 'Data Penduduk') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="w-full max-w-full">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
                <?= esc($pageTitle ?? 'Data Penduduk') ?>
            </h2>
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Formulir pendataan penduduk desa.
            </p>
        </div>
        <a href="<?= base_url('admin/data-penduduk') ?>"
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
                Form Data Penduduk
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

            <form action="<?= base_url('admin/data-penduduk/save') ?>" method="post" class="space-y-4" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($penduduk['id'] ?? '') ?>">
                <input type="hidden" name="ktp_file_old" value="<?= esc($penduduk['ktp_file'] ?? '') ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <!-- NIK -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="nik">
                            NIK
                        </label>
                        <input type="text" name="nik" id="nik" maxlength="16"
                            value="<?= esc($penduduk['nik'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="16 digit NIK" required>
                    </div>

                    <!-- No KK -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="no_kk">
                            Nomor KK
                        </label>
                        <input type="text" name="no_kk" id="no_kk" maxlength="16"
                            value="<?= esc($penduduk['no_kk'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Opsional, 16 digit">
                    </div>

                    <!-- Nama -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="nama_lengkap">
                            Nama Lengkap
                        </label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap"
                            value="<?= esc($penduduk['nama_lengkap'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Sesuai KTP" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="jenis_kelamin">
                            Jenis Kelamin
                        </label>
                        <select name="jenis_kelamin" id="jenis_kelamin"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="L" <?= ($penduduk['jenis_kelamin'] ?? '') === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= ($penduduk['jenis_kelamin'] ?? '') === 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>

                    <!-- Tempat Lahir -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="tempat_lahir">
                            Tempat Lahir
                        </label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir"
                            value="<?= esc($penduduk['tempat_lahir'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Contoh: Pelaihari">
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="tanggal_lahir">
                            Tanggal Lahir
                        </label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                            value="<?= esc($penduduk['tanggal_lahir'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            required>
                    </div>

                    <!-- Golongan Darah -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="golongan_darah">
                            Golongan Darah
                        </label>
                        <select name="golongan_darah" id="golongan_darah"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">- Tidak diketahui -</option>
                            <?php
                            $golds = ['A', 'B', 'AB', 'O', '-'];
                            foreach ($golds as $g):
                                $sel = ($penduduk['golongan_darah'] ?? '') === $g ? 'selected' : '';
                            ?>
                                <option value="<?= $g ?>" <?= $sel ?>><?= $g ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <!-- Agama -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="agama_id">
                            Agama
                        </label>
                        <select name="agama_id" id="agama_id"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800
               focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500
               dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">- Pilih Agama -</option>

                            <?php foreach (($agamaList ?? []) as $ag): ?>
                                <?php
                                $selected = ($penduduk['agama_id'] ?? '') == $ag['id'] ? 'selected' : '';
                                ?>
                                <option value="<?= $ag['id'] ?>" <?= $selected ?>>
                                    <?= esc($ag['nama_agama']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <!-- Status Perkawinan -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="status_perkawinan">
                            Status Perkawinan
                        </label>
                        <?php
                        $statusNikahOpts = ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'];
                        ?>
                        <select name="status_perkawinan" id="status_perkawinan"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <?php foreach ($statusNikahOpts as $opt): ?>
                                <option value="<?= $opt ?>" <?= ($penduduk['status_perkawinan'] ?? '') === $opt ? 'selected' : '' ?>>
                                    <?= $opt ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Pendidikan -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="pendidikan_id">
                            Pendidikan Terakhir
                        </label>
                        <select name="pendidikan_id" id="pendidikan_id"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">- Pilih Pendidikan -</option>
                            <?php foreach (($pendidikan ?? []) as $p): ?>
                                <option value="<?= $p['id'] ?>" <?= ($penduduk['pendidikan_id'] ?? '') == $p['id'] ? 'selected' : '' ?>>
                                    <?= esc($p['nama_pendidikan']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Pekerjaan -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="pekerjaan_id">
                            Pekerjaan
                        </label>
                        <select name="pekerjaan_id" id="pekerjaan_id"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">- Pilih Pekerjaan -</option>
                            <?php foreach (($pekerjaan ?? []) as $p): ?>
                                <option value="<?= $p['id'] ?>" <?= ($penduduk['pekerjaan_id'] ?? '') == $p['id'] ? 'selected' : '' ?>>
                                    <?= esc($p['nama_pekerjaan']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Status Penduduk & Dasar -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <!-- Kewarganegaraan -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="kewarganegaraan">
                            Kewarganegaraan
                        </label>
                        <input type="text" name="kewarganegaraan" id="kewarganegaraan"
                            value="<?= esc($penduduk['kewarganegaraan'] ?? 'WNI') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>

                    <!-- Status Penduduk -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="status_penduduk">
                            Status Penduduk
                        </label>
                        <select name="status_penduduk" id="status_penduduk"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="Tetap" <?= ($penduduk['status_penduduk'] ?? '') === 'Tetap' ? 'selected' : '' ?>>Tetap</option>
                            <option value="Pendatang" <?= ($penduduk['status_penduduk'] ?? '') === 'Pendatang' ? 'selected' : '' ?>>Pendatang</option>
                        </select>
                    </div>

                    <!-- Status Dasar -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="status_dasar">
                            Status Dasar
                        </label>
                        <?php $statusDasarOpts = ['Hidup', 'Meninggal', 'Pindah', 'Hilang']; ?>
                        <select name="status_dasar" id="status_dasar"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <?php foreach ($statusDasarOpts as $opt): ?>
                                <option value="<?= $opt ?>" <?= ($penduduk['status_dasar'] ?? '') === $opt ? 'selected' : '' ?>>
                                    <?= $opt ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="alamat">
                            Alamat (Jalan / Kampung)
                        </label>
                        <textarea name="alamat" id="alamat" rows="2"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Nama jalan, gang, lingkungan"><?= esc($penduduk['alamat'] ?? '') ?></textarea>
                    </div>

                    <!-- RT (master) -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="rt_id">
                            Dusun / RW / RT
                        </label>
                        <select name="rt_id" id="rt_id"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">- Pilih Dusun / RW / RT -</option>
                            <?php foreach (($rtOptions ?? []) as $rt): ?>
                                <?php
                                $labelDusun = $rt['nama_dusun'] ?? '-';
                                $rw = str_pad((string)($rt['no_rw'] ?? 0), 3, '0', STR_PAD_LEFT);
                                $rtn = str_pad((string)($rt['no_rt'] ?? 0), 3, '0', STR_PAD_LEFT);
                                $selected = ($penduduk['rt_id'] ?? '') == $rt['id'] ? 'selected' : '';
                                ?>
                                <option value="<?= $rt['id'] ?>" <?= $selected ?>>
                                    <?= esc($labelDusun) ?> - RW <?= $rw ?> / RT <?= $rtn ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Desa -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="desa">
                            Desa
                        </label>
                        <input type="text" name="desa" id="desa"
                            value="<?= esc($penduduk['desa'] ?? 'Batilai') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>

                    <!-- Kecamatan -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="kecamatan">
                            Kecamatan
                        </label>
                        <input type="text" name="kecamatan" id="kecamatan"
                            value="<?= esc($penduduk['kecamatan'] ?? 'Takisung') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>
                </div>

                <!-- Kontak & KTP -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <!-- No HP -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="no_hp">
                            Nomor HP / WA
                        </label>
                        <input type="text" name="no_hp" id="no_hp"
                            value="<?= esc($penduduk['no_hp'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Contoh: 0822xxxxxxx">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="email">
                            Email
                        </label>
                        <input type="email" name="email" id="email"
                            value="<?= esc($penduduk['email'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Opsional">
                    </div>

                    <!-- KTP file -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="ktp_file">
                            Upload KTP (Opsional)
                        </label>
                        <input type="file" name="ktp_file" id="ktp_file"
                            class="block w-full text-xs text-slate-700 dark:text-slate-100
                                file:mr-2 file:rounded-lg file:border-0
                                file:bg-slate-100 file:px-2.5 file:py-1.5 file:text-xs
                                hover:file:bg-slate-200
                                dark:file:bg-slate-800 dark:hover:file:bg-slate-700">
                        <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                            Format: JPG, PNG, WEBP, atau PDF. Maksimal 5MB (disarankan).
                        </p>

                        <?php if (!empty($penduduk['ktp_file'])): ?>
                            <a href="<?= base_url('file/ktp/' . basename($penduduk['ktp_file'])) ?>"
                                target="_blank"
                                class="mt-1 inline-flex items-center gap-1 text-[11px] text-sky-600 hover:underline dark:text-sky-300">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-3.5">
                                    <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V13a2 2 0 0 0 2 2h5.5a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 12.5 4H10V2.5A1.5 1.5 0 0 0 8.5 1h-2Z" />
                                    <path d="M4.25 1.5A.75.75 0 0 0 3.5 2v9.5A1.5 1.5 0 0 0 5 13h5.25a.75.75 0 0 0 0-1.5H5.75a.25.25 0 0 1-.25-.25V2a.75.75 0 0 0-.75-.75Z" />
                                </svg>
                                <span>Lihat KTP saat ini</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="pt-3 mt-2 flex flex-col gap-2 border-t border-slate-100 
                                md:flex-row md:items-center md:justify-end dark:border-slate-800">

                    <a href="<?= base_url('admin/data-penduduk') ?>"
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