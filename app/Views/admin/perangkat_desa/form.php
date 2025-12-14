<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
<?= esc($pageTitle ?? 'Perangkat Desa') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="w-full max-w-full">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
                <?= esc($pageTitle ?? 'Perangkat Desa') ?>
            </h2>
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Formulir data perangkat desa (tanpa riwayat).
            </p>
        </div>
        <a href="<?= base_url('admin/perangkat-desa') ?>"
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
                Form Data Perangkat Desa
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

            <form action="<?= base_url('admin/perangkat-desa/save') ?>" method="post" class="space-y-4" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($perangkat['id'] ?? '') ?>">
                <input type="hidden" name="foto_file_old" value="<?= esc($perangkat['foto_file'] ?? '') ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <!-- Nama -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="nama">
                            Nama Lengkap
                        </label>
                        <input type="text" name="nama" id="nama"
                            value="<?= esc($perangkat['nama'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Nama lengkap perangkat desa" required>
                    </div>

                    <!-- NIP -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="nip">
                            NIP (opsional)
                        </label>
                        <input type="text" name="nip" id="nip"
                            value="<?= esc($perangkat['nip'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="NIP jika ASN">
                    </div>

                    <!-- NIK -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="nik">
                            NIK (opsional)
                        </label>
                        <input type="text" name="nik" id="nik"
                            value="<?= esc($perangkat['nik'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="NIK (boleh dikosongkan)">
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="jenis_kelamin">
                            Jenis Kelamin
                        </label>
                        <select name="jenis_kelamin" id="jenis_kelamin"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="L" <?= ($perangkat['jenis_kelamin'] ?? '') === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= ($perangkat['jenis_kelamin'] ?? '') === 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="jabatan_id">
                            Jabatan Saat Ini
                        </label>
                        <select name="jabatan_id" id="jabatan_id"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">- Pilih Jabatan -</option>
                            <?php foreach (($jabatanList ?? []) as $j): ?>
                                <option value="<?= $j['id'] ?>" <?= ($perangkat['jabatan_id'] ?? '') == $j['id'] ? 'selected' : '' ?>>
                                    <?= esc($j['nama_jabatan']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Pendidikan terakhir -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="pendidikan_id">
                            Pendidikan Terakhir
                        </label>
                        <select name="pendidikan_id" id="pendidikan_id"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">- Pilih Pendidikan -</option>
                            <?php foreach (($pendidikan ?? []) as $p): ?>
                                <option value="<?= $p['id'] ?>" <?= ($perangkat['pendidikan_id'] ?? '') == $p['id'] ? 'selected' : '' ?>>
                                    <?= esc($p['nama_pendidikan']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- TMT Jabatan -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="tmt_jabatan">
                            TMT Jabatan
                        </label>
                        <input type="date" name="tmt_jabatan" id="tmt_jabatan"
                            value="<?= esc($perangkat['tmt_jabatan'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>

                    <!-- Status aktif -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="status_aktif">
                            Status
                        </label>
                        <select name="status_aktif" id="status_aktif"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="1" <?= (int)($perangkat['status_aktif'] ?? 1) === 1 ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= (int)($perangkat['status_aktif'] ?? 1) === 0 ? 'selected' : '' ?>>Non Aktif</option>
                        </select>
                    </div>
                </div>

                <!-- Kontak dan alamat -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <!-- No HP -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="no_hp">
                            Nomor HP / WA
                        </label>
                        <input type="text" name="no_hp" id="no_hp"
                            value="<?= esc($perangkat['no_hp'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Contoh: 0822xxxxxxx">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="email">
                            Email
                        </label>
                        <input type="email" name="email" id="email"
                            value="<?= esc($perangkat['email'] ?? '') ?>"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Opsional">
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="alamat">
                            Alamat
                        </label>
                        <textarea name="alamat" id="alamat" rows="2"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Alamat domisili"><?= esc($perangkat['alamat'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Foto -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="foto_file">
                            Foto Perangkat (Opsional)
                        </label>
                        <input type="file" name="foto_file" id="foto_file"
                            class="block w-full text-xs text-slate-700 dark:text-slate-100
                                file:mr-2 file:rounded-lg file:border-0
                                file:bg-slate-100 file:px-2.5 file:py-1.5 file:text-xs
                                hover:file:bg-slate-200
                                dark:file:bg-slate-800 dark:hover:file:bg-slate-700">
                        <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                            Format: JPG, PNG, WEBP. Maksimal 5MB (disarankan).
                        </p>

                        <?php if (!empty($perangkat['foto_file'])): ?>
                            <a href="<?= base_url('file/perangkat/' . basename($perangkat['foto_file'])) ?>"
                                target="_blank"
                                class="mt-1 inline-flex items-center gap-1 text-[11px] text-sky-600 hover:underline dark:text-sky-300">
                                <span>Lihat foto saat ini</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="pt-3 mt-2 flex flex-col gap-2 border-t border-slate-100 
                                md:flex-row md:items-center md:justify-end dark:border-slate-800">

                    <a href="<?= base_url('admin/perangkat-desa') ?>"
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