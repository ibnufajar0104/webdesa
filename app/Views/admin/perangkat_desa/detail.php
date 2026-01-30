<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Detail Perangkat Desa
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
$p = $perangkat ?? [];
?>

<div class="mb-4 flex items-center justify-between">
    <div>
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Detail Perangkat Desa
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Informasi lengkap perangkat desa beserta riwayat pendidikan dan jabatan.
        </p>
    </div>
    <div class="flex items-center gap-2">
        <a href="<?= base_url('admin/perangkat-desa') ?>"
            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 text-xs md:text-sm text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-1 focus:ring-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:hover:bg-slate-800">
            <span>Kembali</span>
        </a>

        <a href="<?= base_url('admin/perangkat-desa/edit/' . $p['id']) ?>"
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
                <button type="button" onclick="openModalPendidikan()"
                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-primary-50 text-primary-700 text-[11px] font-medium hover:bg-primary-100 dark:bg-primary-900/30 dark:text-primary-300 dark:hover:bg-primary-900/50">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    Tambah
                </button>
            </div>

            <div class="overflow-x-auto mb-3">
                <table id="tablePendidikan" class="min-w-full text-[11px] md:text-xs">
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
                                        <div class="flex items-center gap-1">
                                            <button type="button"
                                                class="inline-flex items-center px-2 py-1 rounded-full border border-sky-200 bg-sky-50 text-[11px] text-sky-700 hover:bg-sky-100 dark:border-sky-500/40 dark:bg-sky-500/10 dark:text-sky-200 dark:hover:bg-sky-500/20"
                                                onclick='openModalPendidikan(<?= json_encode($h) ?>)'>
                                                Edit
                                            </button>
                                            <button type="button"
                                                class="btnDeletePendidikan inline-flex items-center px-2 py-1 rounded-full border border-rose-200 bg-rose-50 text-[11px] text-rose-700 hover:bg-rose-100 dark:border-rose-500/40 dark:bg-rose-500/10 dark:text-rose-200 dark:hover:bg-rose-500/20"
                                                data-url="<?= base_url('admin/perangkat-desa/pendidikan/delete') ?>"
                                                data-id="<?= esc($h['id']) ?>"
                                                data-perangkat-id="<?= esc($p['id']) ?>">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
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


        </div>

        <!-- Riwayat Jabatan -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 dark:bg-slate-900 dark:border-slate-800">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-xs font-semibold text-slate-700 dark:text-slate-200">
                    Riwayat Jabatan
                </h3>
                <button type="button" onclick="openModalJabatan()"
                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-primary-50 text-primary-700 text-[11px] font-medium hover:bg-primary-100 dark:bg-primary-900/30 dark:text-primary-300 dark:hover:bg-primary-900/50">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    Tambah
                </button>
            </div>

            <div class="overflow-x-auto mb-3">
                <table id="tableJabatan" class="min-w-full text-[11px] md:text-xs">
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
                                        <div class="flex items-center gap-1">
                                            <button type="button"
                                                class="inline-flex items-center px-2 py-1 rounded-full border border-sky-200 bg-sky-50 text-[11px] text-sky-700 hover:bg-sky-100 dark:border-sky-500/40 dark:bg-sky-500/10 dark:text-sky-200 dark:hover:bg-sky-500/20"
                                                onclick='openModalJabatan(<?= json_encode($h) ?>)'>
                                                Edit
                                            </button>
                                            <button type="button"
                                                class="btnDeleteJabatan inline-flex items-center px-2 py-1 rounded-full border border-rose-200 bg-rose-50 text-[11px] text-rose-700 hover:bg-rose-100 dark:border-rose-500/40 dark:bg-rose-500/10 dark:text-rose-200 dark:hover:bg-rose-500/20"
                                                data-url="<?= base_url('admin/perangkat-desa/jabatan/delete') ?>"
                                                data-id="<?= esc($h['id']) ?>"
                                                data-perangkat-id="<?= esc($p['id']) ?>">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
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


        </div>
    </div>
</div>

