<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Data Penduduk
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Data Penduduk
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Kelola data penduduk desa untuk kebutuhan administrasi dan pelayanan.
        </p>
    </div>
    <a href="<?= base_url('admin/data-penduduk/create') ?>"
        class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-primary-600 text-white text-xs md:text-sm font-medium shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:ring-offset-1 focus:ring-offset-slate-50 dark:focus:ring-offset-slate-900">

        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 4.5v15m7.5-7.5h-15" />
        </svg>

        <span>Tambah Penduduk</span>
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-900 dark:border-slate-800">
    <div class="p-3 border-b border-slate-100 dark:border-slate-800">
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Daftar penduduk yang terdaftar di sistem.
        </p>
    </div>

    <!-- FILTER BAR -->
    <div class="px-3 pt-3 pb-1 border-b border-slate-100 dark:border-slate-800">
        <div class="grid gap-2 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">

            <!-- Dusun -->
            <div>
                <label for="filterDusun"
                    class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                    Dusun
                </label>
                <select id="filterDusun"
                    class="w-full rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    <option value="">Semua Dusun</option>
                    <?php foreach (($dusunList ?? []) as $d): ?>
                        <option value="<?= $d['id'] ?>">
                            <?= esc($d['nama_dusun']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Jenis Kelamin -->
            <div>
                <label for="filterJk"
                    class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                    Jenis Kelamin
                </label>
                <select id="filterJk"
                    class="w-full rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    <option value="">Semua</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>

            <!-- Pendidikan -->
            <div>
                <label for="filterPendidikan"
                    class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                    Pendidikan
                </label>
                <select id="filterPendidikan"
                    class="w-full rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    <option value="">Semua</option>
                    <?php foreach (($pendidikan ?? []) as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= esc($p['nama_pendidikan']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Pekerjaan -->
            <div>
                <label for="filterPekerjaan"
                    class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                    Pekerjaan
                </label>
                <select id="filterPekerjaan"
                    class="w-full rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    <option value="">Semua</option>
                    <?php foreach (($pekerjaan ?? []) as $pk): ?>
                        <option value="<?= $pk['id'] ?>"><?= esc($pk['nama_pekerjaan']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Status Penduduk -->
            <div>
                <label for="filterStatusPenduduk"
                    class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                    Status Penduduk
                </label>
                <select id="filterStatusPenduduk"
                    class="w-full rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    <option value="">Semua</option>
                    <option value="Tetap">Tetap</option>
                    <option value="Pendatang">Pendatang</option>
                </select>
            </div>

            <!-- Agama -->
            <div>
                <label for="filterAgama"
                    class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                    Agama
                </label>
                <select id="filterAgama"
                    class="w-full rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    <option value="">Semua</option>
                    <?php foreach (($agamaList ?? []) as $ag): ?>
                        <option value="<?= $ag['id'] ?>">
                            <?= esc($ag['nama_agama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Usia -->
            <div>
                <label class="block text-[11px] font-medium text-slate-600 dark:text-slate-300 mb-1">
                    Usia (tahun)
                </label>
                <div class="flex items-center gap-1.5">
                    <input type="number" id="filterUsiaMin" min="0"
                        class="w-1/2 rounded-xl border border-slate-200 bg-white px-2 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                        placeholder="Min">
                    <input type="number" id="filterUsiaMax" min="0"
                        class="w-1/2 rounded-xl border border-slate-200 bg-white px-2 py-1.5 text-[11px] text-slate-800 focus:outline-none focus:ring-1 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                        placeholder="Max">
                </div>
            </div>

        </div>

        <!-- tombol reset filter -->
        <div class="mt-2 flex justify-end">
            <button type="button" id="btnResetFilter"
                class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-xl border border-slate-200 text-[11px] text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z" clip-rule="evenodd" />
                </svg>
                <span>Reset filter</span>
            </button>
        </div>
    </div>

    <!-- TABLE -->
    <div class="p-3 overflow-x-auto">
        <table id="tablePenduduk" class="min-w-full text-xs md:text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-600 border-b border-slate-100 dark:bg-slate-900/60 dark:text-slate-200 dark:border-slate-800">
                    <th class="px-3 py-2 text-left font-medium">#</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">NIK</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">No. KK</th>
                    <th class="px-3 py-2 text-left font-medium">Nama</th>
                    <th class="px-3 py-2 text-left font-medium">JK</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Dusun / RT</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Usia</th>
                    <th class="px-3 py-2 text-left font-medium">Pekerjaan</th>
                    <th class="px-3 py-2 text-left font-medium">Status</th>
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
        const baseUrl = "<?= rtrim(base_url(), '/') ?>/";
        const csrfName = "<?= csrf_token() ?>";
        let csrfHash = "<?= csrf_hash() ?>";

        const storageKey = 'penduduk_page';

        const $filterDusun = $('#filterDusun');
        const $filterJk = $('#filterJk');
        const $filterPendidikan = $('#filterPendidikan');
        const $filterPekerjaan = $('#filterPekerjaan');
        const $filterStatusPenduduk = $('#filterStatusPenduduk');
        const $filterAgama = $('#filterAgama');
        const $filterUsiaMin = $('#filterUsiaMin');
        const $filterUsiaMax = $('#filterUsiaMax');

        const table = $('#tablePenduduk').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [1, 'asc']
            ],
            ajax: {
                url: baseUrl + 'admin/data-penduduk/datatable',
                type: 'POST',
                data: function(d) {
                    d[csrfName] = csrfHash;

                    d.filter_dusun = $filterDusun.val();
                    d.filter_jk = $filterJk.val();
                    d.filter_pendidikan = $filterPendidikan.val();
                    d.filter_pekerjaan = $filterPekerjaan.val();
                    d.filter_status_penduduk = $filterStatusPenduduk.val();
                    d.filter_agama = $filterAgama.val();
                    d.filter_usia_min = $filterUsiaMin.val();
                    d.filter_usia_max = $filterUsiaMax.val();
                },

                // aktifkan kalau controller mengembalikan newToken
                // dataSrc: function (json) {
                //   if (json.newToken) csrfHash = json.newToken;
                //   return json.data;
                // }
            },

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
                    data: 'nik',
                    className: 'px-3 py-2 text-slate-800 dark:text-slate-100 whitespace-nowrap'
                },
                {
                    data: 'no_kk',
                    render: (d) => d || '-',
                    className: 'px-3 py-2 text-slate-800 dark:text-slate-100 whitespace-nowrap'
                },
                {
                    data: 'nama_lengkap',
                    className: 'px-3 py-2 text-slate-800 dark:text-slate-100'
                },
                {
                    data: 'jenis_kelamin',
                    render: function(d) {
                        if (d === 'L') return '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/40 dark:text-blue-200 dark:border-blue-700">Laki-laki</span>';
                        if (d === 'P') return '<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-pink-50 text-pink-700 border border-pink-200 dark:bg-pink-900/40 dark:text-pink-200 dark:border-pink-700">Perempuan</span>';
                        return '-';
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: null,
                    render: function(row) {
                        const dusun = row.nama_dusun || '-';
                        const rt = row.no_rt ? String(row.no_rt).padStart(3, '0') : '---';
                        return `
              <div class="flex flex-col">
                <span class="text-xs text-slate-800 dark:text-slate-100">${dusun}</span>
                <span class="text-[11px] text-slate-500 dark:text-slate-400">RT ${rt}</span>
              </div>
            `;
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: 'tanggal_lahir',
                    render: function(d) {
                        if (!d) return '-';

                        // aman untuk "YYYY-MM-DD"
                        const birth = new Date(d);
                        if (isNaN(birth)) return '-';

                        const today = new Date();
                        let age = today.getFullYear() - birth.getFullYear();
                        const m = today.getMonth() - birth.getMonth();
                        if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;

                        return age + ' th';
                    },
                    className: 'px-3 py-2 whitespace-nowrap text-xs text-slate-700 dark:text-slate-200'
                },
                {
                    data: 'nama_pekerjaan',
                    render: (d) => d || '-',
                    className: 'px-3 py-2 text-xs text-slate-700 dark:text-slate-200'
                },
                {
                    data: null,
                    render: function(row) {
                        const chips = [];

                        if (row.status_penduduk === 'Tetap') {
                            chips.push('<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-900/40 dark:text-emerald-200 dark:border-emerald-700">Tetap</span>');
                        } else if (row.status_penduduk === 'Pendatang') {
                            chips.push('<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-amber-50 text-amber-700 border border-amber-200 dark:bg-amber-900/40 dark:text-amber-200 dark:border-amber-700">Pendatang</span>');
                        }

                        const sd = row.status_dasar;
                        if (sd === 'Hidup') {
                            chips.push('<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-sky-50 text-sky-700 border border-sky-200 dark:bg-sky-900/40 dark:text-sky-200 dark:border-sky-700">Hidup</span>');
                        } else if (sd === 'Meninggal') {
                            chips.push('<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-rose-50 text-rose-700 border border-rose-200 dark:bg-rose-900/40 dark:text-rose-200 dark:border-rose-700">Meninggal</span>');
                        } else if (sd === 'Pindah') {
                            chips.push('<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-slate-50 text-slate-700 border border-slate-200 dark:bg-slate-800/60 dark:text-slate-200 dark:border-slate-700">Pindah</span>');
                        } else if (sd === 'Hilang') {
                            chips.push('<span class="inline-flex px-2 py-0.5 rounded-full text-[11px] bg-orange-50 text-orange-700 border border-orange-200 dark:bg-orange-900/40 dark:text-orange-200 dark:border-orange-700">Hilang</span>');
                        }

                        return `<div class="flex flex-wrap gap-1">${chips.join('')}</div>`;
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(row) {
                        const detailUrl = baseUrl + 'admin/data-penduduk/detail/' + row.id;
                        const editUrl = baseUrl + 'admin/data-penduduk/edit/' + row.id;

                        return `
              <div class="flex items-center gap-1.5">
                <a href="${detailUrl}" class="js-keep-page inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-slate-200 bg-white text-[11px] font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-1 focus:ring-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100 dark:hover:bg-slate-800" title="Detail">
                  <!-- icon detail tetap -->
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                    <path d="M8 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                    <path fill-rule="evenodd" d="M4.5 2A1.5 1.5 0 0 0 3 3.5v13A1.5 1.5 0 0 0 4.5 18h11a1.5 1.5 0 0 0 1.5-1.5V7.621a1.5 1.5 0 0 0-.44-1.06l-4.12-4.122A1.5 1.5 0 0 0 11.378 2H4.5Zm5 5a3 3 0 1 0 1.524 5.585l1.196 1.195a.75.75 0 1 0 1.06-1.06l-1.195-1.196A3 3 0 0 0 9.5 7Z" clip-rule="evenodd" />
                  </svg>
                  <span>Detail</span>
                </a>

                <a href="${editUrl}" class="js-keep-page inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-sky-200 bg-sky-50 text-[11px] font-medium text-sky-700 hover:bg-sky-100 focus:outline-none focus:ring-1 focus:ring-sky-400/70 dark:border-sky-500/40 dark:bg-sky-500/10 dark:text-sky-200 dark:hover:bg-sky-500/20" title="Edit">
                  <!-- icon edit tetap -->
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687 1.688a1.875 1.875 0 0 1 0 2.652L8.21 19.167A4.5 4.5 0 0 1 6.678 20l-2.135.534A.75.75 0 0 1 4 19.808l.534-2.135a4.5 4.5 0 0 1 1.334-2.531l10.338-10.338a1.875 1.875 0 0 1 2.652 0z" />
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
                    if (!isNaN(pageNum)) {
                        api.page(pageNum).draw(false);
                    }
                }
            }
        });

        // simpan page sebelum ke Detail/Edit
        $('#tablePenduduk').on('click', '.js-keep-page', function() {
            localStorage.setItem(storageKey, table.page()); // index 0-based
        });

        // helper: setiap filter berubah, balik ke page 0 + hapus page tersimpan
        function redrawFromFirstPage() {
            localStorage.removeItem(storageKey);
            table.page(0).draw(false);
        }

        // filter change
        $($filterDusun.add($filterJk).add($filterPendidikan).add($filterPekerjaan).add($filterStatusPenduduk).add($filterAgama))
            .on('change', redrawFromFirstPage);

        // filter usia (ketik)
        $filterUsiaMin.add($filterUsiaMax).on('keyup change', redrawFromFirstPage);

        // reset filter
        $('#btnResetFilter').on('click', function() {
            // kalau pakai select2, ini penting
            $filterDusun.val('').trigger('change');
            $filterJk.val('').trigger('change');
            $filterPendidikan.val('').trigger('change');
            $filterPekerjaan.val('').trigger('change');
            $filterStatusPenduduk.val('').trigger('change');
            $filterAgama.val('').trigger('change');

            $filterUsiaMin.val('');
            $filterUsiaMax.val('');

            redrawFromFirstPage();
        });

        // delete (punyamu sudah oke)
        $('#tablePenduduk').on('click', '.btnDelete', function() {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Hapus data penduduk?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#e11d48'
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: baseUrl + 'admin/data-penduduk/delete',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id,
                        [csrfName]: csrfHash
                    },
                    success: function(res) {
                        if (res.newToken) csrfHash = res.newToken;

                        if (res.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: res.message || 'Data penduduk berhasil dihapus',
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