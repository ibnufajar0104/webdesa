<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Detail Penduduk
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
$p = $penduduk ?? [];
?>

<div class="mb-4 flex items-center justify-between">
    <div>
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Detail Penduduk
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Informasi lengkap data penduduk desa.
        </p>
    </div>
    <div class="flex items-center gap-2">
        <a href="<?= base_url('admin/data-penduduk') ?>"
            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 text-xs md:text-sm text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-1 focus:ring-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:hover:bg-slate-800">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor" class="w-3.5 h-3.5">
                <path fill-rule="evenodd"
                    d="M9.53 3.22a.75.75 0 0 1 0 1.06L5.81 8h9.44a.75.75 0 0 1 0 1.5H5.81l3.72 3.72a.75.75 0 0 1-1.06 1.06l-5-5a.75.75 0 0 1 0-1.06l5-5a.75.75 0 0 1 1.06 0Z"
                    clip-rule="evenodd" />
            </svg>
            <span>Kembali</span>
        </a>

        <a href="<?= base_url('admin/data-penduduk/edit/' . $p['id']) ?>"
            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-sky-200 bg-sky-50 text-xs md:text-sm text-sky-700 hover:bg-sky-100 focus:outline-none focus:ring-1 focus:ring-sky-400/70 dark:border-sky-500/40 dark:bg-sky-500/10 dark:text-sky-200 dark:hover:bg-sky-500/20">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-3.5 h-3.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m16.862 4.487 1.687 1.688a1.875 1.875 0 0 1 0 2.652L8.21 19.167A4.5 4.5 0 0 1 6.678 20l-2.135.534A.75.75 0 0 1 4 19.808l.534-2.135a4.5 4.5 0 0 1 1.334-2.531l10.338-10.338a1.875 1.875 0 0 1 2.652 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 4.5 19.5 7.5" />
            </svg>
            <span>Edit</span>
        </a>
    </div>
</div>

