<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="w-full max-w-full space-y-6">

    <!-- Header kecil di dalam konten -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
                Ringkasan Web Desa
            </h2>
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Ikhtisar singkat konten dan data utama yang dikelola melalui CMS Desa Batilai.
            </p>
        </div>

        <!-- Quick actions -->
        <div class="flex flex-wrap gap-2">
            <a href="<?= base_url('admin/berita/create') ?>"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-[11px] md:text-xs
                      bg-primary-600 text-white shadow-sm hover:bg-primary-700">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.8"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14M5 12h14" />
                </svg>
                <span>Tambah Berita</span>
            </a>

            <a href="<?= base_url('admin/halaman-statis/create') ?>"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-[11px] md:text-xs
                      border border-slate-200 bg-white text-slate-700 shadow-sm
                      hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:hover:bg-slate-800">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.7"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M7 3.5h7.5L19 8v12H7z" />
                    <path d="M14.5 3.5V8H19" />
                    <path d="M10 11h5M10 14h3" />
                </svg>
                <span>Halaman Baru</span>
            </a>
        </div>
    </div>

    <!-- Stat cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <!-- Total Penduduk -->
        <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-4
                    dark:bg-slate-900 dark:border-slate-800">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-[11px] uppercase tracking-wide text-slate-400">Total Penduduk</p>
                    <p class="mt-1 text-2xl font-semibold text-slate-800 dark:text-slate-100">
                        <?= esc($totalPenduduk ?? 0) ?>
                    </p>
                    <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                        Data penduduk desa terdaftar di sistem.
                    </p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center
                            dark:bg-primary-900/40 dark:text-primary-300">
                    <!-- Icon users -->
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 13.5c-2.2 0-4 1.3-4 3v1.5h8v-1.5c0-1.7-1.8-3-4-3z" />
                        <circle cx="8" cy="8.5" r="2.5" />
                        <path d="M16 12.5c1.7 0 3 1.1 3 2.6V18" />
                        <circle cx="16" cy="8.5" r="2.1" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Berita -->
        <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-4
                    dark:bg-slate-900 dark:border-slate-800">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-[11px] uppercase tracking-wide text-slate-400">Total Berita</p>
                    <p class="mt-1 text-2xl font-semibold text-slate-800 dark:text-slate-100">
                        <?= esc($totalBerita ?? 0) ?>
                    </p>
                    <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                        Informasi & berita desa yang ditayangkan.
                    </p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center
                            dark:bg-emerald-900/40 dark:text-emerald-300">
                    <!-- Icon newspaper -->
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="4" y="5" width="16" height="14" rx="1.5" />
                        <path d="M8 9h5M8 12h5M8 15h3" />
                        <rect x="15" y="9" width="3" height="6" rx="0.6" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Halaman Statis -->
        <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-4
                    dark:bg-slate-900 dark:border-slate-800">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-[11px] uppercase tracking-wide text-slate-400">Halaman Statis</p>
                    <p class="mt-1 text-2xl font-semibold text-slate-800 dark:text-slate-100">
                        <?= esc($totalHalaman ?? 0) ?>
                    </p>
                    <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                        Profil, layanan, dan informasi tetap desa.
                    </p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center
                                dark:bg-amber-900/40 dark:text-amber-300">
                    <!-- Icon document -->
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 3.5h7.5L19 8v12H7z" />
                        <path d="M14.5 3.5V8H19" />
                        <path d="M10 11h5M10 14h3" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Perangkat Desa -->
        <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-4
                    dark:bg-slate-900 dark:border-slate-800">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-[11px] uppercase tracking-wide text-slate-400">Perangkat Desa</p>
                    <p class="mt-1 text-2xl font-semibold text-slate-800 dark:text-slate-100">
                        <?= esc($totalPerangkat ?? 0) ?>
                    </p>
                    <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                        Struktur perangkat desa yang terdata.
                    </p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-fuchsia-50 text-fuchsia-600 flex items-center justify-center
                            dark:bg-fuchsia-900/40 dark:text-fuchsia-300">
                    <!-- Icon briefcase/person -->
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="4" y="8" width="16" height="10" rx="1.5" />
                        <path d="M9 8V6.5A1.5 1.5 0 0 1 10.5 5h3A1.5 1.5 0 0 1 15 6.5V8" />
                        <path d="M4 12h16" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- 2 kolom: berita terbaru + aktivitas / info lain -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Kolom kiri: Berita terbaru -->
        <div class="lg:col-span-2 rounded-2xl bg-white border border-slate-200 shadow-sm
                    dark:bg-slate-900 dark:border-slate-800">
            <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between
                        dark:border-slate-800">
                <div>
                    <h3 class="text-xs font-semibold text-slate-800 dark:text-slate-100">
                        Berita Terbaru
                    </h3>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400">
                        Beberapa berita terakhir yang telah dipublikasikan.
                    </p>
                </div>
                <a href="<?= base_url('admin/berita') ?>"
                    class="text-[11px] text-primary-600 hover:text-primary-700 dark:text-primary-400">
                    Lihat semua
                </a>
            </div>

            <div class="divide-y divide-slate-100 dark:divide-slate-800">
                <?php if (!empty($latestBerita) && is_array($latestBerita)): ?>
                    <?php foreach ($latestBerita as $berita): ?>
                        <div class="px-4 py-3 flex items-start gap-3">
                            <div
                                class="mt-1 w-8 h-8 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center text-[10px] font-semibold uppercase dark:bg-primary-900/40 dark:text-primary-300">
                                <?= mb_substr(esc($berita['judul'] ?? 'B'), 0, 1) ?>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-semibold text-slate-800 truncate dark:text-slate-100">
                                    <?= esc($berita['judul'] ?? 'Tanpa judul') ?>
                                </p>
                                <p class="mt-0.5 text-[11px] text-slate-500 line-clamp-2 dark:text-slate-400">
                                    <?= esc($berita['ringkasan'] ?? ($berita['excerpt'] ?? '')) ?>
                                </p>
                                <div class="mt-1 flex items-center gap-2 text-[10px] text-slate-400">
                                    <span>
                                        <?= esc($berita['penulis'] ?? 'Admin Web Desa') ?>
                                    </span>
                                    <span>•</span>
                                    <span>
                                        <?= esc($berita['tanggal'] ?? ($berita['created_at'] ?? '')) ?>
                                    </span>
                                </div>
                            </div>
                            <a href="<?= base_url('admin/berita/edit/' . ($berita['id'] ?? 0)) ?>"
                                class="text-[11px] text-primary-600 hover:text-primary-700 dark:text-primary-400">
                                Edit
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="px-4 py-6 text-center text-[11px] text-slate-500 dark:text-slate-400">
                        Belum ada berita yang ditambahkan. Mulai dengan membuat berita pertama.
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Kolom kanan: Info singkat / shortcut -->
        <div class="space-y-4">
            <!-- Card informasi sistem -->
            <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-4
                        dark:bg-slate-900 dark:border-slate-800">
                <h3 class="text-xs font-semibold text-slate-800 dark:text-slate-100">
                    Informasi Sistem
                </h3>
                <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                    CMS Desa Batilai digunakan untuk mengelola konten website resmi desa, mulai dari
                    halaman profil, data penduduk, perangkat desa, hingga berita dan pengumuman.
                </p>

                <ul class="mt-3 space-y-1.5 text-[11px] text-slate-600 dark:text-slate-300">
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span>Login sebagai <b>Admin Web Desa</b>.</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary-500"></span>
                        <span>Gunakan menu di sidebar untuk mengelola modul-modul utama.</span>
                    </li>
                </ul>
            </div>

            <!-- Card link cepat -->
            <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-4
                        dark:bg-slate-900 dark:border-slate-800">
                <h3 class="text-xs font-semibold text-slate-800 dark:text-slate-100">
                    Tindakan Cepat
                </h3>
                <div class="mt-2 flex flex-col gap-2 text-[11px]">
                    <a href="<?= base_url('admin/perangkat-desa') ?>"
                        class="inline-flex items-center justify-between px-3 py-2 rounded-xl
                              bg-slate-50 hover:bg-slate-100 text-slate-700
                              dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-slate-100">
                        <span>Kelola Perangkat Desa</span>
                        <span class="text-[10px] text-slate-400">Struktur organisasi</span>
                    </a>
                    <a href="<?= base_url('admin/jam-pelayanan') ?>"
                        class="inline-flex items-center justify-between px-3 py-2 rounded-xl
                              bg-slate-50 hover:bg-slate-100 text-slate-700
                              dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-slate-100">
                        <span>Atur Jam Pelayanan</span>
                        <span class="text-[10px] text-slate-400">Tampilan di halaman depan</span>
                    </a>
                    <a href="<?= base_url('admin/kontak') ?>"
                        class="inline-flex items-center justify-between px-3 py-2 rounded-xl
                              bg-slate-50 hover:bg-slate-100 text-slate-700
                              dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-slate-100">
                        <span>Update Kontak Desa</span>
                        <span class="text-[10px] text-slate-400">Telepon, WA, alamat</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>