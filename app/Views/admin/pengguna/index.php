<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Pengguna
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">Pengguna</h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">Kelola akun admin & superadmin.</p>
    </div>
    <a href="<?= base_url('admin/pengguna/create') ?>"
        class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-primary-600 text-white text-xs md:text-sm font-medium shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:ring-offset-1 focus:ring-offset-slate-50 dark:focus:ring-offset-slate-900">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        <span>Tambah Pengguna</span>
    </a>
</div>

<?php if (session('success')): ?>
    <div class="mb-3 rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs text-emerald-700 dark:border-emerald-500/40 dark:bg-emerald-500/10 dark:text-emerald-100">
        <?= esc(session('success')) ?>
    </div>
<?php endif; ?>

<?php if (session('error')): ?>
    <div class="mb-3 rounded-xl border border-rose-200 bg-rose-50 px-3 py-2 text-xs text-rose-700 dark:border-rose-500/40 dark:bg-rose-500/10 dark:text-rose-100">
        <?= esc(session('error')) ?>
    </div>
<?php endif; ?>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-900 dark:border-slate-800">
    <div class="p-3 border-b border-slate-100 dark:border-slate-800">
        <p class="text-xs text-slate-500 dark:text-slate-400">Daftar pengguna aplikasi (role: superadmin/admin).</p>
    </div>

    <!-- FILTER BAR -->
    <div class="px-3 pt-3 pb-1 border-b border-slate-100 dark:border-slate-800">
        <div class="grid gap-2 sm:grid-cols-2 md:grid-cols-3">

            <div>
                <label for="filterRole" class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">Role</label>
                <select id="filterRole"
                    class="w-full rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    <option value="">Semua</option>
                    <?php foreach (($roleList ?? []) as $k => $v): ?>
                        <option value="<?= esc($k) ?>"><?= esc($v) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="filterStatus" class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">Status</label>
                <select id="filterStatus"
                    class="w-full rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    <option value="">Semua</option>
                    <option value="1">Aktif</option>
                    <option value="0">Non Aktif</option>
                </select>
            </div>

        </div>

        <div class="mt-2 flex justify-end">
            <button type="button" id="btnResetFilter"
                class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-xl border border-slate-200 text-[11px] text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                        d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z"
                        clip-rule="evenodd" />
                </svg>
                <span>Reset filter</span>
            </button>
        </div>
    </div>

    <div class="p-3 overflow-x-auto">
        <table id="tablePengguna" class="min-w-full text-xs md:text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-600 border-b border-slate-100 dark:bg-slate-900/60 dark:text-slate-200 dark:border-slate-800">
                    <th class="px-3 py-2 text-left font-medium">#</th>
                    <th class="px-3 py-2 text-left font-medium">Nama</th>
                    <th class="px-3 py-2 text-left font-medium">Username</th>
                    <th class="px-3 py-2 text-left font-medium">Kontak</th>
                    <th class="px-3 py-2 text-left font-medium">Role</th>
                    <th class="px-3 py-2 text-left font-medium">Status</th>
                    <th class="px-3 py-2 text-left font-medium">Last Login</th>
                    <th class="px-3 py-2 text-left font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800"></tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        const baseUrl = "<?= rtrim(base_url(), '/') ?>/";
        const csrfName = "<?= csrf_token() ?>";
        let csrfHash = "<?= csrf_hash() ?>";

        const storageKey = 'pengguna_page';

        const table = $('#tablePengguna').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: baseUrl + 'admin/pengguna/datatable',
                type: 'POST',
                data: function(d) {
                    d[csrfName] = csrfHash;
                    d.filter_role = $('#filterRole').val();
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
                    data: 'username',
                    className: 'px-3 py-2 whitespace-nowrap font-mono text-slate-700 dark:text-slate-200'
                },
                {
                    data: null,
                    render: function(row) {
                        const email = row.email || '-';
                        const hp = row.no_hp || '-';
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
                    data: 'role',
                    render: function(data) {
                        const v = (data || '').toLowerCase();
                        if (v === 'superadmin') {
                            return '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-indigo-50 text-indigo-700 border border-indigo-200 dark:bg-indigo-900/40 dark:text-indigo-200 dark:border-indigo-700">Super Admin</span>';
                        }
                        return '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-sky-50 text-sky-700 border border-sky-200 dark:bg-sky-900/40 dark:text-sky-200 dark:border-sky-700">Admin</span>';
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: 'is_active',
                    render: function(data) {
                        if (parseInt(data) === 1) {
                            return '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-900/40 dark:text-emerald-200 dark:border-emerald-700">Aktif</span>';
                        }
                        return '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-slate-50 text-slate-700 border border-slate-200 dark:bg-slate-800/60 dark:text-slate-200 dark:border-slate-700">Non Aktif</span>';
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: 'last_login_at',
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
                        const editUrl = baseUrl + 'admin/pengguna/edit/' + row.id;
                        return `
                            <div class="flex items-center gap-1.5">
                                <a href="${editUrl}"
                                   class="js-keep-page inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-sky-200 bg-sky-50 text-[11px] font-medium text-sky-700 hover:bg-sky-100 focus:outline-none focus:ring-1 focus:ring-sky-400/70 dark:border-sky-500/40 dark:bg-sky-500/10 dark:text-sky-200 dark:hover:bg-sky-500/20"
                                   title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                         class="w-3.5 h-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m16.862 4.487 1.687 1.688a1.875 1.875 0 0 1 0 2.652L8.21 19.167A4.5 4.5 0 0 1 6.678 20l-2.135.534A.75.75 0 0 1 4 19.808l.534-2.135a4.5 4.5 0 0 1 1.334-2.531l10.338-10.338a1.875 1.875 0 0 1 2.652 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 4.5 19.5 7.5" />
                                    </svg>
                                    <span>Edit</span>
                                </a>

                                <button type="button"
                                        class="btnDelete inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-rose-200 bg-rose-50 text-[11px] font-medium text-rose-700 hover:bg-rose-100 focus:outline-none focus:ring-1 focus:ring-rose-400/70 dark:border-rose-500/40 dark:bg-rose-500/10 dark:text-rose-200 dark:hover:bg-rose-500/20"
                                        data-id="${row.id}" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="w-3.5 h-3.5">
                                        <path d="M6 7h12" />
                                        <path d="M9 7V5h6v2" />
                                        <rect x="7" y="7" width="10" height="12" rx="1.5" />
                                        <path d="M10 11v5" />
                                        <path d="M14 11v5" />
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
                    if (!isNaN(pageNum)) api.page(pageNum).draw(false);
                }
            }
        });

        // simpan page saat klik edit
        $('#tablePengguna').on('click', '.js-keep-page', function() {
            localStorage.setItem(storageKey, table.page());
        });

        // filter
        $('#filterRole, #filterStatus').on('change', function() {
            table.draw();
        });

        $('#btnResetFilter').on('click', function() {
            $('#filterRole').val('');
            $('#filterStatus').val('');
            table.draw();
        });

        // delete
        $('#tablePengguna').on('click', '.btnDelete', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Hapus pengguna?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#e11d48'
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: baseUrl + 'admin/pengguna/delete',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        [csrfName]: csrfHash
                    },
                    success: function(res) {
                        if (res.newToken) csrfHash = res.newToken;

                        if (res.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: res.message || 'Pengguna dihapus',
                                timer: 1800,
                                showConfirmButton: false
                            });
                            table.draw(false);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: res.message || 'Gagal menghapus'
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