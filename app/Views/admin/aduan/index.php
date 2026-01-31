<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Aduan & Aspirasi
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Aduan & Aspirasi
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Daftar pesan, aduan, dan aspirasi dari masyarakat.
        </p>
    </div>
    <!-- No "Add" button needed since this is user generated -->
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-900 dark:border-slate-800">
    <div class="p-3 border-b border-slate-100 dark:border-slate-800">
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Data masuk dari formulir kontak.
        </p>
    </div>
    <div class="p-3 overflow-x-auto">
        <table id="tableAduan" class="min-w-full text-xs md:text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-600 border-b border-slate-100 dark:bg-slate-900/60 dark:text-slate-200 dark:border-slate-800">
                    <th class="px-3 py-2 text-left font-medium w-12">#</th>
                    <th class="px-3 py-2 text-left font-medium w-32">Waktu</th>
                    <th class="px-3 py-2 text-left font-medium w-48">Pengirim</th>
                    <th class="px-3 py-2 text-left font-medium">Pesan</th>
                    <th class="px-3 py-2 text-left font-medium w-24">Status</th>
                    <th class="px-3 py-2 text-left font-medium w-16">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800"></tbody>
        </table>
    </div>
</div>

<!-- Modal Detail -->
<div id="modalDetail" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm hidden hover:opacity-100 transition duration-300">
    <div class="bg-white dark:bg-slate-900 w-full max-w-lg rounded-2xl shadow-2xl border border-slate-100 dark:border-slate-800 overflow-hidden transform scale-95 transition-all" id="modalContent">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">Detail Aduan</h3>
            <button type="button" onclick="closeModal()" class="text-slate-400 hover:text-slate-500 dark:hover:text-slate-300 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
            <!-- Meta Info -->
            <div class="flex items-center justify-between text-xs text-slate-500">
                <span id="d-date"></span>
                <span id="d-status"></span>
            </div>
            
            <!-- Sender -->
            <div class="p-4 bg-slate-50 dark:bg-slate-800/50 rounded-xl space-y-2">
                <div>
                    <span class="block text-xs uppercase text-slate-400 font-bold tracking-wider">Pengirim</span>
                    <span id="d-nama" class="font-semibold text-slate-800 dark:text-slate-200"></span>
                </div>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="block text-xs text-slate-400">Email</span>
                        <span id="d-email" class="text-slate-700 dark:text-slate-300 break-all select-all"></span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-400">WhatsApp</span>
                        <span id="d-wa" class="text-slate-700 dark:text-slate-300 select-all"></span>
                    </div>
                </div>
            </div>

            <!-- Tech Info (IP/UA) -->
            <div class="text-[10px] text-slate-400 flex flex-col gap-1">
                 <div>IP: <span id="d-ip" class="font-mono"></span></div>
                 <div>UA: <span id="d-ua" class="font-mono truncate block" title=""></span></div>
            </div>

            <!-- Pesan -->
            <div>
                <span class="block text-xs uppercase text-slate-400 font-bold tracking-wider mb-2">Isi Pesan</span>
                <div class="p-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50 min-h-[100px]">
                    <p id="d-pesan" class="text-sm text-slate-700 dark:text-slate-300 whitespace-pre-wrap leading-relaxed"></p>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 flex justify-end">
            <button type="button" onclick="closeModal()" class="px-4 py-2 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 rounded-lg text-sm font-medium transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
    // Global Close
    function closeModal() {
        $('#modalDetail').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }

    $(function() {
        // Close on Click Outside
        $('#modalDetail').on('click', function(e) {
             if(e.target === this) closeModal();
        });

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
            { // created_at
                data: 'created_at',
                className: 'px-3 py-2 whitespace-nowrap text-slate-500'
            },
            { // nama (Pengirim)
                data: 'nama',
                className: 'px-3 py-2'
            },
            { // pesan
                data: 'pesan',
                className: 'px-3 py-2'
            },
            { // status
                data: 'status',
                className: 'px-3 py-2 whitespace-nowrap'
            },
            { // action
                data: 'action',
                orderable: false,
                searchable: false,
                className: 'px-3 py-2 whitespace-nowrap'
            }
        ];

        // Init DataTable via Helper
        let table = AppAdmin.initDataTable(
            '#tableAduan',
            baseUrl + '/admin/aduan/datatable',
            columns,
            getCsrf,
            csrfName,
            [[1, 'desc']] // Sort by created_at desc
        );

        // Init Delete Action
        AppAdmin.initDeleteAction(
            '#tableAduan',
            '.btnDelete',
            baseUrl + '/admin/aduan/delete',
            getCsrf,
            setCsrf,
            csrfName,
            table
        );

        // Handle Detail Click (Delegated)
        $('#tableAduan tbody').on('click', '.btnDetail', function() {
            const id = $(this).data('id');
            const url = baseUrl + '/admin/aduan/detail/' + id;

            // Show loading or just fetch
            $.ajax({
                url: url,
                method: 'GET',
                success: function(res) {
                    if(res.status && res.data) {
                        const d = res.data;
                        
                        // Populate
                        $('#d-date').text(new Date(d.created_at).toLocaleString('id-ID'));
                        $('#d-nama').text(d.nama || 'Anonim');
                        $('#d-email').text(d.email || '-');
                        $('#d-wa').text(d.wa || '-');
                        $('#d-pesan').text(d.pesan);
                        
                        // Tech
                        $('#d-ip').text(d.ip_address || '-');
                        $('#d-ua').text(d.user_agent || '-').attr('title', d.user_agent);

                        // Status Badge
                        let badge = '';
                        if(d.status == 'pending') badge = '<span class="px-2 py-1 rounded bg-yellow-100 text-yellow-700">Pending</span>';
                        else if(d.status == 'diproses') badge = '<span class="px-2 py-1 rounded bg-blue-100 text-blue-700">Diproses</span>';
                        else if(d.status == 'selesai') badge = '<span class="px-2 py-1 rounded bg-emerald-100 text-emerald-700">Selesai</span>';
                        else if(d.status == 'spam') badge = '<span class="px-2 py-1 rounded bg-red-100 text-red-700">Spam</span>';
                        $('#d-status').html(badge);

                        // Show Modal
                        $('#modalDetail').removeClass('hidden').addClass('flex');
                        $('body').addClass('overflow-hidden');
                    }
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>
