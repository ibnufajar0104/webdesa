<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="grid gap-4 md:gap-6 md:grid-cols-3">
    <!-- Kartu ringkasan -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 md:p-5">
        <p class="text-xs font-medium text-slate-500 mb-2">Total Penduduk</p>
        <p class="text-2xl font-semibold text-slate-800 mb-1">
            <?= esc($statistik['penduduk'] ?? 0) ?>
        </p>
        <p class="text-xs text-emerald-600">+4 data baru bulan ini</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 md:p-5">
        <p class="text-xs font-medium text-slate-500 mb-2">Berita Terpublikasi</p>
        <p class="text-2xl font-semibold text-slate-800 mb-1">
            <?= esc($statistik['berita'] ?? 0) ?>
        </p>
        <p class="text-xs text-slate-500">Konten aktif di halaman desa</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 md:p-5">
        <p class="text-xs font-medium text-slate-500 mb-2">Perangkat Desa</p>
        <p class="text-2xl font-semibold text-slate-800 mb-1">
            <?= esc($statistik['perangkat'] ?? 0) ?>
        </p>
        <p class="text-xs text-slate-500">Data struktur pemerintahan desa</p>
    </div>
</div>

<div class="mt-6 grid gap-4 md:grid-cols-3">
    <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-4 md:p-5">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-semibold text-slate-800">Aktivitas Terakhir</h2>
            <span class="text-[11px] text-slate-400">Log singkat</span>
        </div>
        <ul class="space-y-2">
            <li class="flex items-start gap-3">
                <span class="mt-1 w-2 h-2 rounded-full bg-emerald-500"></span>
                <div>
                    <p class="text-xs text-slate-700">
                        Admin menambahkan berita baru <span class="font-medium">“Gotong Royong Bersama Warga”</span>.
                    </p>
                    <p class="text-[11px] text-slate-400">5 menit lalu</p>
                </div>
            </li>
            <li class="flex items-start gap-3">
                <span class="mt-1 w-2 h-2 rounded-full bg-primary-500"></span>
                <div>
                    <p class="text-xs text-slate-700">
                        Data penduduk diperbarui untuk Dusun Melati.
                    </p>
                    <p class="text-[11px] text-slate-400">1 jam lalu</p>
                </div>
            </li>
        </ul>
    </div>

    <div class="bg-gradient-to-br from-primary-500 via-primary-600 to-primary-700 rounded-2xl shadow-sm text-white p-4 md:p-5">
        <h2 class="text-sm font-semibold mb-2">Sambutan Singkat</h2>
        <p class="text-xs text-primary-100/90 leading-relaxed mb-3">
            “Selamat datang di panel administrasi Web Desa. Kelola informasi desa
            dengan rapi, transparan, dan mudah diakses oleh masyarakat.”
        </p>
        <p class="text-[11px] text-primary-100/80">
            Kepala Desa
        </p>
    </div>
</div>

<?= $this->endSection() ?>