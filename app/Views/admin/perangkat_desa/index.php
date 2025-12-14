<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Daftar Perangkat Desa
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Daftar Perangkat Desa
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Kelola data perangkat desa beserta jabatan dan riwayat pendidikannya.
        </p>
    </div>
    <a href="<?= base_url('admin/perangkat-desa/create') ?>"
        class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-primary-600 text-white text-xs md:text-sm font-medium shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:ring-offset-1 focus:ring-offset-slate-50 dark:focus:ring-offset-slate-900">
        <!-- ICON PLUS (sama seperti Tambah Penduduk) -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        <span>Tambah Perangkat</span>
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-900 dark:border-slate-800">
    <div class="p-3 border-b border-slate-100 dark:border-slate-800">
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Daftar perangkat desa yang aktif beserta jabatan dan kontaknya.
        </p>
    </div>

    <!-- FILTER BAR -->
    <div class="px-3 pt-3 pb-1 border-b border-slate-100 dark:border-slate-800">
        <div class="grid gap-2 sm:grid-cols-2 md:grid-cols-3">

            <!-- Jabatan -->
            <div>
                <label for="filterJabatan"
                    class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                    Jabatan
                </label>
                <select id="filterJabatan"
                    class="w-full rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    <option value="">Semua Jabatan</option>
                    <?php foreach (($jabatanList ?? []) as $j): ?>
                        <option value="<?= $j['id'] ?>">
                            <?= esc($j['nama_jabatan']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Status Aktif -->
            <div>
                <label for="filterStatus"
                    class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                    Status
                </label>
                <select id="filterStatus"
                    class="w-full rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    <option value="">Semua</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>

        </div>

        <!-- tombol reset filter -->
        <div class="mt-2 flex justify-end">
            <button type="button" id="btnResetFilter"
                class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-xl border border-slate-200 text-[11px] text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                <!-- ICON RESET (sama pattern seperti penduduk) -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                        d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z"
                        clip-rule="evenodd" />
                </svg>
                <span>Reset filter</span>
            </button>
        </div>
    </div>

    <!-- TABLE -->
    <div class="p-3 overflow-x-auto">
        <table id="tablePerangkat" class="min-w-full text-xs md:text-sm">
            <thead>
                <tr
                    class="bg-slate-50 text-slate-600 border-b border-slate-100 dark:bg-slate-900/60 dark:text-slate-200 dark:border-slate-800">
                    <th class="px-3 py-2 text-left font-medium">#</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Nama</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">NIP / NIK</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Jabatan</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Kontak</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Status</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">TMT Jabatan</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800"></tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet"
    href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        const baseUrl = "<?= rtrim(base_url(), '/') ?>/";
        const csrfName = "<?= csrf_token() ?>";
        let csrfHash = "<?= csrf_hash() ?>";

        const storageKey = 'perangkat_page';

        const table = $('#tablePerangkat').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: baseUrl + 'admin/perangkat-desa/datatable',
                type: 'POST',
                data: function(d) {
                    d[csrfName] = csrfHash;

                    d.filter_jabatan = $('#filterJabatan').val();
                    d.filter_status = $('#filterStatus').val();
                }
            },
            order: [
                [1, 'asc']
            ],
            language: {
                processing: "Memproses...",
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(difilter dari total _MAX_ data)",
                loadingRecords: "Memuat data...",
                zeroRecords: "Tidak ada data yang cocok",
                emptyTable: "Tidak ada data",
                paginate: {
                    first: "«",
                    last: "»",
                    previous: "&lt;",
                    next: "&gt;"
                }
            },
            columns: [{
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: 'nama',
                    className: 'px-3 py-2 text-slate-800 dark:text-slate-100'
                },
                {
                    data: null,
                    render: function(row) {
                        const nip = row.nip || '-';
                        const nik = row.nik || '-';
                        return `
                            <div class="flex flex-col">
                                <span class="text-xs text-slate-800 dark:text-slate-100 font-mono">${nip}</span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400 font-mono">NIK: ${nik}</span>
                            </div>
                        `;
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: null,
                    render: function(row) {
                        const jabatan = row.nama_jabatan || '-';
                        const pendidikan = row.nama_pendidikan || '-';
                        return `
                            <div class="flex flex-col">
                                <span class="text-xs text-slate-800 dark:text-slate-100">${jabatan}</span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400">Pendidikan: ${pendidikan}</span>
                            </div>
                        `;
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: null,
                    render: function(row) {
                        const hp = row.no_hp || '-';
                        const email = row.email || '-';
                        return `
                            <div class="flex flex-col">
                                <span class="text-xs text-slate-800 dark:text-slate-100">${hp}</span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400">${email}</span>
                            </div>
                        `;
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: 'status_aktif',
                    render: function(data) {
                        if (parseInt(data) === 1) {
                            return '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-900/40 dark:text-emerald-200 dark:border-emerald-700">Aktif</span>';
                        }
                        return '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-slate-50 text-slate-700 border border-slate-200 dark:bg-slate-800/60 dark:text-slate-200 dark:border-slate-700">Tidak Aktif</span>';
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: 'tmt_jabatan',
                    render: function(data) {
                        return data ? data : '-';
                    },
                    className: 'px-3 py-2 whitespace-nowrap text-xs text-slate-700 dark:text-slate-200'
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(row) {
                        const detailUrl = baseUrl + 'admin/perangkat-desa/detail/' + row.id;
                        const editUrl = baseUrl + 'admin/perangkat-desa/edit/' + row.id;

                        return `
            <div class="flex items-center gap-1.5">
                <!-- DETAIL: icon sama dengan Data Penduduk -->
                <a href="${detailUrl}"
                   class="js-keep-page inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-slate-200 bg-white text-[11px] font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-1 focus:ring-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100 dark:hover:bg-slate-800"
                   title="Detail">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20" fill="currentColor"
                         class="w-3.5 h-3.5">
                        <path d="M8 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                        <path fill-rule="evenodd"
                              d="M4.5 2A1.5 1.5 0 0 0 3 3.5v13A1.5 1.5 0 0 0 4.5 18h11a1.5 1.5 0 0 0 1.5-1.5V7.621a1.5 1.5 0 0 0-.44-1.06l-4.12-4.122A1.5 1.5 0 0 0 11.378 2H4.5Zm5 5a3 3 0 1 0 1.524 5.585l1.196 1.195a.75.75 0 1 0 1.06-1.06l-1.195-1.196A3 3 0 0 0 9.5 7Z"
                              clip-rule="evenodd" />
                    </svg>
                    <span>Detail</span>
                </a>

                <!-- EDIT: icon sama dengan Data Penduduk -->
                <a href="${editUrl}"
                   class="js-keep-page inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-sky-200 bg-sky-50 text-[11px] font-medium text-sky-700 hover:bg-sky-100 focus:outline-none focus:ring-1 focus:ring-sky-400/70 dark:border-sky-500/40 dark:bg-sky-500/10 dark:text-sky-200 dark:hover:bg-sky-500/20"
                   title="Edit">
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

                <!-- HAPUS: icon sama dengan Data Penduduk -->
                <button type="button"
                        class="btnDelete inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-rose-200 bg-rose-50 text-[11px] font-medium text-rose-700 hover:bg-rose-100 focus:outline-none focus:ring-1 focus:ring-rose-400/70 dark:border-rose-500/40 dark:bg-rose-500/10 dark:text-rose-200 dark:hover:bg-rose-500/20"
                        data-id="${row.id}" title="Hapus">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                         fill="currentColor" class="size-4">
                        <path fill-rule="evenodd"
                              d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z"
                              clip-rule="evenodd" />
                    </svg>
                    <span>Hapus</span>
                </button>
            </div>
        `;
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                }
            ],
            initComplete: function() {
                const api = this.api();
                const savedPage = localStorage.getItem(storageKey);

                if (savedPage !== null) {
                    const pageNum = parseInt(savedPage, 10);
                    if (!isNaN(pageNum)) {
                        api.page(pageNum).draw(false);
                    }
                }
            }
        });

        // simpan nomor halaman sebelum ke Detail/Edit
        $('#tablePerangkat').on('click', '.js-keep-page', function() {
            const currentPage = table.page(); // index mulai 0
            localStorage.setItem(storageKey, currentPage);
        });

        // trigger draw ketika filter berubah
        $('#filterJabatan, #filterStatus').on('change', function() {
            table.draw();
        });

        // reset filter
        $('#btnResetFilter').on('click', function() {
            $('#filterJabatan').val('');
            $('#filterStatus').val('');
            table.draw();
        });

        // Hapus dengan jQuery + AJAX + SweetAlert2
        $('#tablePerangkat').on('click', '.btnDelete', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Hapus data perangkat?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#e11d48'
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: baseUrl + 'admin/perangkat-desa/delete',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        [csrfName]: csrfHash
                    },
                    success: function(res) {
                        if (res.newToken) {
                            csrfHash = res.newToken;
                        }

                        if (res.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: res.message || 'Data perangkat desa berhasil dihapus',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            table.draw(false); // tetap di halaman yang sama
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: res.message || 'Gagal menghapus data'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat menghapus data'
                        });
                    }
                });
            });
        });
    });
</script>

<?= $this->endSection() ?>