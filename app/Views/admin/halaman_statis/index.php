<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Halaman Statis
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Halaman Statis
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Kelola halaman seperti Profil Desa, Visi Misi, Struktur Organisasi, dan lainnya.
        </p>
    </div>
    <a href="<?= base_url('admin/halaman-statis/create') ?>"
        class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-primary-600 text-white text-xs md:text-sm font-medium shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:ring-offset-1 focus:ring-offset-slate-50 dark:focus:ring-offset-slate-900">

        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 4.5v15m7.5-7.5h-15" />
        </svg>

        <span>Tambah Halaman</span>
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-900 dark:border-slate-800">
    <div class="p-3 border-b border-slate-100 dark:border-slate-800">
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Daftar halaman statis yang tampil di website desa.
        </p>
    </div>
    <div class="p-3 overflow-x-auto">
        <table id="tablePages" class="min-w-full text-xs md:text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-600 border-b border-slate-100 dark:bg-slate-900/60 dark:text-slate-200 dark:border-slate-800">
                    <th class="px-3 py-2 text-left font-medium">#</th>
                    <th class="px-3 py-2 text-left font-medium">Judul</th>
                    <th class="px-3 py-2 text-left font-medium">Slug</th>
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
<script src="<?= base_url('assets/js/app-admin-helper.js') ?>"></script>

<script>
    $(function() {
        const baseUrl = "<?= base_url() ?>";
        const csrfName = "<?= csrf_token() ?>";
        let csrfHash = "<?= csrf_hash() ?>";

        const getCsrf = () => csrfHash;
        const setCsrf = (newToken) => { csrfHash = newToken; };

        const columns = [{ // index
                data: null,
                orderable: false,
                searchable: false,
                render: 'INDEX',
                className: 'px-3 py-2 whitespace-nowrap'
            },
            { // title
                data: 'title',
                className: 'px-3 py-2 text-slate-800 dark:text-slate-100'
            },
            { // slug
                data: 'slug',
                className: 'px-3 py-2 text-xs text-slate-500 dark:text-slate-400'
            },
            { // status
                data: 'status',
                className: 'px-3 py-2 whitespace-nowrap'
            },
            { // updated_at
                data: 'updated_at',
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
            '#tablePages',
            baseUrl + '/admin/halaman-statis/datatable',
            columns,
            getCsrf,
            csrfName,
            [[1, 'asc']] // Order by Title
        );

        // Init Delete Action via Helper
        AppAdmin.initDeleteAction(
            '#tablePages',
            '.btnDelete',
            baseUrl + '/admin/halaman-statis/delete',
            getCsrf,
            setCsrf,
            csrfName,
            table
        );
    });
</script>

<?= $this->endSection() ?>