<!-- Modal Pendidikan -->
<div id="modalPendidikan" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm overflow-y-auto">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="w-full max-w-lg rounded-2xl bg-white shadow-xl dark:bg-slate-900 border border-slate-100 dark:border-slate-800 transform transition-all">
            <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-100" id="modalPendidikanTitle">
                    Tambah Riwayat Pendidikan
                </h3>
                <button type="button" onclick="closeModal('modalPendidikan')" class="text-slate-400 hover:text-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                    </svg>
                </button>
            </div>
            <form id="formPendidikan" action="<?= base_url('admin/perangkat-desa/pendidikan/save') ?>" method="post" enctype="multipart/form-data" class="p-4 space-y-3">
                <?= csrf_field() ?>
                <input type="hidden" name="perangkat_id" value="<?= esc($p['id']) ?>">
                <input type="hidden" name="id" id="pendidikan_id">
                <input type="hidden" name="ijazah_file_old" id="ijazah_file_old">

                <div>
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Pendidikan</label>
                    <select name="pendidikan_id" id="pendidikan_pendidikan_id" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        <option value="">- Pilih -</option>
                        <?php foreach (($pendidikanMaster ?? []) as $pd): ?>
                            <option value="<?= $pd['id'] ?>"><?= esc($pd['nama_pendidikan']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Lembaga</label>
                    <input type="text" name="nama_lembaga" id="pendidikan_nama_lembaga" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Jurusan</label>
                    <input type="text" name="jurusan" id="pendidikan_jurusan" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Th. Masuk</label>
                        <input type="number" name="tahun_masuk" id="pendidikan_tahun_masuk" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Th. Lulus</label>
                        <input type="number" name="tahun_lulus" id="pendidikan_tahun_lulus" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">File Ijazah</label>
                    <input type="file" name="ijazah_file" class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    <p id="pendidikan_file_link" class="mt-1 text-[10px] text-slate-400">Biarkan kosong jika tidak ingin mengubah file.</p>
                </div>
                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" onclick="closeModal('modalPendidikan')" class="px-3 py-1.5 rounded-xl border border-slate-200 text-xs font-medium text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                        Batal
                    </button>
                    <button type="submit" class="px-3 py-1.5 rounded-xl bg-primary-600 text-white text-xs font-medium hover:bg-primary-700 focus:ring-2 focus:ring-primary-500/50">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Jabatan -->
<div id="modalJabatan" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm overflow-y-auto">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="w-full max-w-2xl rounded-2xl bg-white shadow-xl dark:bg-slate-900 border border-slate-100 dark:border-slate-800 transform transition-all">
            <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-100" id="modalJabatanTitle">
                    Tambah Riwayat Jabatan
                </h3>
                <button type="button" onclick="closeModal('modalJabatan')" class="text-slate-400 hover:text-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                    </svg>
                </button>
            </div>
            <form id="formJabatan" action="<?= base_url('admin/perangkat-desa/jabatan/save') ?>" method="post" enctype="multipart/form-data" class="p-4 space-y-3">
                <?= csrf_field() ?>
                <input type="hidden" name="perangkat_id" value="<?= esc($p['id']) ?>">
                <input type="hidden" name="id" id="jabatan_id">
                <input type="hidden" name="sk_file_old" id="sk_file_old">

                <div class="grid grid-cols-2 gap-3">
                    <div class="col-span-2">
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Jabatan</label>
                        <select name="jabatan_id" id="jabatan_jabatan_id" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">- Pilih -</option>
                            <?php foreach (($jabatanList ?? []) as $jb): ?>
                                <option value="<?= $jb['id'] ?>"><?= esc($jb['nama_jabatan']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Unit Kerja</label>
                        <input type="text" name="nama_unit" id="jabatan_nama_unit" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Nomor SK</label>
                        <input type="text" name="sk_nomor" id="jabatan_sk_nomor" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>
                     <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Tanggal SK</label>
                            <input type="date" name="sk_tanggal" id="jabatan_sk_tanggal" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">TMT Mulai</label>
                            <input type="date" name="tmt_mulai" id="jabatan_tmt_mulai" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">TMT Selesai</label>
                            <input type="date" name="tmt_selesai" id="jabatan_tmt_selesai" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">Keterangan</label>
                            <input type="text" name="keterangan" id="jabatan_keterangan" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">File SK</label>
                        <input type="file" name="sk_file" class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                        <p id="jabatan_file_link" class="mt-1 text-[10px] text-slate-400">Biarkan kosong jika tidak ingin mengubah file.</p>
                    </div>
                </div>
                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" onclick="closeModal('modalJabatan')" class="px-3 py-1.5 rounded-xl border border-slate-200 text-xs font-medium text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                        Batal
                    </button>
                    <button type="submit" class="px-3 py-1.5 rounded-xl bg-primary-600 text-white text-xs font-medium hover:bg-primary-700 focus:ring-2 focus:ring-primary-500/50">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    const baseUrl = "<?= base_url() ?>";
    const csrfName = "<?= csrf_token() ?>";
    let csrfHash = "<?= csrf_hash() ?>";
    const getCsrf = () => csrfHash;
    const setCsrf = (token) => { csrfHash = token };

    function openModalPendidikan(data = null) {
        const modal = document.getElementById('modalPendidikan');
        const form = document.getElementById('formPendidikan');
        const title = document.getElementById('modalPendidikanTitle');
        
        // Reset form
        form.reset();
        document.getElementById('pendidikan_id').value = '';
        document.getElementById('ijazah_file_old').value = '';
        document.getElementById('pendidikan_file_link').innerHTML = '';

        if (data) {
            title.innerText = 'Edit Riwayat Pendidikan';
            document.getElementById('pendidikan_id').value = data.id;
            document.getElementById('pendidikan_pendidikan_id').value = data.pendidikan_id;
            document.getElementById('pendidikan_nama_lembaga').value = data.nama_lembaga;
            document.getElementById('pendidikan_jurusan').value = data.jurusan;
            document.getElementById('pendidikan_tahun_masuk').value = data.tahun_masuk;
            document.getElementById('pendidikan_tahun_lulus').value = data.tahun_lulus;
            document.getElementById('ijazah_file_old').value = data.ijazah_file || '';

             if (data.ijazah_file) {
                 const fileName = data.ijazah_file.split('/').pop();
                document.getElementById('pendidikan_file_link').innerHTML = 
                    `<a href="<?= base_url('file/ijazah/') ?>${fileName}" target="_blank" class="text-blue-500 hover:underline">Lihat File Lama (${fileName})</a>`;
            }
        } else {
            title.innerText = 'Tambah Riwayat Pendidikan';
        }
        
        modal.classList.remove('hidden');
    }

    function openModalJabatan(data = null) {
        const modal = document.getElementById('modalJabatan');
        const form = document.getElementById('formJabatan');
        const title = document.getElementById('modalJabatanTitle');
        
        // Reset form
        form.reset();
        document.getElementById('jabatan_id').value = '';
        document.getElementById('sk_file_old').value = '';
        document.getElementById('jabatan_file_link').innerHTML = '';

        if (data) {
            title.innerText = 'Edit Riwayat Jabatan';
            document.getElementById('jabatan_id').value = data.id;
            document.getElementById('jabatan_jabatan_id').value = data.jabatan_id;
            document.getElementById('jabatan_nama_unit').value = data.nama_unit;
            document.getElementById('jabatan_sk_nomor').value = data.sk_nomor;
            document.getElementById('jabatan_sk_tanggal').value = data.sk_tanggal;
            document.getElementById('jabatan_tmt_mulai').value = data.tmt_mulai;
            document.getElementById('jabatan_tmt_selesai').value = data.tmt_selesai;
            document.getElementById('jabatan_keterangan').value = data.keterangan;
             document.getElementById('sk_file_old').value = data.sk_file || '';

             if (data.sk_file) {
                const fileName = data.sk_file.split('/').pop();
                document.getElementById('jabatan_file_link').innerHTML = 
                    `<a href="<?= base_url('file/sk/') ?>${fileName}" target="_blank" class="text-blue-500 hover:underline">Lihat File Lama (${fileName})</a>`;
            }
        } else {
            title.innerText = 'Tambah Riwayat Jabatan';
        }
        
        modal.classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        AppAdmin.initDeleteAction('#tablePendidikan', '.btnDeletePendidikan', baseUrl + '/admin/perangkat-desa/pendidikan/delete', getCsrf, setCsrf, csrfName);
        AppAdmin.initDeleteAction('#tableJabatan', '.btnDeleteJabatan', baseUrl + '/admin/perangkat-desa/jabatan/delete', getCsrf, setCsrf, csrfName);
    });
</script>

<?= $this->endSection() ?>