<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Master Dusun
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Master Dusun
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Kelola daftar dusun yang digunakan pada data wilayah/desa.
        </p>
    </div>

    <button type="button"
        onclick="openAddModal()"
        class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-primary-600 text-white text-xs md:text-sm font-medium shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:ring-offset-1 focus:ring-offset-slate-50 dark:focus:ring-offset-slate-900">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        <span>Tambah Dusun</span>
    </button>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-900 dark:border-slate-800">
    <div class="p-3 border-b border-slate-100 dark:border-slate-800">
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Sesuaikan nama, kode, dan status dusun sesuai wilayah desa.
        </p>
    </div>

    <!-- FILTER STATUS -->
    <div class="px-3 pt-3 pb-1 border-b border-slate-100 dark:border-slate-800">
        <div class="flex items-center justify-between gap-2">
            <div>
                <label for="filterStatus"
                    class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                    Status
                </label>
                <select id="filterStatus"
                    class="w-40 rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    <option value="">Semua</option>
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <button type="button" id="btnResetFilter"
                class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-xl border border-slate-200 text-[11px] text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20" fill="currentColor" class="size-5">
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
        <table id="tableDusun" class="min-w-full text-xs md:text-sm">
            <thead>
                <tr
                    class="bg-slate-50 text-slate-600 border-b border-slate-100 dark:bg-slate-900/60 dark:text-slate-200 dark:border-slate-800">
                    <th class="px-3 py-2 text-left font-medium">#</th>
                    <th class="px-3 py-2 text-left font-medium">Nama Dusun</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Kode</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Status</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800"></tbody>
        </table>
    </div>
</div>

