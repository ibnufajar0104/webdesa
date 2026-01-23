<?= $this->extend('layout/admin') ?>


<?= $this->section('title') ?>
Banner
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Banner
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Kelola banner yang tampil pada halaman utama website desa.
        </p>
    </div>
    <?= btn_add(base_url('admin/banner/create'), 'Tambah Banner') ?>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-900 dark:border-slate-800">
    <div class="p-3 border-b border-slate-100 dark:border-slate-800">
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Daftar banner yang digunakan pada header/slider halaman utama.
        </p>
    </div>
    <div class="p-3 overflow-x-auto">
        <table id="tableBanner" class="min-w-full text-xs md:text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-600 border-b border-slate-100 dark:bg-slate-900/60 dark:text-slate-200 dark:border-slate-800">
                    <th class="px-3 py-2 text-left font-medium">#</th>
                    <th class="px-3 py-2 text-left font-medium">Gambar</th>
                    <th class="px-3 py-2 text-left font-medium">Judul</th>
                    <th class="px-3 py-2 text-left font-medium">Status</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Urutan</th>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/js/app-admin-helper.js') ?>"></script>

<script>
    $(function() {
        const baseUrl = "<?= base_url() ?>";
        const csrfName = "<?= csrf_token() ?>";
        let csrfHash = "<?= csrf_hash() ?>";

        // Fungsi getter/setter untuk CSRF agar bisa diakses oleh helper
        const getCsrf = () => csrfHash;
        const setCsrf = (newToken) => { csrfHash = newToken; };

        const columns = [{ // index
                data: null,
                orderable: false,
                searchable: false,
                render: 'INDEX',
                className: 'px-3 py-2 whitespace-nowrap'
            },
            { // image
                data: 'image',
                orderable: false,
                searchable: false,
                className: 'px-3 py-2'
            },
            { // title
                data: 'title',
                className: 'px-3 py-2 text-slate-800 dark:text-slate-100'
            },
            { // status
                data: 'status',
                className: 'px-3 py-2 whitespace-nowrap'
            },
            { // position
                data: 'position',
                className: 'px-3 py-2 whitespace-nowrap text-xs text-slate-500 dark:text-slate-400'
            },
            { // actions
                data: 'action',
                orderable: false,
                searchable: false,
                className: 'px-3 py-2 whitespace-nowrap'
            }
        ];

        // Init DataTable via Helper
        let table = AppAdmin.initDataTable(
            '#tableBanner',
            baseUrl + '/admin/banner/datatable',
            columns,
            getCsrf,
            csrfName,
            [[4, 'asc']] // Urutan
        );

        // Init Delete Action via Helper
        AppAdmin.initDeleteAction(
            '#tableBanner',
            '.btnDelete',
            baseUrl + '/admin/banner/delete',
            getCsrf,
            setCsrf,
            csrfName,
            table
        );
    });
</script>

<?= $this->endSection() ?>