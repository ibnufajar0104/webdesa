<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Master Jabatan
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Master Jabatan
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Kelola daftar jabatan perangkat desa yang digunakan pada data perangkat desa.
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
        <span>Tambah Jabatan</span>
    </button>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-900 dark:border-slate-800">
    <div class="p-3 border-b border-slate-100 dark:border-slate-800">
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Sesuaikan nama, kode, dan urutan jabatan sesuai struktur organisasi perangkat desa.
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
        <table id="tableJabatan" class="min-w-full text-xs md:text-sm">
            <thead>
                <tr
                    class="bg-slate-50 text-slate-600 border-b border-slate-100 dark:bg-slate-900/60 dark:text-slate-200 dark:border-slate-800">
                    <th class="px-3 py-2 text-left font-medium">#</th>
                    <th class="px-3 py-2 text-left font-medium">Nama Jabatan</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Kode</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Urut</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Status</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800"></tbody>
        </table>
    </div>
</div>

<!-- MODAL Tambah/Edit -->
<div id="modalJabatan"
    class="fixed inset-0 z-40 hidden items-center justify-center bg-slate-900/40 backdrop-blur-sm">
    <div
        class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl w-full max-w-md border border-slate-200 dark:border-slate-800">
        <div
            class="px-4 py-3 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <h3 id="modalTitle"
                class="text-sm font-semibold text-slate-800 dark:text-slate-100">
                Tambah Jabatan
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

        <form id="formJabatan" method="post"
            action="<?= base_url('admin/master-jabatan/save') ?>"
            class="px-4 py-3 space-y-3">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="jabatanId">

            <div class="space-y-1.5">
                <label for="nama_jabatan"
                    class="text-xs font-medium text-slate-700 dark:text-slate-200">
                    Nama Jabatan <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="nama_jabatan" id="nama_jabatan"
                    class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                           focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500
                           dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                    placeholder="Contoh: Kepala Desa, Sekretaris Desa, Kaur Keuangan" required>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="space-y-1.5">
                    <label for="kode_jabatan"
                        class="text-xs font-medium text-slate-700 dark:text-slate-200">
                        Kode Jabatan
                    </label>
                    <input type="text" name="kode_jabatan" id="kode_jabatan"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500
                               dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                        placeholder="Misal: KADES, SEKDES, KAUR_KEU">
                </div>

                <div class="space-y-1.5">
                    <label for="urut"
                        class="text-xs font-medium text-slate-700 dark:text-slate-200">
                        Urut
                    </label>
                    <input type="number" name="urut" id="urut"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary-500/60 focus:border-primary-500
                               dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                        placeholder="1, 2, 3 ...">
                </div>
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

        // Fungsi getter/setter agar helper bisa update csrf
        const getCsrf = () => csrfHash;
        const setCsrf = (newToken) => { csrfHash = newToken; };

        const modal = document.getElementById('modalJabatan');
        const modalTitle = document.getElementById('modalTitle');
        const idField = document.getElementById('jabatanId');
        const namaField = document.getElementById('nama_jabatan');
        const kodeField = document.getElementById('kode_jabatan');
        const urutField = document.getElementById('urut');
        const aktifField = document.getElementById('is_active');

        // Definisi Columns
        const columns = [
            { // No
                data: null,
                orderable: false,
                searchable: false,
                render: 'INDEX',
                className: 'px-3 py-2 whitespace-nowrap'
            },
            { // Nama Jabatan
                data: 'nama_jabatan',
                className: 'px-3 py-2 text-slate-800 dark:text-slate-100'
            },
            { // Kode
                data: 'kode_jabatan',
                className: 'px-3 py-2 whitespace-nowrap text-slate-700 dark:text-slate-100'
            },
            { // Urut
                data: 'urut',
                className: 'px-3 py-2 whitespace-nowrap text-slate-700 dark:text-slate-100'
            },
            { // Status
                data: 'is_active',
                className: 'px-3 py-2 whitespace-nowrap'
            },
            { // Aksi
                data: 'action',
                orderable: false,
                searchable: false,
                className: 'px-3 py-2 whitespace-nowrap'
            }
        ];

        // Init DataTable via Helper
        let table = AppAdmin.initDataTable(
            '#tableJabatan',
            baseUrl + 'admin/master-jabatan/datatable',
            columns,
            getCsrf,
            csrfName,
            [[3, 'asc']], // Order by Urut
            function(d) {
                d.filter_status = $('#filterStatus').val();
            }
        );

        // Filter status
        $('#filterStatus').on('change', function() {
            table.draw();
        });

        $('#btnResetFilter').on('click', function() {
            $('#filterStatus').val('');
            table.draw();
        });

        // Init Delete Action via Helper
        AppAdmin.initDeleteAction(
            '#tableJabatan',
            '.btnDelete',
            baseUrl + 'admin/master-jabatan/delete',
            getCsrf,
            setCsrf,
            csrfName,
            table
        );

        // Modal helpers
        window.openAddModal = function() {
            modalTitle.textContent = 'Tambah Jabatan';
            idField.value = '';
            namaField.value = '';
            kodeField.value = '';
            urutField.value = '';
            aktifField.value = '1';

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            namaField.focus();
        };

        function openEditModalFromRow(rowBtn) {
            const btn = rowBtn;
            modalTitle.textContent = 'Edit Jabatan';

            idField.value = btn.dataset.id || '';
            namaField.value = btn.dataset.nama || '';
            kodeField.value = btn.dataset.kode || '';
            urutField.value = btn.dataset.urut || '';
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
        $('#tableJabatan').on('click', '.btnEdit', function() {
            openEditModalFromRow(this);
        });
    });
</script>

<?= $this->endSection() ?>