<div class="grid gap-4 lg:grid-cols-3">
    <!-- Panel utama -->
    <div class="lg:col-span-2 space-y-4">

        <!-- Identitas Utama -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 dark:bg-slate-900 dark:border-slate-800">
            <div class="flex flex-col gap-2 md:flex-row md:items-start md:justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-100">
                        <?= esc($p['nama_lengkap'] ?? '-') ?>
                    </h3>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400">
                        NIK: <span class="font-mono"><?= esc($p['nik'] ?? '-') ?></span>
                    </p>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400">
                        No. KK: <span class="font-mono"><?= esc($p['no_kk'] ?? '-') ?></span>
                    </p>
                </div>
                <div class="flex flex-wrap gap-1.5 mt-2 md:mt-0 justify-start md:justify-end">
                    <?php if (!empty($p['jenis_kelamin'])): ?>
                        <?php if ($p['jenis_kelamin'] === 'L'): ?>
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/40 dark:text-blue-200 dark:border-blue-700">
                                Laki-laki
                            </span>
                        <?php else: ?>
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-pink-50 text-pink-700 border border-pink-200 dark:bg-pink-900/40 dark:text-pink-200 dark:border-pink-700">
                                Perempuan
                            </span>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if (!empty($p['status_penduduk'])): ?>
                        <?php if ($p['status_penduduk'] === 'Tetap'): ?>
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-900/40 dark:text-emerald-200 dark:border-emerald-700">
                                Tetap
                            </span>
                        <?php else: ?>
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-amber-50 text-amber-700 border border-amber-200 dark:bg-amber-900/40 dark:text-amber-200 dark:border-amber-700">
                                Pendatang
                            </span>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if (!empty($p['status_dasar'])): ?>
                        <?php
                        $sd  = $p['status_dasar'];
                        $map = [
                            'Hidup'     => ['bg' => 'bg-sky-50', 'text' => 'text-sky-700', 'border' => 'border-sky-200', 'darkBg' => 'dark:bg-sky-900/40', 'darkText' => 'dark:text-sky-200', 'darkBorder' => 'dark:border-sky-700'],
                            'Meninggal' => ['bg' => 'bg-rose-50', 'text' => 'text-rose-700', 'border' => 'border-rose-200', 'darkBg' => 'dark:bg-rose-900/40', 'darkText' => 'dark:text-rose-200', 'darkBorder' => 'dark:border-rose-700'],
                            'Pindah'    => ['bg' => 'bg-slate-50', 'text' => 'text-slate-700', 'border' => 'border-slate-200', 'darkBg' => 'dark:bg-slate-800/60', 'darkText' => 'dark:text-slate-200', 'darkBorder' => 'dark:border-slate-700'],
                            'Hilang'    => ['bg' => 'bg-orange-50', 'text' => 'text-orange-700', 'border' => 'border-orange-200', 'darkBg' => 'dark:bg-orange-900/40', 'darkText' => 'dark:text-orange-200', 'darkBorder' => 'dark:border-orange-700'],
                        ];
                        $cfg = $map[$sd] ?? $map['Hidup'];
                        ?>
                        <span class="inline-flex px-2 py-0.5 rounded-full text-[11px] <?= $cfg['bg'] ?> <?= $cfg['text'] ?> border <?= $cfg['border'] ?> <?= $cfg['darkBg'] ?> <?= $cfg['darkText'] ?> <?= $cfg['darkBorder'] ?>">
                            <?= esc($sd) ?>
                        </span>
                    <?php endif; ?>

                    <?php if (!empty($usia)): ?>
                        <span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-slate-50 text-slate-700 border border-slate-200 dark:bg-slate-800/60 dark:text-slate-200 dark:border-slate-700">
                            <?= $usia ?> tahun
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Data pribadi -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 dark:bg-slate-900 dark:border-slate-800">
            <h3 class="text-xs font-semibold text-slate-700 mb-3 dark:text-slate-200">
                Data Pribadi
            </h3>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2 text-[11px] md:text-xs">
                <div>
                    <dt class="text-slate-500 dark:text-slate-400">Nama Lengkap</dt>
                    <dd class="text-slate-800 dark:text-slate-100 font-medium">
                        <?= esc($p['nama_lengkap'] ?? '-') ?>
                    </dd>
                </div>
                <div>
                    <dt class="text-slate-500 dark:text-slate-400">Tempat, Tanggal Lahir</dt>
                    <dd class="text-slate-800 dark:text-slate-100">
                        <?= esc($p['tempat_lahir'] ?? '-') ?><?= !empty($p['tempat_lahir']) && !empty($p['tanggal_lahir']) ? ', ' : '' ?><?= esc($p['tanggal_lahir'] ?? '-') ?>
                    </dd>
                </div>

                <div>
                    <dt class="text-slate-500 dark:text-slate-400">Golongan Darah</dt>
                    <dd class="text-slate-800 dark:text-slate-100">
                        <?= esc($p['golongan_darah'] ?? '-') ?>
                    </dd>
                </div>
                <div>
                    <dt class="text-slate-500 dark:text-slate-400">Agama</dt>
                    <dd class="text-slate-800 dark:text-slate-100">
                        <?= esc($p['nama_agama'] ?? '-') ?>
                    </dd>
                </div>

                <div>
                    <dt class="text-slate-500 dark:text-slate-400">Status Perkawinan</dt>
                    <dd class="text-slate-800 dark:text-slate-100">
                        <?= esc($p['status_perkawinan'] ?? '-') ?>
                    </dd>
                </div>
                <div>
                    <dt class="text-slate-500 dark:text-slate-400">Pendidikan Terakhir</dt>
                    <dd class="text-slate-800 dark:text-slate-100">
                        <?= esc($p['nama_pendidikan'] ?? '-') ?>
                    </dd>
                </div>

                <div>
                    <dt class="text-slate-500 dark:text-slate-400">Pekerjaan</dt>
                    <dd class="text-slate-800 dark:text-slate-100">
                        <?= esc($p['nama_pekerjaan'] ?? '-') ?>
                    </dd>
                </div>
                <div>
                    <dt class="text-slate-500 dark:text-slate-400">Kewarganegaraan</dt>
                    <dd class="text-slate-800 dark:text-slate-100">
                        <?= esc($p['kewarganegaraan'] ?? '-') ?>
                    </dd>
                </div>
            </dl>
        </div>

        <!-- Kontak -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 dark:bg-slate-900 dark:border-slate-800">
            <h3 class="text-xs font-semibold text-slate-700 mb-3 dark:text-slate-200">
                Kontak & Akun
            </h3>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2 text-[11px] md:text-xs">
                <div>
                    <dt class="text-slate-500 dark:text-slate-400">Nomor HP</dt>
                    <dd class="text-slate-800 dark:text-slate-100">
                        <?= esc($p['no_hp'] ?? '-') ?>
                    </dd>
                </div>
                <div>
                    <dt class="text-slate-500 dark:text-slate-400">Email</dt>
                    <dd class="text-slate-800 dark:text-slate-100">
                        <?= esc($p['email'] ?? '-') ?>
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Panel sisi kanan -->
    <div class="space-y-4">
        <!-- Alamat -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 dark:bg-slate-900 dark:border-slate-800">
            <h3 class="text-xs font-semibold text-slate-700 mb-3 dark:text-slate-200">
                Alamat Domisili
            </h3>
            <dl class="space-y-1 text-[11px] md:text-xs">
                <div>
                    <dt class="text-slate-500 dark:text-slate-400">Alamat</dt>
                    <dd class="text-slate-800 dark:text-slate-100">
                        <?= esc($p['alamat'] ?? '-') ?>
                    </dd>
                </div>
                <div>
                    <dt class="text-slate-500 dark:text-slate-400">Dusun</dt>
                    <dd class="text-slate-800 dark:text-slate-100">
                        <?= esc($p['nama_dusun'] ?? '-') ?>
                    </dd>
                </div>
                <div class="flex gap-4">
                    <div>
                        <dt class="text-slate-500 dark:text-slate-400">RW</dt>
                        <dd class="text-slate-800 dark:text-slate-100">
                            <?= isset($p['no_rw']) ? str_pad($p['no_rw'], 3, '0', STR_PAD_LEFT) : '-' ?>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-slate-500 dark:text-slate-400">RT</dt>
                        <dd class="text-slate-800 dark:text-slate-100">
                            <?= isset($p['no_rt']) ? str_pad($p['no_rt'], 3, '0', STR_PAD_LEFT) : '-' ?>
                        </dd>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div>
                        <dt class="text-slate-500 dark:text-slate-400">Desa</dt>
                        <dd class="text-slate-800 dark:text-slate-100">
                            <?= esc($p['desa'] ?? '-') ?>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-slate-500 dark:text-slate-400">Kecamatan</dt>
                        <dd class="text-slate-800 dark:text-slate-100">
                            <?= esc($p['kecamatan'] ?? '-') ?>
                        </dd>
                    </div>
                </div>
            </dl>
        </div>

        <!-- KTP -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 dark:bg-slate-900 dark:border-slate-800">
            <h3 class="text-xs font-semibold text-slate-700 mb-3 dark:text-slate-200">
                Dokumen KTP
            </h3>

            <?php if (!empty($p['ktp_file'])): ?>
                <?php
                // asumsi file disajikan via /uploads/...
                $ktpUrl  = base_url('file/' . $p['ktp_file']);
                $isImage = preg_match('/\.(jpe?g|png|webp|gif)$/i', $p['ktp_file']);
                ?>
                <div class="space-y-2">
                    <a href="<?= $ktpUrl ?>" target="_blank"
                        class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-xl border border-slate-200 text-[11px] text-slate-700 bg-slate-50 hover:bg-slate-100 focus:outline-none focus:ring-1 focus:ring-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:hover:bg-slate-700">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" class="w-3.5 h-3.5">
                            <path d="M4 4a2 2 0 0 1 2-2h5.586A2 2 0 0 1 13 2.586L16.414 6A2 2 0 0 1 17 7.414V16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4Z" />
                            <path d="M8 10.5a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5A.75.75 0 0 1 8 10.5Zm0 2.75a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5A.75.75 0 0 1 8 13.25ZM7 9a.75.75 0 1 0 0-1.5H5.75a.75.75 0 0 0 0 1.5H7Z" />
                        </svg>
                        <span>Lihat / Unduh KTP</span>
                    </a>

                    <?php if ($isImage): ?>
                        <div class="mt-2">
                            <img src="<?= $ktpUrl ?>" alt="Scan KTP"
                                class="max-h-48 rounded-xl border border-slate-100 object-contain dark:border-slate-700">
                        </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p class="text-[11px] text-slate-500 dark:text-slate-400">
                    Belum ada dokumen KTP yang diunggah.
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>