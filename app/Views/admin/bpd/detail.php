<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Detail Anggota BPD
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
$p = $perangkat ?? [];
?>

<div class="mb-4 flex items-center justify-between">
    <div>
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Detail Anggota BPD
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Informasi lengkap anggota BPD beserta riwayat pendidikan dan jabatan.
        </p>
    </div>
    <div class="flex items-center gap-2">
        <a href="<?= base_url('admin/bpd') ?>"
            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 text-xs md:text-sm text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-1 focus:ring-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:hover:bg-slate-800">
            <span>Kembali</span>
        </a>

        <a href="<?= base_url('admin/bpd/edit/' . $p['id']) ?>"
            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-sky-200 bg-sky-50 text-xs md:text-sm text-sky-700 hover:bg-sky-100 focus:outline-none focus:ring-1 focus:ring-sky-400/70 dark:border-sky-500/40 dark:bg-sky-500/10 dark:text-sky-200 dark:hover:bg-sky-500/20">
            <span>Edit Data Utama</span>
        </a>
    </div>
</div>

<div class="grid gap-4 lg:grid-cols-3">
    <!-- Panel utama -->
    <div class="lg:col-span-1 space-y-4">
        <!-- Identitas Utama -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 dark:bg-slate-900 dark:border-slate-800">
            <div class="flex items-start gap-3">
                <div class="w-14 h-14 rounded-2xl bg-primary-100 text-primary-700 flex items-center justify-center text-sm font-semibold overflow-hidden dark:bg-primary-900/40 dark:text-primary-100">
                    <?php if (!empty($p['foto_file'])): ?>
                        <img src="<?= base_url('file/perangkat/' . basename($p['foto_file'])) ?>" alt="Foto"
                            class="w-full h-full object-cover">
                    <?php else: ?>
                        <?= strtoupper(substr((string)($p['nama'] ?? 'PD'), 0, 2)) ?>
                    <?php endif; ?>
                </div>
                <div class="flex-1">
                    <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-100">
                        <?= esc($p['nama'] ?? '-') ?>
                    </h3>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400">
                        <?= esc($p['nama_jabatan'] ?? '-') ?>
                    </p>

                    <dl class="mt-2 space-y-1 text-[11px]">
                        <div>
                            <dt class="inline text-slate-500 dark:text-slate-400">NIP:</dt>
                            <dd class="inline font-mono text-slate-800 dark:text-slate-100">
                                <?= esc($p['nip'] ?? '-') ?>
                            </dd>
                        </div>
                        <div>
                            <dt class="inline text-slate-500 dark:text-slate-400">NIK:</dt>
                            <dd class="inline font-mono text-slate-800 dark:text-slate-100">
                                <?= esc($p['nik'] ?? '-') ?>
                            </dd>
                        </div>
                        <div>
                            <dt class="inline text-slate-500 dark:text-slate-400">Pendidikan:</dt>
                            <dd class="inline text-slate-800 dark:text-slate-100">
                                <?= esc($p['nama_pendidikan'] ?? '-') ?>
                            </dd>
                        </div>
                    </dl>

                    <div class="mt-2 flex flex-wrap gap-1.5">
                        <?php
                        if (!empty($p['jenis_kelamin'])) {
                            if ($p['jenis_kelamin'] === 'L') {
                                echo '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/40 dark:text-blue-200 dark:border-blue-700">Laki-laki</span>';
                            } else {
                                echo '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-pink-50 text-pink-700 border border-pink-200 dark:bg-pink-900/40 dark:text-pink-200 dark:border-pink-700">Perempuan</span>';
                            }
                        }

                        if ((int)($p['status_aktif'] ?? 1) === 1) {
                            echo '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-900/40 dark:text-emerald-200 dark:border-emerald-700">Aktif</span>';
                        } else {
                            echo '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-slate-50 text-slate-700 border border-slate-200 dark:bg-slate-800/60 dark:text-slate-200 dark:border-slate-700">Non Aktif</span>';
                        }

                        if (!empty($p['tmt_jabatan'])) {
                            echo '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-sky-50 text-sky-700 border border-sky-200 dark:bg-sky-900/40 dark:text-sky-200 dark:border-sky-700">TMT ' . esc($p['tmt_jabatan']) . '</span>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kontak -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 dark:bg-slate-900 dark:border-slate-800">
            <h3 class="text-xs font-semibold text-slate-700 mb-3 dark:text-slate-200">
                Kontak
            </h3>
            <dl class="space-y-1 text-[11px] md:text-xs">
                <div>
                    <dt class="text-slate-500 dark:text-slate-400">Nomor HP / WA</dt>
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
                <div>
                    <dt class="text-slate-500 dark:text-slate-400">Alamat</dt>
                    <dd class="text-slate-800 dark:text-slate-100">
                        <?= esc($p['alamat'] ?? '-') ?>
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Panel Riwayat -->
    <div class="lg:col-span-2 space-y-4">
        <!-- Riwayat Pendidikan -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 dark:bg-slate-900 dark:border-slate-800">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-xs font-semibold text-slate-700 dark:text-slate-200">
                    Riwayat Pendidikan
                </h3>
            </div>

            <div class="overflow-x-auto mb-3">
                <table class="min-w-full text-[11px] md:text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-600 border-b border-slate-100 dark:bg-slate-900/60 dark:text-slate-200 dark:border-slate-800">
                            <th class="px-2 py-1.5 text-left font-medium">Pendidikan</th>
                            <th class="px-2 py-1.5 text-left font-medium">Lembaga / Jurusan</th>
                            <th class="px-2 py-1.5 text-left font-medium whitespace-nowrap">Tahun</th>
                            <th class="px-2 py-1.5 text-left font-medium">Ijazah</th>
                            <th class="px-2 py-1.5 text-left font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <?php if (!empty($pendidikanHist)): ?>
                            <?php foreach ($pendidikanHist as $h): ?>
                                <tr>
                                    <td class="px-2 py-1.5">
                                        <?= esc($h['nama_pendidikan'] ?? '-') ?>
                                    </td>
                                    <td class="px-2 py-1.5">
                                        <div class="flex flex-col">
                                            <span class="text-slate-800 dark:text-slate-100"><?= esc($h['nama_lembaga'] ?? '-') ?></span>
                                            <span class="text-[11px] text-slate-500 dark:text-slate-400"><?= esc($h['jurusan'] ?? '-') ?></span>
                                        </div>
                                    </td>
                                    <td class="px-2 py-1.5 whitespace-nowrap">
                                        <?php
                                        $tm = $h['tahun_masuk'] ?? null;
                                        $tl = $h['tahun_lulus'] ?? null;
                                        if ($tm || $tl) {
                                            echo esc($tm ?: '?') . ' - ' . esc($tl ?: '?');
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td class="px-2 py-1.5">
                                        <?php if (!empty($h['ijazah_file'])): ?>
                                            <a href="<?= base_url('file/ijazah/' . basename($h['ijazah_file'])) ?>"
                                                class="text-[11px] text-sky-600 hover:underline dark:text-sky-300"
                                                target="_blank">
                                                Lihat Ijazah
                                            </a>
                                        <?php else: ?>
                                            <span class="text-slate-400 text-[11px]">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-2 py-1.5 whitespace-nowrap">
                                        <form action="<?= base_url('admin/bpd/pendidikan/delete') ?>" method="post" class="inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= esc($h['id']) ?>">
                                            <input type="hidden" name="perangkat_id" value="<?= esc($p['id']) ?>">
                                            <button type="submit"
                                                class="inline-flex items-center px-2 py-1 rounded-full border border-rose-200 bg-rose-50 text-[11px] text-rose-700 hover:bg-rose-100 dark:border-rose-500/40 dark:bg-rose-500/10 dark:text-rose-200 dark:hover:bg-rose-500/20"
                                                onclick="return confirm('Hapus riwayat pendidikan ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-2 py-2 text-center text-slate-400 dark:text-slate-500">
                                    Belum ada riwayat pendidikan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Form tambah / edit riwayat pendidikan -->
            <div class="mt-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                <h4 class="text-[11px] font-semibold text-slate-600 mb-2 dark:text-slate-300">
                    Tambah / Edit Riwayat Pendidikan
                </h4>
                <form action="<?= base_url('admin/bpd/pendidikan/save') ?>" method="post" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-5 gap-2 text-[11px]">
                    <?= csrf_field() ?>
                    <input type="hidden" name="perangkat_id" value="<?= esc($p['id']) ?>">
                    <input type="hidden" name="id" value=""> <!-- untuk edit jika mau dikembangkan -->
                    <input type="hidden" name="ijazah_file_old" value="">

                    <div>
                        <label class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                            Pendidikan
                        </label>
                        <select name="pendidikan_id"
                            class="w-full rounded-xl border border-slate-200 bg-white px-2 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">- Pilih -</option>
                            <?php foreach (($pendidikanMaster ?? []) as $pd): ?>
                                <option value="<?= $pd['id'] ?>"><?= esc($pd['nama_pendidikan']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                            Lembaga
                        </label>
                        <input type="text" name="nama_lembaga"
                            class="w-full rounded-xl border border-slate-200 bg-white px-2 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Nama sekolah / kampus">
                    </div>

                    <div>
                        <label class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                            Jurusan
                        </label>
                        <input type="text" name="jurusan"
                            class="w-full rounded-xl border border-slate-200 bg-white px-2 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Opsional">
                    </div>

                    <div class="flex gap-1">
                        <div class="w-1/2">
                            <label class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                                Th. Masuk
                            </label>
                            <input type="number" name="tahun_masuk" min="1950" max="2100"
                                class="w-full rounded-xl border border-slate-200 bg-white px-2 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        </div>
                        <div class="w-1/2">
                            <label class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                                Th. Lulus
                            </label>
                            <input type="number" name="tahun_lulus" min="1950" max="2100"
                                class="w-full rounded-xl border border-slate-200 bg-white px-2 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                            Ijazah (opsional)
                        </label>
                        <input type="file" name="ijazah_file"
                            class="block w-full text-[11px] text-slate-700 dark:text-slate-100
                                file:mr-1 file:rounded-lg file:border-0
                                file:bg-slate-100 file:px-2 file:py-1
                                hover:file:bg-slate-200
                                dark:file:bg-slate-800 dark:hover:file:bg-slate-700">
                        <button type="submit"
                            class="mt-1 inline-flex items-center justify-center px-3 py-1.5 rounded-xl bg-primary-600 text-white text-[11px] font-medium hover:bg-primary-700">
                            Simpan Riwayat
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Riwayat Jabatan -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 dark:bg-slate-900 dark:border-slate-800">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-xs font-semibold text-slate-700 dark:text-slate-200">
                    Riwayat Jabatan
                </h3>
            </div>

            <div class="overflow-x-auto mb-3">
                <table class="min-w-full text-[11px] md:text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-600 border-b border-slate-100 dark:bg-slate-900/60 dark:text-slate-200 dark:border-slate-800">
                            <th class="px-2 py-1.5 text-left font-medium">Jabatan</th>
                            <th class="px-2 py-1.5 text-left font-medium">Unit</th>
                            <th class="px-2 py-1.5 text-left font-medium whitespace-nowrap">TMT</th>
                            <th class="px-2 py-1.5 text-left font-medium">SK</th>
                            <th class="px-2 py-1.5 text-left font-medium">Keterangan</th>
                            <th class="px-2 py-1.5 text-left font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <?php if (!empty($jabatanHist)): ?>
                            <?php foreach ($jabatanHist as $h): ?>
                                <tr>
                                    <td class="px-2 py-1.5">
                                        <?= esc($h['nama_jabatan'] ?? '-') ?>
                                    </td>
                                    <td class="px-2 py-1.5">
                                        <?= esc($h['nama_unit'] ?? '-') ?>
                                    </td>
                                    <td class="px-2 py-1.5 whitespace-nowrap">
                                        <?php
                                        $tm = $h['tmt_mulai'] ?? null;
                                        $ts = $h['tmt_selesai'] ?? null;
                                        if ($tm || $ts) {
                                            echo esc($tm ?: '?') . ' s.d ' . esc($ts ?: 'sekarang');
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td class="px-2 py-1.5">
                                        <?php if (!empty($h['sk_file'])): ?>
                                            <a href="<?= base_url('file/sk/' . basename($h['sk_file'])) ?>"
                                                class="text-[11px] text-sky-600 hover:underline dark:text-sky-300"
                                                target="_blank">
                                                Lihat SK
                                            </a>
                                        <?php else: ?>
                                            <span class="text-slate-400 text-[11px]">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-2 py-1.5">
                                        <?= esc($h['keterangan'] ?? '-') ?>
                                    </td>
                                    <td class="px-2 py-1.5 whitespace-nowrap">
                                        <form action="<?= base_url('admin/bpd/jabatan/delete') ?>" method="post" class="inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= esc($h['id']) ?>">
                                            <input type="hidden" name="perangkat_id" value="<?= esc($p['id']) ?>">
                                            <button type="submit"
                                                class="inline-flex items-center px-2 py-1 rounded-full border border-rose-200 bg-rose-50 text-[11px] text-rose-700 hover:bg-rose-100 dark:border-rose-500/40 dark:bg-rose-500/10 dark:text-rose-200 dark:hover:bg-rose-500/20"
                                                onclick="return confirm('Hapus riwayat jabatan ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-2 py-2 text-center text-slate-400 dark:text-slate-500">
                                    Belum ada riwayat jabatan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Form tambah / edit riwayat jabatan -->
            <div class="mt-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                <h4 class="text-[11px] font-semibold text-slate-600 mb-2 dark:text-slate-300">
                    Tambah / Edit Riwayat Jabatan
                </h4>
                <form action="<?= base_url('admin/bpd/jabatan/save') ?>" method="post" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-6 gap-2 text-[11px]">
                    <?= csrf_field() ?>
                    <input type="hidden" name="perangkat_id" value="<?= esc($p['id']) ?>">
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="sk_file_old" value="">

                    <div>
                        <label class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                            Jabatan
                        </label>
                        <select name="jabatan_id"
                            class="w-full rounded-xl border border-slate-200 bg-white px-2 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">- Pilih -</option>
                            <?php foreach (($jabatanList ?? []) as $jb): ?>
                                <option value="<?= $jb['id'] ?>"><?= esc($jb['nama_jabatan']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                            Unit Kerja
                        </label>
                        <input type="text" name="nama_unit"
                            class="w-full rounded-xl border border-slate-200 bg-white px-2 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Misal: Pemerintah Desa Batilai">
                    </div>

                    <div>
                        <label class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                            No. SK
                        </label>
                        <input type="text" name="sk_nomor"
                            class="w-full rounded-xl border border-slate-200 bg-white px-2 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                            placeholder="Nomor SK">
                    </div>

                    <div class="flex gap-1">
                        <div class="w-1/2">
                            <label class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                                Tgl SK
                            </label>
                            <input type="date" name="sk_tanggal"
                                class="w-full rounded-xl border border-slate-200 bg-white px-2 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        </div>
                        <div class="w-1/2">
                            <label class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                                TMT Mulai
                            </label>
                            <input type="date" name="tmt_mulai"
                                class="w-full rounded-xl border border-slate-200 bg-white px-2 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        </div>
                    </div>

                    <div class="flex gap-1">
                        <div class="w-1/2">
                            <label class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                                TMT Selesai
                            </label>
                            <input type="date" name="tmt_selesai"
                                class="w-full rounded-xl border border-slate-200 bg-white px-2 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        </div>
                        <div class="w-1/2">
                            <label class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                                Keterangan
                            </label>
                            <input type="text" name="keterangan"
                                class="w-full rounded-xl border border-slate-200 bg-white px-2 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                                placeholder="Opsional">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                            File SK (opsional)
                        </label>
                        <input type="file" name="sk_file"
                            class="block w-full text-[11px] text-slate-700 dark:text-slate-100
                                file:mr-1 file:rounded-lg file:border-0
                                file:bg-slate-100 file:px-2 file:py-1
                                hover:file:bg-slate-200
                                dark:file:bg-slate-800 dark:hover:file:bg-slate-700">
                        <button type="submit"
                            class="mt-1 inline-flex items-center justify-center px-3 py-1.5 rounded-xl bg-primary-600 text-white text-[11px] font-medium hover:bg-primary-700">
                            Simpan Riwayat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>