<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Jam Pelayanan
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
            Jam Pelayanan
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Kelola jadwal pelayanan kantor desa yang tampil di website.
        </p>
    </div>

    <button type="button" id="btnAdd"
        class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-primary-600 text-white text-xs md:text-sm font-medium shadow-sm hover:bg-primary-700">
        <span>Tambah Jam</span>
    </button>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-900 dark:border-slate-800">
    <div class="p-3 border-b border-slate-100 dark:border-slate-800">
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Daftar jam pelayanan.
        </p>
    </div>

    <div class="p-3 overflow-x-auto">
        <table id="tableJam" class="min-w-full text-xs md:text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-600 border-b border-slate-100 dark:bg-slate-900/60 dark:text-slate-200 dark:border-slate-800">
                    <th class="px-3 py-2 text-left font-medium">#</th>
                    <th class="px-3 py-2 text-left font-medium">Hari</th>
                    <th class="px-3 py-2 text-left font-medium">Mulai</th>
                    <th class="px-3 py-2 text-left font-medium">Selesai</th>
                    <th class="px-3 py-2 text-left font-medium">Status</th>
                    <th class="px-3 py-2 text-left font-medium whitespace-nowrap">Diperbarui</th>
                    <th class="px-3 py-2 text-left font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800"></tbody>
        </table>
    </div>
</div>

