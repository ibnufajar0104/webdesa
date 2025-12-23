<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Berita
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Berita
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Kelola berita, pengumuman, dan informasi terkini di website desa.
        </p>
    </div>
    <a href="<?= base_url('admin/berita/create') ?>"
        class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-primary-600 text-white text-xs md:text-sm font-medium shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:ring-offset-1 focus:ring-offset-slate-50 dark:focus:ring-offset-slate-900">

        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 4.5v15m7.5-7.5h-15" />
        </svg>

        <span>Tambah Berita</span>
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-900 dark:border-slate-800">
    <div class="p-3 border-b border-slate-100 dark:border-slate-800">
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Daftar berita yang tampil di website desa.
        </p>
    </div>
    <div class="p-3 overflow-x-auto">
        <table id="tableNews" class="min-w-full text-xs md:text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-600 border-b border-slate-100 dark:bg-slate-900/60 dark:text-slate-200 dark:border-slate-800">
                    <th class="px-3 py-2 text-left font-medium">#</th>
                    <th class="px-3 py-2 text-left font-medium">Gambar</th>
                    <th class="px-3 py-2 text-left font-medium">Judul</th>
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

<link rel="stylesheet"
    href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        const baseUrl = "<?= base_url() ?>";
        const csrfName = "<?= csrf_token() ?>";
        let csrfHash = "<?= csrf_hash() ?>";

        let table = $('#tableNews').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: baseUrl + '/admin/berita/datatable',
                type: 'POST',
                data: function(d) {
                    d[csrfName] = csrfHash;
                }
            },
            order: [
                [4, 'desc'] // kolom Diperbarui
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
                },
                aria: {
                    sortAscending: ": aktifkan untuk mengurutkan kolom naik",
                    sortDescending: ": aktifkan untuk mengurutkan kolom turun"
                }
            },
            columns: [{ // index
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                { // cover image
                    data: 'cover_image',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        if (!data) {
                            return '<div class="w-12 h-8 rounded-md bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-[10px] text-slate-400">No Img</div>';
                        }
                        const url = baseUrl + '/file/news/' + data;
                        return `
                            <div class="w-14 h-10 rounded-md overflow-hidden bg-slate-100 dark:bg-slate-800">
                                <img src="${url}" alt="cover" class="w-full h-full object-cover" loading="lazy">
                            </div>
                        `;
                    },
                    className: 'px-3 py-2'
                },
                { // title
                    data: 'title',
                    className: 'px-3 py-2 text-slate-800 dark:text-slate-100'
                },
                { // status
                    data: 'status',
                    render: function(data) {
                        let color = data === 'published' ?
                            'bg-emerald-100 text-emerald-700 border-emerald-200 dark:bg-emerald-900/40 dark:text-emerald-200 dark:border-emerald-700' :
                            'bg-slate-100 text-slate-600 border-slate-200 dark:bg-slate-800/60 dark:text-slate-200 dark:border-slate-700';
                        let label = data === 'published' ? 'Published' : 'Draft';
                        return `<span class="inline-flex px-2 py-0.5 rounded-full border text-[11px] ${color}">${label}</span>`;
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                { // updated_at
                    data: 'updated_at',
                    render: function(data) {
                        return data ? data : '-';
                    },
                    className: 'px-3 py-2 whitespace-nowrap text-xs text-slate-500 dark:text-slate-400'
                },
                { // actions
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(row) {
                        let editUrl = baseUrl + '/admin/berita/edit/' + row.id;
                        return `
                        <div class="flex items-center gap-1.5">
            

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
            ]
        });

        $('#tableNews').on('click', '.btnDelete', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Hapus berita?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#e11d48'
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: baseUrl + '/admin/berita/delete',
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
                                text: res.message || 'Berita berhasil dihapus',
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