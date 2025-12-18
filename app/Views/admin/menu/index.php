<?= $this->extend('layout/admin') ?>
<?= $this->section('title') ?>Manajemen Menu<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-base font-semibold text-slate-800 dark:text-slate-100">Manajemen Menu</h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">Atur urutan & sub menu dengan drag & drop.</p>
    </div>
    <button id="btnAdd"
        class="px-3 py-2 rounded-xl bg-primary-700 text-white text-sm hover:bg-primary-800">
        + Tambah Menu
    </button>
</div>

<div class="grid lg:grid-cols-12 gap-3">
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
            if (!empty($n['parent_id']) && isset($byId[$n['parent_id']])) $byId[$n['parent_id']]['children'][] = &$byId[$id];
            else $tree[] = &$byId[$id];
        }
        ?>

        <div class="p-4">
            <ul id="menuRoot" class="space-y-2">
                <?php foreach ($tree as $m): ?>
                    <li class="menu-item rounded-2xl border border-slate-200 dark:border-slate-800"
                        data-id="<?= (int)$m['id'] ?>">
                        <div class="flex items-center justify-between gap-2 p-3">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="cursor-move text-slate-400">≡</span>
                                    <span class="font-medium text-slate-800 dark:text-slate-100">
                                        <?= esc($m['label']) ?>
                                    </span>
                                    <?php if ((int)$m['is_active'] === 0): ?>
                                        <span class="text-[11px] px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500">nonaktif</span>
                                    <?php endif; ?>
                                    <?php if ((int)$m['is_header'] === 1): ?>
                                        <span class="text-[11px] px-2 py-0.5 rounded-full bg-amber-100 text-amber-700 dark:bg-amber-500/10 dark:text-amber-200">header</span>
                                    <?php endif; ?>
                                </div>
                                <div class="text-[11px] text-slate-500 dark:text-slate-400">
                                    url: <?= esc($m['url'] ?? '-') ?> | roles: <?= esc($m['roles'] ?? '-') ?>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <button class="btnToggle text-[11px] px-2.5 py-1 rounded-full border border-slate-200 dark:border-slate-700"
                                    data-id="<?= (int)$m['id'] ?>">Toggle</button>
                                <button class="btnEdit text-[11px] px-2.5 py-1 rounded-full border border-slate-200 dark:border-slate-700"
                                    data-json='<?= esc(json_encode($m), 'attr') ?>'>Edit</button>
                                <button class="btnDel text-[11px] px-2.5 py-1 rounded-full border border-rose-200 text-rose-700 dark:border-rose-500/40 dark:text-rose-200"
                                    data-id="<?= (int)$m['id'] ?>">Hapus</button>
                            </div>
                        </div>

                        <ul class="submenu space-y-2 p-3 pt-0" data-parent-id="<?= (int)$m['id'] ?>">
                            <?php foreach (($m['children'] ?? []) as $ch): ?>
                                <li class="menu-item rounded-xl border border-slate-200 dark:border-slate-800"
                                    data-id="<?= (int)$ch['id'] ?>">
                                    <div class="flex items-center justify-between gap-2 p-2.5">
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2">
                                                <span class="cursor-move text-slate-400">≡</span>
                                                <span class="text-sm text-slate-800 dark:text-slate-100"><?= esc($ch['label']) ?></span>
                                                <?php if ((int)$ch['is_active'] === 0): ?>
                                                    <span class="text-[11px] px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500">nonaktif</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="text-[11px] text-slate-500 dark:text-slate-400">
                                                url: <?= esc($ch['url'] ?? '-') ?>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <button class="btnToggle text-[11px] px-2.5 py-1 rounded-full border border-slate-200 dark:border-slate-700"
                                                data-id="<?= (int)$ch['id'] ?>">Toggle</button>
                                            <button class="btnEdit text-[11px] px-2.5 py-1 rounded-full border border-slate-200 dark:border-slate-700"
                                                data-json='<?= esc(json_encode($ch), 'attr') ?>'>Edit</button>
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

            <div class="mt-3">
                <button id="btnSaveOrder"
                    class="px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-sm hover:bg-slate-50 dark:hover:bg-slate-800">
                    Simpan Urutan
                </button>
            </div>
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
                <input id="label" name="label" class="mt-1 w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm"
                    placeholder="Contoh: Dashboard">
            </div>

            <div>
                <label class="text-xs text-slate-600 dark:text-slate-300">Parent (kosong = menu utama)</label>
                <select id="parent_id" name="parent_id" class="mt-1 w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm">
                    <option value="">- Tanpa parent -</option>
                    <?php foreach ($parents as $p): ?>
                        <option value="<?= (int)$p['id'] ?>"><?= esc($p['label']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-xs text-slate-600 dark:text-slate-300">Header Section?</label>
                    <select id="is_header" name="is_header" class="mt-1 w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm">
                        <option value="0">Tidak</option>
                        <option value="1">Ya (judul/pemisah)</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs text-slate-600 dark:text-slate-300">Aktif</label>
                    <select id="is_active" name="is_active" class="mt-1 w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="text-xs text-slate-600 dark:text-slate-300">URL (route)</label>
                <input id="url" name="url" class="mt-1 w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm"
                    placeholder="admin/dashboard">
                <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">Jika header, URL boleh kosong.</p>
            </div>

            <div>
                <label class="text-xs text-slate-600 dark:text-slate-300">Roles (opsional)</label>
                <input id="roles" name="roles" class="mt-1 w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm"
                    placeholder="admin,desa">
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
<script>
    (() => {
        const baseUrl = "<?= rtrim(base_url(), '/') ?>/";
        const elRoot = document.getElementById('menuRoot');
        const btnSave = document.getElementById('btnSaveOrder');
        const msg = document.getElementById('msg');

        // Sortable untuk menu utama
        new Sortable(elRoot, {
            animation: 150,
            handle: '.cursor-move',
            draggable: '.menu-item',
        });

        // Sortable untuk semua submenu (bisa pindah parent)
        document.querySelectorAll('.submenu').forEach((ul) => {
            new Sortable(ul, {
                group: 'submenu',
                animation: 150,
                handle: '.cursor-move',
                draggable: '.menu-item'
            });
        });

        const collectOrder = () => {
            const items = [];

            // parent
            [...elRoot.children].forEach((li, idx) => {
                const id = Number(li.dataset.id);
                items.push({
                    id,
                    parent_id: null,
                    sort_order: idx + 1
                });

                // children
                const sub = li.querySelector('.submenu');
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

        btnSave?.addEventListener('click', async () => {
            btnSave.disabled = true;
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
                const json = await res.json();
                msg.textContent = json.msg || 'OK';
            } catch (e) {
                msg.textContent = 'Gagal menyimpan urutan.';
            } finally {
                btnSave.disabled = false;
            }
        });

        // Form add/edit
        const frm = document.getElementById('frmMenu');
        const setForm = (data = {}) => {
            frm.id.value = data.id || '';
            frm.label.value = data.label || '';
            frm.parent_id.value = (data.parent_id ?? '') === null ? '' : (data.parent_id ?? '');
            frm.url.value = data.url || '';
            frm.roles.value = data.roles || '';
            frm.is_header.value = String(data.is_header ?? 0);
            frm.is_active.value = String(data.is_active ?? 1);
        };

        document.getElementById('btnAdd')?.addEventListener('click', () => setForm({}));
        document.getElementById('btnReset')?.addEventListener('click', () => setForm({}));

        document.querySelectorAll('.btnEdit').forEach((b) => {
            b.addEventListener('click', () => {
                const data = JSON.parse(b.dataset.json || '{}');
                setForm(data);
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });

        frm.addEventListener('submit', async (e) => {
            e.preventDefault();
            msg.textContent = 'Menyimpan...';

            const formData = new FormData(frm);
            const res = await fetch(baseUrl + 'admin/menu/save', {
                method: 'POST',
                body: formData
            });
            const json = await res.json().catch(() => ({}));

            msg.textContent = json.msg || 'OK';
            if (json.status) location.reload();
        });

        // Toggle / delete
        document.querySelectorAll('.btnToggle').forEach((b) => {
            b.addEventListener('click', async () => {
                const id = b.dataset.id;
                const res = await fetch(baseUrl + 'admin/menu/toggle/' + id, {
                    method: 'POST'
                });
                const json = await res.json().catch(() => ({}));
                msg.textContent = json.msg || 'OK';
                if (json.status) location.reload();
            });
        });

        document.querySelectorAll('.btnDel').forEach((b) => {
            b.addEventListener('click', async () => {
                if (!confirm('Hapus menu ini? Submenu akan ikut terhapus.')) return;
                const id = b.dataset.id;
                const res = await fetch(baseUrl + 'admin/menu/delete/' + id, {
                    method: 'POST'
                });
                const json = await res.json().catch(() => ({}));
                msg.textContent = json.msg || 'OK';
                if (json.status) location.reload();
            });
        });
    })();
</script>

<?= $this->endSection() ?>