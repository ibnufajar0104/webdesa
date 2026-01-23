/**
 * Admin Helper JS
 * Berisi fungsi-fungsi reusable untuk halaman admin
 */

const AppAdmin = {
    /**
     * Initialize DataTable with server-side processing
     * 
     * @param {string} selector Selector ID tabel (mysal '#myTable')
     * @param {string} url Endpoint URL untuk datatable
     * @param {array} columns Definisi kolom Datatable
     * @param {function} csrfGetter Function yang return CSRF hash saat ini
     * @param {string} csrfName Nama token CSRF
     * @param {array} order Default sorting, contoh [[0, 'asc']]
     * @returns {object} DataTable instance
     */
    initDataTable: function (selector, url, columns, csrfGetter, csrfName, order = []) {
        // PRE-PROCESS: Handle Special Render Types
        columns = columns.map(col => {
            if (col.render === 'INDEX') {
                col.render = function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                };
            }
            return col;
        });

        return $(selector).DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: url,
                type: 'POST',
                data: function (d) {
                    d[csrfName] = csrfGetter();
                }
            },
            order: order,
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
            columns: columns
        });
    },

    /**
     * Setup Delete Action dengan SweetAlert2
     * 
     * @param {string} selector Selector parent element (misal '#myTable')
     * @param {string} btnSelector Selector tombol delete (misal '.btnDelete')
     * @param {string} url Endpoint URL untuk delete
     * @param {function} csrfGetter Function yang return CSRF hash saat ini
     * @param {function} csrfSetter Function untuk update CSRF hash baru
     * @param {string} csrfName Nama token CSRF
     * @param {object} tableInstance Instance DataTable untuk reload (opsional)
     */
    initDeleteAction: function (selector, btnSelector, url, csrfGetter, csrfSetter, csrfName, tableInstance) {
        $(selector).on('click', btnSelector, function () {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Hapus data?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#e11d48'
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        [csrfName]: csrfGetter()
                    },
                    success: function (res) {
                        if (res.newToken) {
                            csrfSetter(res.newToken);
                        }

                        if (res.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: res.message || 'Data berhasil dihapus',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            if (tableInstance) {
                                tableInstance.ajax.reload(null, false);
                            } else {
                                location.reload();
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: res.message || 'Gagal menghapus data'
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat menghapus data'
                        });
                    }
                });
            });
        });
    },

    /**
     * Render Status Badge
     * @param {string} data status ('active' or others)
     * @returns {string} HTML badge
     */
    renderStatus: function (data) {
        let color = data === 'active' ?
            'bg-emerald-100 text-emerald-700 border-emerald-200 dark:bg-emerald-900/40 dark:text-emerald-200 dark:border-emerald-700' :
            'bg-slate-100 text-slate-600 border-slate-200 dark:bg-slate-800/60 dark:text-slate-200 dark:border-slate-700';
        let label = data === 'active' ? 'Aktif' : 'Nonaktif';
        return `<span class="inline-flex px-2 py-0.5 rounded-full border text-[11px] ${color}">${label}</span>`;
    },

    /**
     * Render Edit Button
     * @param {string} url Edit URL
     * @returns {string} HTML button
     */
    btnEdit: function (url) {
        return `
            <a href="${url}"
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
            </a>`;
    },

    /**
     * Render Delete Button
     * @param {string|number} id Item ID
     * @returns {string} HTML button
     */
    btnDelete: function (id) {
        return `
            <button type="button"
                class="btnDelete inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-rose-200 bg-rose-50 text-[11px] font-medium text-rose-700 hover:bg-rose-100 focus:outline-none focus:ring-1 focus:ring-rose-400/70 dark:border-rose-500/40 dark:bg-rose-500/10 dark:text-rose-200 dark:hover:bg-rose-500/20"
                data-id="${id}" title="Hapus">
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
            </button>`;
    }
};