<!-- MODAL Tambah/Edit -->
<div id="modalDusun"
    class="fixed inset-0 z-40 hidden items-center justify-center bg-slate-900/40 backdrop-blur-sm">
    <div
        class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl w-full max-w-md border border-slate-200 dark:border-slate-800">
        <div
            class="px-4 py-3 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <h3 id="modalTitle"
                class="text-sm font-semibold text-slate-800 dark:text-slate-100">
                Tambah Dusun
            </h3>
            <button type="button"
                onclick="closeModal()"
                class="inline-flex items-center justify-center w-7 h-7 rounded-xl text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>
        </div>

        <form id="formDusun" method="post"
            action="<?= base_url('admin/master-dusun/save') ?>"
            class="px-4 py-3 space-y-3">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="dusunId">

            <div class="space-y-1.5">
                <label for="nama_dusun"
                    class="text-xs font-medium text-slate-700 dark:text-slate-200">
                    Nama Dusun <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="nama_dusun" id="nama_dusun"
                    class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                           focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500
                           dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                    placeholder="Contoh: Dusun Suka Maju" required>
            </div>

            <div class="space-y-1.5">
                <label for="kode_dusun"
                    class="text-xs font-medium text-slate-700 dark:text-slate-200">
                    Kode Dusun
                </label>
                <input type="text" name="kode_dusun" id="kode_dusun"
                    class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                           focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500
                           dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                    placeholder="Misal: DS01, DS02">
            </div>

            <div class="space-y-1.5">
                <label for="is_active"
                    class="text-xs font-medium text-slate-700 dark:text-slate-200">
                    Status
                </label>
                <select name="is_active" id="is_active"
                    class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                           focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500
                           dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <div class="pt-2 flex items-center justify-end gap-2">
                <button type="button"
                    onclick="closeModal()"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border
                           border-rose-500 text-rose-600 text-xs md:text-sm
                           bg-white hover:bg-rose-50
                           dark:bg-slate-900 dark:border-rose-400 dark:text-rose-300 dark:hover:bg-rose-500/10">
                    Batal
                </button>

                <button type="submit"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border
                           border-primary-500 text-primary-600 text-xs md:text-sm
                           bg-white hover:bg-primary-50
                           dark:bg-slate-900 dark:border-primary-400 dark:text-primary-200 dark:hover:bg-primary-500/10">
                    Simpan
                </button>
            </div>
        </form>
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

        const modal = document.getElementById('modalDusun');
        const modalTitle = document.getElementById('modalTitle');
        const idField = document.getElementById('dusunId');
        const namaField = document.getElementById('nama_dusun');
        const kodeField = document.getElementById('kode_dusun');
        const aktifField = document.getElementById('is_active');

        // DataTables
        let table = $('#tableDusun').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: baseUrl + 'admin/master-dusun/datatable',
                type: 'POST',
                data: function(d) {
                    d[csrfName] = csrfHash;
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
                    data: 'nama_dusun',
                    className: 'px-3 py-2 text-slate-800 dark:text-slate-100'
                },
                {
                    data: 'kode_dusun',
                    render: function(data) {
                        return data || '-';
                    },
                    className: 'px-3 py-2 whitespace-nowrap text-slate-700 dark:text-slate-100'
                },
                {
                    data: 'is_active',
                    render: function(val) {
                        if (parseInt(val) === 1) {
                            return '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-900/40 dark:text-emerald-200 dark:border-emerald-700">Aktif</span>';
                        }
                        return '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-rose-50 text-rose-700 border border-rose-200 dark:bg-rose-900/40 dark:text-rose-200 dark:border-rose-700">Nonaktif</span>';
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(row) {
                        return `
                            <div class="flex items-center gap-1.5">
                                <button type="button"
                                    class="btnEdit inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-sky-200 bg-sky-50 text-[11px] font-medium text-sky-700 hover:bg-sky-100 focus:outline-none focus:ring-1 focus:ring-sky-400/70 dark:border-sky-500/40 dark:bg-sky-500/10 dark:text-sky-200 dark:hover:bg-sky-500/20"
                                    data-id="${row.id}"
                                    data-nama="${row.nama_dusun ?? ''}"
                                    data-kode="${row.kode_dusun ?? ''}"
                                    data-active="${row.is_active}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-3.5 h-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687 1.688a1.875 1.875 0 0 1 0 2.652L8.21 19.167A4.5 4.5 0 0 1 6.678 20l-2.135.534A.75.75 0 0 1 4 19.808l.534-2.135a4.5 4.5 0 0 1 1.334-2.531l10.338-10.338a1.875 1.875 0 0 1 2.652 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 4.5 19.5 7.5" />
                                    </svg>
                                    <span>Edit</span>
                                </button>

                                <button type="button"
                                    class="btnDelete inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-rose-200 bg-rose-50 text-[11px] font-medium text-rose-700 hover:bg-rose-100 focus:outline-none focus:ring-1 focus:ring-rose-400/70 dark:border-rose-500/40 dark:bg-rose-500/10 dark:text-rose-200 dark:hover:bg-rose-500/20"
                                    data-id="${row.id}">
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
            ]
        });

        // Filter status
        $('#filterStatus').on('change', function() {
            table.draw();
        });

        $('#btnResetFilter').on('click', function() {
            $('#filterStatus').val('');
            table.draw();
        });

        // Modal helpers
        window.openAddModal = function() {
            modalTitle.textContent = 'Tambah Dusun';
            idField.value = '';
            namaField.value = '';
            kodeField.value = '';
            aktifField.value = '1';

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            namaField.focus();
        };

        function openEditModalFromRow(rowBtn) {
            const btn = rowBtn;
            modalTitle.textContent = 'Edit Dusun';

            idField.value = btn.dataset.id || '';
            namaField.value = btn.dataset.nama || '';
            kodeField.value = btn.dataset.kode || '';
            aktifField.value = btn.dataset.active || '1';

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            namaField.focus();
        }

        window.closeModal = function() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        };

        modal?.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });

        // Bind edit button
        $('#tableDusun').on('click', '.btnEdit', function() {
            openEditModalFromRow(this);
        });

        // Hapus dengan AJAX + Swal
        $('#tableDusun').on('click', '.btnDelete', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Hapus data dusun?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#e11d48'
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: baseUrl + 'admin/master-dusun/delete',
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
                                text: res.message || 'Data dusun berhasil dihapus',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            table.draw(false);
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