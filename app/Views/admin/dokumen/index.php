<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Dokumen
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Dokumen
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Kelola dokumen publik untuk website desa (Perdes, APBDes, RPJMDes, dll).
        </p>
    </div>
    <a href="<?= base_url('admin/dokumen/create') ?>"
        class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-primary-600 text-white text-xs md:text-sm font-medium shadow-sm hover:bg-primary-700">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        <span>Tambah Dokumen</span>
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-900 dark:border-slate-800">
    <div class="p-3 border-b border-slate-100 dark:border-slate-800">
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Daftar dokumen yang tampil di website desa.
        </p>
    </div>

    <div class="p-3 overflow-x-auto">
        <table id="tableDokumen" class="min-w-full text-xs md:text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-600 border-b border-slate-100 dark:bg-slate-900/60 dark:text-slate-200 dark:border-slate-800">
                    <th class="px-3 py-2 text-left font-medium">#</th>
                    <th class="px-3 py-2 text-left font-medium">Judul</th>
                    <th class="px-3 py-2 text-left font-medium">Kategori</th>
                    <th class="px-3 py-2 text-left font-medium">Tahun</th>
                    <th class="px-3 py-2 text-left font-medium">Tanggal</th>
                    <th class="px-3 py-2 text-left font-medium">Status</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Diperbarui</th>
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
        const baseUrl = "<?= base_url() ?>";
        const csrfName = "<?= csrf_token() ?>";
        let csrfHash = "<?= csrf_hash() ?>";

        let table = $('#tableDokumen').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: baseUrl + '/admin/dokumen/datatable',
                type: 'POST',
                data: function(d) {
                    d[csrfName] = csrfHash;
                }
            },
            order: [
                [6, 'desc']
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
                    data: 'judul',
                    className: 'px-3 py-2 text-slate-800 dark:text-slate-100'
                },
                {
                    data: 'kategori_nama',
                    render: function(v) {
                        return v ? v : '-';
                    },
                    className: 'px-3 py-2'
                },
                {
                    data: 'tahun',
                    render: function(v) {
                        return v ? v : '-';
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: 'tanggal',
                    render: function(v) {
                        return v ? v : '-';
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: 'is_active',
                    render: function(val) {
                        const isOn = Number(val) === 1;
                        const color = isOn ?
                            'bg-emerald-100 text-emerald-700 border-emerald-200 dark:bg-emerald-900/40 dark:text-emerald-200 dark:border-emerald-700' :
                            'bg-slate-100 text-slate-600 border-slate-200 dark:bg-slate-800/60 dark:text-slate-200 dark:border-slate-700';
                        const label = isOn ? 'Aktif' : 'Nonaktif';
                        return `<span class="inline-flex px-2 py-0.5 rounded-full border text-[11px] ${color}">${label}</span>`;
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: 'updated_at',
                    render: function(v) {
                        return v ? v : '-';
                    },
                    className: 'px-3 py-2 whitespace-nowrap text-xs text-slate-500 dark:text-slate-400'
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(row) {
                        const editUrl = baseUrl + '/admin/dokumen/edit/' + row.id;
                        const fileUrl = row.file_path ? (baseUrl + '/file/dokumen/' + row.file_path) : null;

                        return `
                        <div class="flex items-center gap-1.5">

                        <!-- FILE -->
                        ${fileUrl ? `
                        <a href="${fileUrl}" target="_blank"
                        title="Lihat File"
                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full
                                border border-slate-200 bg-slate-50 text-[11px] font-medium
                                text-slate-700 hover:bg-slate-100
                                dark:border-slate-700 dark:bg-slate-800/60 dark:text-slate-200">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="w-3.5 h-3.5">
                                <path d="M14 2H7a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"/>
                                <path d="M14 2v6h6"/>
                                <path d="M9 13h6"/>
                                <path d="M9 17h6"/>
                            </svg>

                            <span>File</span>
                        </a>
                        ` : ''}

                        <!-- EDIT -->
                        <a href="${editUrl}"
                        title="Edit"
                        class="js-keep-page inline-flex items-center gap-1 px-2.5 py-1 rounded-full
                                border border-sky-200 bg-sky-50 text-[11px] font-medium
                                text-sky-700 hover:bg-sky-100
                                focus:outline-none focus:ring-1 focus:ring-sky-400/70
                                dark:border-sky-500/40 dark:bg-sky-500/10
                                dark:text-sky-200 dark:hover:bg-sky-500/20">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="w-3.5 h-3.5">
                                <path d="m16.862 4.487 1.687 1.688a1.875 1.875 0 0 1 0 2.652L8.21 19.167
                                        A4.5 4.5 0 0 1 6.678 20l-2.135.534
                                        A.75.75 0 0 1 4 19.808l.534-2.135
                                        a4.5 4.5 0 0 1 1.334-2.531
                                        l10.338-10.338a1.875 1.875 0 0 1 2.652 0z"/>
                                <path d="M16.5 4.5 19.5 7.5"/>
                            </svg>

                            <span>Edit</span>
                        </a>

                        <!-- HAPUS -->
                        <button type="button"
                                title="Hapus"
                                data-id="${row.id}"
                                class="btnDelete inline-flex items-center gap-1 px-2.5 py-1 rounded-full
                                    border border-rose-200 bg-rose-50 text-[11px] font-medium
                                    text-rose-700 hover:bg-rose-100
                                    focus:outline-none focus:ring-1 focus:ring-rose-400/70
                                    dark:border-rose-500/40 dark:bg-rose-500/10
                                    dark:text-rose-200 dark:hover:bg-rose-500/20">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="w-3.5 h-3.5">
                                <path d="M6 7h12"/>
                                <path d="M9 7V5h6v2"/>
                                <rect x="7" y="7" width="10" height="12" rx="1.5"/>
                                <path d="M10 11v5"/>
                                <path d="M14 11v5"/>
                            </svg>

                            <span>Hapus</span>
                        </button>

                    </div>
                        `;
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                }
            ]
        });

        $('#tableDokumen').on('click', '.btnDelete', function() {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Hapus dokumen?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#e11d48'
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: baseUrl + '/admin/dokumen/delete',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        [csrfName]: csrfHash
                    },
                    success: function(res) {
                        if (res.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: res.message || 'Dokumen berhasil dihapus',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            table.ajax.reload(null, false);
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