<!-- MODAL -->
<div id="modalJam" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-slate-900/50"></div>

    <div class="relative mx-auto mt-10 w-[92%] max-w-xl">
        <div class="rounded-2xl bg-white shadow-xl border border-slate-200 dark:bg-slate-900 dark:border-slate-700 overflow-hidden">
            <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <div>
                    <div class="text-sm font-semibold text-slate-800 dark:text-slate-100" id="modalTitle">Tambah Jam Pelayanan</div>
                    <div class="text-xs text-slate-500 dark:text-slate-400">Isi data lalu simpan.</div>
                </div>
                <button type="button" id="btnCloseModal"
                    class="px-2 py-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300">
                    ✕
                </button>
            </div>

            <form id="formJam" class="px-4 py-4 space-y-3">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="id">

                <div id="errBox" class="hidden rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs text-red-700 dark:border-red-500/40 dark:bg-red-500/10 dark:text-red-100"></div>

                <div class="space-y-1.5">
                    <label class="text-xs font-medium">Hari Pelayanan <span class="text-rose-500">*</span></label>
                    <input type="text" name="hari" id="hari"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary-500/60
                               dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                        placeholder="Contoh: Senin - Jumat">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="space-y-1.5">
                        <label class="text-xs font-medium">Jam Mulai</label>
                        <input type="text" name="jam_mulai" id="jam_mulai"
                            class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                                   dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                            placeholder="08:00 WITA">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-medium">Jam Selesai</label>
                        <input type="text" name="jam_selesai" id="jam_selesai"
                            class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                                   dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                            placeholder="15:00 WITA">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-medium">Keterangan (Opsional)</label>
                    <textarea name="keterangan" id="keterangan" rows="3"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm
                               dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                        placeholder="Contoh: Istirahat 12:00 - 13:00 WITA"></textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-medium">Status Tampil</label>
                    <select name="is_active" id="is_active"
                        class="w-full sm:w-52 rounded-xl border border-slate-200 px-3 py-2 text-sm
                               dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                        <option value="1">Tampilkan</option>
                        <option value="0">Sembunyikan</option>
                    </select>
                </div>

                <div class="pt-2 flex items-center justify-end gap-2 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" id="btnCancel"
                        class="inline-flex items-center px-3 py-1.5 rounded-xl border border-rose-500 text-rose-600 text-xs md:text-sm
                               bg-white hover:bg-rose-50 dark:bg-slate-900 dark:border-rose-400 dark:text-rose-300">
                        Batal
                    </button>

                    <button type="submit"
                        class="inline-flex items-center px-3 py-1.5 rounded-xl border border-primary-500 text-primary-600 text-xs md:text-sm
                               bg-white hover:bg-primary-50 dark:bg-slate-900 dark:border-primary-400 dark:text-primary-200">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() {
        const baseUrl = "<?= base_url() ?>";
        const csrfName = "<?= csrf_token() ?>";
        let csrfHash = "<?= csrf_hash() ?>";

        const $modal = $('#modalJam');
        const $form = $('#formJam');
        const $err = $('#errBox');

        function openModal(mode, row = null) {
            $err.addClass('hidden').html('');
            if (mode === 'create') {
                $('#modalTitle').text('Tambah Jam Pelayanan');
                $form[0].reset();
                $('#id').val('');
                $('#is_active').val('1');
            } else {
                $('#modalTitle').text('Edit Jam Pelayanan');
                $('#id').val(row.id);
                $('#hari').val(row.hari || '');
                $('#jam_mulai').val(row.jam_mulai || '');
                $('#jam_selesai').val(row.jam_selesai || '');
                $('#keterangan').val(row.keterangan || '');
                $('#is_active').val(String(row.is_active ?? 1));
            }
            $modal.removeClass('hidden');
        }

        function closeModal() {
            $modal.addClass('hidden');
        }

        $('#btnAdd').on('click', () => openModal('create'));
        $('#btnCloseModal, #btnCancel').on('click', closeModal);
        $modal.on('click', function(e) {
            if (e.target === this) closeModal();
        });

        const table = $('#tableJam').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: baseUrl + '/admin/jam-pelayanan/datatable',
                type: 'POST',
                data: function(d) {
                    d[csrfName] = csrfHash;
                }
            },
            order: [
                [5, 'desc']
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
                    data: 'hari',
                    className: 'px-3 py-2'
                },
                {
                    data: 'jam_mulai',
                    render: v => v ? v : '-',
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: 'jam_selesai',
                    render: v => v ? v : '-',
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: 'is_active',
                    render: function(val) {
                        const isOn = Number(val) === 1;
                        const color = isOn ?
                            'bg-emerald-100 text-emerald-700 border-emerald-200 dark:bg-emerald-900/40 dark:text-emerald-200 dark:border-emerald-700' :
                            'bg-slate-100 text-slate-600 border-slate-200 dark:bg-slate-800/60 dark:text-slate-200 dark:border-slate-700';
                        return `<span class="inline-flex px-2 py-0.5 rounded-full border text-[11px] ${color}">${isOn ? 'Tampil' : 'Sembunyi'}</span>`;
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                },
                {
                    data: 'updated_at',
                    render: v => v ? v : '-',
                    className: 'px-3 py-2 whitespace-nowrap text-xs text-slate-500 dark:text-slate-400'
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(row) {
                        const encoded = encodeURIComponent(JSON.stringify(row));
                        return `
                            <div class="flex items-center gap-1.5">
                                <button type="button" class="btnEdit inline-flex items-center px-2.5 py-1 rounded-full border border-sky-200 bg-sky-50 text-[11px] font-medium text-sky-700 hover:bg-sky-100 dark:border-sky-500/40 dark:bg-sky-500/10 dark:text-sky-200"
                                    data-row="${encoded}">Edit</button>

                                <button type="button" class="btnDelete inline-flex items-center px-2.5 py-1 rounded-full border border-rose-200 bg-rose-50 text-[11px] font-medium text-rose-700 hover:bg-rose-100 dark:border-rose-500/40 dark:bg-rose-500/10 dark:text-rose-200"
                                    data-id="${row.id}">Hapus</button>
                            </div>
                        `;
                    },
                    className: 'px-3 py-2 whitespace-nowrap'
                }
            ]
        });

        $('#tableJam').on('click', '.btnEdit', function() {
            const row = JSON.parse(decodeURIComponent($(this).data('row')));
            openModal('edit', row);
        });

        $form.on('submit', function(e) {
            e.preventDefault();
            $err.addClass('hidden').html('');

            const formData = $(this).serializeArray();
            formData.push({
                name: csrfName,
                value: csrfHash
            });

            $.ajax({
                url: baseUrl + '/admin/jam-pelayanan/save',
                type: 'POST',
                dataType: 'json',
                data: $.param(formData),
                success: function(res) {
                    if (res && res.errors) {
                        let html = '<ul class="list-disc list-inside space-y-0.5">';
                        Object.values(res.errors).forEach(e => html += `<li>${e}</li>`);
                        html += '</ul>';
                        $err.removeClass('hidden').html(html);
                        return;
                    }

                    if (res.status) {
                        closeModal();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message || 'Tersimpan',
                            timer: 1800,
                            showConfirmButton: false
                        });
                        table.ajax.reload(null, false);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: res.message || 'Gagal menyimpan'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat menyimpan data'
                    });
                }
            });
        });

        $('#tableJam').on('click', '.btnDelete', function() {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Hapus jam pelayanan?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#e11d48'
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: baseUrl + '/admin/jam-pelayanan/delete',
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
                                text: res.message || 'Terhapus',
                                timer: 1800,
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