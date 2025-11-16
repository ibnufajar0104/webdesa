<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
<?= esc($pageTitle ?? 'Halaman') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>



<div class="w-full max-w-full">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h2 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
                <?= esc($pageTitle ?? 'Halaman') ?>
            </h2>
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Kelola konten halaman statis untuk ditampilkan di website desa.
            </p>
        </div>
        <a href="<?= base_url('admin/halaman-statis') ?>"
            class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl border 
                        border-blue-500 text-blue-600 text-xs md:text-sm
                        hover:bg-blue-50 active:bg-blue-100
                        dark:border-blue-400 dark:text-blue-300 dark:hover:bg-blue-900/30">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>


    </div>

    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">
        <div class="border-b border-slate-100 px-4 py-3 dark:border-slate-800">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                Form Halaman Statis
            </h3>
        </div>

        <div class="px-4 py-4 md:px-5 md:py-5 space-y-3">

            <?php if (!empty($errors)): ?>
                <div class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs text-red-700 dark:border-red-500/40 dark:bg-red-500/10 dark:text-red-100">
                    <ul class="list-disc list-inside space-y-0.5">
                        <?php foreach ($errors as $err): ?>
                            <li><?= esc($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/halaman-statis/save') ?>" method="post" class="space-y-3">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($page['id'] ?? '') ?>">

                <div>
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="title">
                        Judul Halaman
                    </label>
                    <input type="text" name="title" id="title"
                        value="<?= esc($page['title'] ?? '') ?>"
                        class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
                        placeholder="Misal: Profil Desa" required>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="status">
                        Status
                    </label>
                    <select name="status" id="status"
                        class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        <option value="published" <?= ($page['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
                        <option value="draft" <?= ($page['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1" for="content">
                        Konten Halaman
                    </label>
                    <textarea name="content" id="content" rows="12"
                        class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs md:text-sm text-slate-800 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"><?= esc($page['content'] ?? '') ?></textarea>

                </div>

                <div class="pt-3 mt-2 flex flex-col gap-2 border-t border-slate-100 
                                md:flex-row md:items-center md:justify-end dark:border-slate-800">

                    <!-- Batal: Outline Merah -->
                    <a href="<?= base_url('admin/halaman-statis') ?>"
                        class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl border
                            border-red-500 text-red-600 text-xs md:text-sm
                            hover:bg-red-50 active:bg-red-100
                            dark:border-red-400 dark:text-red-300 dark:hover:bg-red-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </a>

                    <!-- Simpan: Solid Biru -->
                    <button type="submit"
                        class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl 
                            bg-primary-600 text-white text-xs md:text-sm font-medium 
                            hover:bg-primary-700 focus:outline-none focus:ring-2 
                            focus:ring-primary-500/70 focus:ring-offset-1 
                            focus:ring-offset-white dark:focus:ring-offset-slate-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>

<script>
    (function() {
        const csrfName = "<?= csrf_token() ?>";
        const csrfHash = "<?= csrf_hash() ?>";
        const uploadUrl = "<?= base_url('admin/halaman-statis/upload-image') ?>";


        tinymce.init({
            selector: '#content',
            menubar: false,
            branding: false,
            height: 480,
            plugins: 'link lists table image code',
            toolbar: 'undo redo | styles | bold italic underline | ' +
                'alignleft aligncenter alignright | bullist numlist | ' +
                'link image | table | code',

            // path jangan diutak-atik
            convert_urls: false,
            relative_urls: false,
            remove_script_host: false,

            // gambar responsif
            content_style: "img {max-width: 100%; height: auto;}",

            // Hanya izinkan atribut aman (tanpa width & height)
            valid_elements: '' +
                'p,br,strong/b,em/i,span,ul,ol,li,' +
                'a[href|target=_blank|rel],' +
                'img[src|alt|title|class],' +
                'table,tr,td,th,tbody,thead,' +
                'h1,h2,h3,h4,h5,h6',

            image_dimensions: false, // sembunyikan field width/height di dialog

            automatic_uploads: true,
            images_upload_handler: function(blobInfo, progress) {
                return new Promise(function(resolve, reject) {
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', uploadUrl);
                    xhr.responseType = 'json';

                    // update progress bar di Tiny kalau mau
                    xhr.upload.onprogress = function(e) {
                        if (e.lengthComputable && typeof progress === 'function') {
                            progress(e.loaded / e.total * 100);
                        }
                    };

                    xhr.onload = function() {
                        if (xhr.status !== 200) {
                            reject('HTTP Error: ' + xhr.status);
                            return;
                        }

                        const res = xhr.response || {};
                        if (!res.location) {
                            reject(res.error || 'Respon upload tidak valid');
                            return;
                        }

                        // sukses → TinyMCE insert <img src="res.location">
                        resolve(res.location);
                    };

                    xhr.onerror = function() {
                        reject('Gagal mengunggah gambar');
                    };

                    const formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    formData.append(csrfName, csrfHash); // CSRF aman

                    xhr.send(formData);
                });
            }
        });
    })();
</script>



<?= $this->endSection() ?>