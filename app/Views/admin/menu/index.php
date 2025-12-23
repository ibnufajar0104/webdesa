<?= $this->extend('layout/admin') ?>
<?= $this->section('title') ?>Manajemen Menu<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-base font-semibold text-slate-800 dark:text-slate-100">Manajemen Menu</h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">Atur urutan & sub menu dengan drag & drop.</p>
    </div>
    <!-- <button id="btnAdd" class="px-3 py-2 rounded-xl bg-primary-700 text-white text-sm hover:bg-primary-800">
        + Tambah Menu
    </button> -->
</div>

<div class="grid lg:grid-cols-12 gap-3">
    <!-- Tree -->
    <div class="lg:col-span-7 rounded-2xl border border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
        <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800">
            <div class="text-sm font-semibold text-slate-800 dark:text-slate-100">Struktur Menu</div>
            <div class="text-xs text-slate-500 dark:text-slate-400">Drag untuk mengubah urutan / pindah submenu.</div>
        </div>

        <?php
        // bentuk tree sederhana dari $menus
        $byId = [];
        foreach ($menus as $m) {
            $m['children'] = [];
            $byId[$m['id']] = $m;
        }
        $tree = [];
        foreach ($byId as $id => $n) {
            // lebih aman daripada empty() biar "0" gak dianggap kosong
            if ($n['parent_id'] !== null && $n['parent_id'] !== '' && isset($byId[$n['parent_id']])) {
                $byId[$n['parent_id']]['children'][] = &$byId[$id];
            } else {
                $tree[] = &$byId[$id];
            }
        }
        ?>

        <div class="p-4">
            <ul id="menuRoot" class="space-y-2">
                <?php foreach ($tree as $m): ?>
                    <li class="menu-item rounded-2xl border border-slate-200 dark:border-slate-800" data-id="<?= (int)$m['id'] ?>">
                        <div class="flex items-center justify-between gap-2 p-3">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="cursor-move text-slate-400">≡</span>
                                    <span class="font-medium text-slate-800 dark:text-slate-100"><?= esc($m['label']) ?></span>
                                    <?php if ((int)($m['is_active'] ?? 1) === 0): ?>
                                        <span class="text-[11px] px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500">nonaktif</span>
                                    <?php endif; ?>
                                </div>

                                <div class="text-[11px] text-slate-500 dark:text-slate-400">
                                    url: <?= esc($m['url'] ?? '-') ?>
                                    <?php if (!empty($m['target'])): ?>
                                        | buka: <?= $m['target'] === '_blank' ? 'tab baru' : 'tab yang sama' ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <select class="selActive text-[11px] px-2.5 py-1 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900"
                                    data-id="<?= (int)$m['id'] ?>">
                                    <option value="1" <?= ((int)($m['is_active'] ?? 1) === 1) ? 'selected' : '' ?>>Aktif</option>
                                    <option value="0" <?= ((int)($m['is_active'] ?? 1) === 0) ? 'selected' : '' ?>>Nonaktif</option>
                                </select>

                                <!-- EDIT: pakai data-id, bukan data-json -->
                                <button class="btnEdit text-[11px] px-2.5 py-1 rounded-full border border-slate-200 dark:border-slate-700"
                                    data-id="<?= (int)$m['id'] ?>">Edit</button>

                                <button class="btnDel text-[11px] px-2.5 py-1 rounded-full border border-rose-200 text-rose-700 dark:border-rose-500/40 dark:text-rose-200"
                                    data-id="<?= (int)$m['id'] ?>">Hapus</button>
                            </div>
                        </div>

                        <ul class="submenu space-y-2 p-3 pt-0" data-parent-id="<?= (int)$m['id'] ?>">
                            <?php foreach (($m['children'] ?? []) as $ch): ?>
                                <li class="menu-item rounded-xl border border-slate-200 dark:border-slate-800" data-id="<?= (int)$ch['id'] ?>">
                                    <div class="flex items-center justify-between gap-2 p-2.5">
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2">
                                                <span class="cursor-move text-slate-400">≡</span>
                                                <span class="text-sm text-slate-800 dark:text-slate-100"><?= esc($ch['label']) ?></span>
                                                <?php if ((int)($ch['is_active'] ?? 1) === 0): ?>
                                                    <span class="text-[11px] px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500">nonaktif</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="text-[11px] text-slate-500 dark:text-slate-400">
                                                url: <?= esc($ch['url'] ?? '-') ?>
                                                <?php if (!empty($ch['target'])): ?>
                                                    | buka: <?= $ch['target'] === '_blank' ? 'tab baru' : 'tab yang sama' ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <select class="selActive text-[11px] px-2.5 py-1 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900"
                                                data-id="<?= (int)$ch['id'] ?>">
                                                <option value="1" <?= ((int)($ch['is_active'] ?? 1) === 1) ? 'selected' : '' ?>>Aktif</option>
                                                <option value="0" <?= ((int)($ch['is_active'] ?? 1) === 0) ? 'selected' : '' ?>>Nonaktif</option>
                                            </select>

                                            <!-- EDIT: pakai data-id -->
                                            <button class="btnEdit text-[11px] px-2.5 py-1 rounded-full border border-slate-200 dark:border-slate-700"
                                                data-id="<?= (int)$ch['id'] ?>">Edit</button>

                                            <button class="btnDel text-[11px] px-2.5 py-1 rounded-full border border-rose-200 text-rose-700 dark:border-rose-500/40 dark:text-rose-200"
                                                data-id="<?= (int)$ch['id'] ?>">Hapus</button>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <!-- Form -->
    <div class="lg:col-span-5 rounded-2xl border border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
        <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800">
            <div class="text-sm font-semibold text-slate-800 dark:text-slate-100">Tambah / Edit</div>
            <div class="text-xs text-slate-500 dark:text-slate-400">Isi data menu & simpan.</div>
        </div>

        <form id="frmMenu" class="p-4 space-y-3">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="id">

            <div>
                <label class="text-xs text-slate-600 dark:text-slate-300">Label</label>
                <input id="label" name="label"
                    class="mt-1 w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm"
                    placeholder="Contoh: Dashboard">
            </div>

            <div>
                <label class="text-xs text-slate-600 dark:text-slate-300">Parent (kosong = menu utama)</label>
                <select id="parent_id" name="parent_id"
                    class="mt-1 w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm">
                    <option value="">- Tanpa parent -</option>
                    <?php foreach ($parents as $p): ?>
                        <option value="<?= (int)$p['id'] ?>"><?= esc($p['label']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-xs text-slate-600 dark:text-slate-300">Aktif</label>
                    <select id="is_active" name="is_active"
                        class="mt-1 w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>

                <div>
                    <label class="text-xs text-slate-600 dark:text-slate-300">Buka di</label>
                    <select id="target" name="target"
                        class="mt-1 w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm">
                        <option value="_self">Tab yang sama</option>
                        <option value="_blank">Tab baru</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="text-xs text-slate-600 dark:text-slate-300">URL (route)</label>
                <input id="url" name="url"
                    class="mt-1 w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm"
                    placeholder="admin/dashboard">
                <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">Jika menu tidak punya halaman, URL boleh kosong.</p>
            </div>

            <div class="flex items-center gap-2">
                <button class="px-3 py-2 rounded-xl bg-primary-700 text-white text-sm hover:bg-primary-800" type="submit">
                    Simpan
                </button>
                <button id="btnReset" type="button"
                    class="px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-sm hover:bg-slate-50 dark:hover:bg-slate-800">
                    Reset
                </button>
            </div>

            <div id="msg" class="text-xs text-slate-500 dark:text-slate-400"></div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.3/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    (() => {
        const baseUrl = "<?= rtrim(base_url(), '/') ?>/";
        const elRoot = document.getElementById('menuRoot');
        const frm = document.getElementById('frmMenu');

        /* =========================
           SWEETALERT HELPERS
        ========================= */
        const toastSuccess = (text = 'Berhasil') => Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text,
            timer: 1800,
            showConfirmButton: false
        });

        const toastError = (text = 'Terjadi kesalahan') => Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text
        });

        const showLoading = (text = 'Memproses...') => Swal.fire({
            title: text,
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => Swal.showLoading()
        });

        const safeJson = async (res) => {
            try {
                return await res.json();
            } catch {
                return {};
            }
        };

        /* =========================
           REALTIME SAVE ORDER
        ========================= */
        let saveTimer = null;
        let saving = false;
        let pending = false;

        const collectOrder = () => {
            const items = [];

            [...elRoot.children].forEach((li, idx) => {
                const id = Number(li.dataset.id);
                items.push({
                    id,
                    parent_id: null,
                    sort_order: idx + 1
                });

                const sub = li.querySelector(':scope > .submenu');
                if (sub) {
                    [...sub.children].forEach((cli, cidx) => {
                        items.push({
                            id: Number(cli.dataset.id),
                            parent_id: id,
                            sort_order: cidx + 1
                        });
                    });
                }
            });

            return items;
        };

        const postReorder = async () => {
            if (saving) {
                pending = true;
                return;
            }
            saving = true;
            pending = false;

            try {
                const res = await fetch(baseUrl + 'admin/menu/reorder', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        items: collectOrder()
                    })
                });
                const json = await safeJson(res);

                if (!res.ok || json.status === false) toastError(json.msg || 'Gagal menyimpan urutan.');
                else toastSuccess(json.msg || 'Urutan tersimpan.');
            } catch (e) {
                toastError('Gagal menyimpan urutan.');
            } finally {
                saving = false;
                if (pending) postReorder();
            }
        };

        const saveOrderRealtime = (delay = 250) => {
            clearTimeout(saveTimer);
            saveTimer = setTimeout(postReorder, delay);
        };

        /* =========================
           DROP -> SUBMENU
        ========================= */
        let hoverParentEl = null;

        const ensureSubmenu = (parentLi) => {
            let ul = parentLi.querySelector(':scope > .submenu');
            if (!ul) {
                ul = document.createElement('ul');
                ul.className = 'submenu space-y-2 p-3 pt-0';
                ul.dataset.parentId = parentLi.dataset.id;
                parentLi.appendChild(ul);
                makeSortable(ul);
            }
            return ul;
        };

        const computeHoverParent = (evt) => {
            hoverParentEl = null;
            const oe = evt.originalEvent;
            if (!oe || typeof oe.clientX !== 'number') return;

            const related = evt.related;
            if (!related) return;

            const li = related.classList?.contains('menu-item') ? related : related.closest?.('.menu-item');
            if (!li) return;
            if (evt.dragged && evt.dragged === li) return;

            const rect = li.getBoundingClientRect();
            const threshold = rect.left + 40;
            if (oe.clientX > threshold) hoverParentEl = li;
        };

        /* =========================
           SORTABLE INIT
        ========================= */
        const makeSortable = (ul) => new Sortable(ul, {
            group: 'menuTree',
            animation: 150,
            handle: '.cursor-move',
            draggable: '.menu-item',
            onMove: (evt) => {
                computeHoverParent(evt);
                return true;
            },
            onEnd: (evt) => {
                if (hoverParentEl) {
                    const draggedEl = evt.item;
                    const sub = ensureSubmenu(hoverParentEl);
                    sub.appendChild(draggedEl);
                }
                hoverParentEl = null;
                saveOrderRealtime();
            },
            onAdd: () => saveOrderRealtime(),
            onUpdate: () => saveOrderRealtime(),
        });

        makeSortable(elRoot);
        document.querySelectorAll('.submenu').forEach(makeSortable);

        /* =========================
           FORM SETTER
        ========================= */
        const setForm = (data = {}) => {
            frm.id.value = data.id || '';
            frm.label.value = data.label || '';
            frm.parent_id.value = (data.parent_id ?? '') === null ? '' : (data.parent_id ?? '');
            frm.url.value = data.url || '';
            frm.is_active.value = String(data.is_active ?? 1);
            frm.target.value = String(data.target ?? '_self');
        };

        document.getElementById('btnAdd')?.addEventListener('click', () => setForm({}));
        document.getElementById('btnReset')?.addEventListener('click', () => setForm({}));

        /* =========================
           EDIT (FETCH LATEST)
        ========================= */
        document.querySelectorAll('.btnEdit').forEach((b) => {
            b.addEventListener('click', async () => {
                const id = Number(b.dataset.id || 0);
                if (!id) return;

                if (saving) {
                    toastError('Sedang menyimpan urutan… klik Edit lagi sebentar.');
                    return;
                }

                showLoading('Mengambil data...');
                try {
                    const res = await fetch(baseUrl + 'admin/menu/' + id, {
                        method: 'GET'
                    });
                    const json = await safeJson(res);
                    Swal.close();

                    if (!res.ok || json.status === false) {
                        toastError(json.msg || 'Gagal mengambil data menu.');
                        return;
                    }

                    const data = json.data || {};

                    // fallback DOM (kalau server return parent_id null tapi ini submenu)
                    if (data.parent_id === null || data.parent_id === '' || data.parent_id === undefined) {
                        const sub = b.closest('ul.submenu');
                        if (sub?.dataset?.parentId) data.parent_id = Number(sub.dataset.parentId);
                    }

                    setForm(data);
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                } catch (e) {
                    Swal.close();
                    toastError('Terjadi kesalahan saat mengambil data.');
                }
            });
        });

        /* =========================
           SAVE (CREATE/UPDATE)
        ========================= */
        frm?.addEventListener('submit', async (e) => {
            e.preventDefault();

            showLoading('Menyimpan...');
            try {
                const formData = new FormData(frm);
                const res = await fetch(baseUrl + 'admin/menu/save', {
                    method: 'POST',
                    body: formData
                });
                const json = await safeJson(res);

                Swal.close();

                if (!res.ok || json.status === false) {
                    toastError(json.msg || 'Gagal menyimpan menu.');
                    return;
                }

                toastSuccess(json.msg || 'Menu tersimpan.');
                location.reload();
            } catch (e2) {
                Swal.close();
                toastError('Terjadi kesalahan saat menyimpan.');
            }
        });

        /* =========================
           SET ACTIVE
        ========================= */
        document.querySelectorAll('.selActive').forEach((sel) => {
            sel.addEventListener('change', async () => {
                const id = sel.dataset.id;
                const val = sel.value;

                try {
                    const res = await fetch(baseUrl + 'admin/menu/set-active/' + id, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            is_active: Number(val)
                        })
                    });
                    const json = await safeJson(res);

                    if (!res.ok || json.status === false) {
                        toastError(json.msg || 'Gagal mengubah status.');
                        return;
                    }

                    toastSuccess(json.msg || 'Status diperbarui.');
                    location.reload();
                } catch (e) {
                    toastError('Terjadi kesalahan saat mengubah status.');
                }
            });
        });

        /* =========================
           DELETE
        ========================= */
        document.querySelectorAll('.btnDel').forEach((b) => {
            b.addEventListener('click', async () => {
                const id = b.dataset.id;

                Swal.fire({
                    title: 'Hapus menu?',
                    text: 'Data yang dihapus tidak dapat dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#e11d48'
                }).then(async (result) => {
                    if (!result.isConfirmed) return;

                    try {
                        const res = await fetch(baseUrl + 'admin/menu/delete/' + id, {
                            method: 'POST'
                        });
                        const json = await safeJson(res);

                        if (!res.ok || json.status === false) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: json.msg || 'Gagal menghapus'
                            });
                            return;
                        }

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: json.msg || 'Berhasil',
                            timer: 1800,
                            showConfirmButton: false
                        });
                        setTimeout(() => location.reload(), 900);
                    } catch (e) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat menghapus data'
                        });
                    }
                });
            });
        });
    })();
</script>

<?= $this->endSection() ?>