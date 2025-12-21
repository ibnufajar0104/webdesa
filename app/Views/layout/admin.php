<!DOCTYPE html>
<html lang="id">

<head>
    <?= $this->include('partials/admin/head') ?>
    <title><?= $this->renderSection('title') ?> - Web Desa CMS</title>
</head>

<body class="bg-slate-100 text-slate-800 dark:bg-slate-950 dark:text-slate-100">

    <div class="min-h-screen flex">

        <div class="hidden md:block">
            <?= view('partials/admin/sidebar', ['sidebarId' => 'sidebarDesktop']) ?>

        </div>

        <!-- MAIN -->
        <div class="flex-1 flex flex-col min-w-0">
            <?= $this->include('partials/admin/topbar') ?>

            <main class="flex-1 p-4 md:p-6">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <!-- SIDEBAR MOBILE (fixed, di luar flex) -->
    <div class="md:hidden">
        <?= view('partials/admin/sidebar', ['sidebarId' => 'sidebarMobile']) ?>

    </div>
    <!-- OVERLAY (dipakai oleh JS global) -->
    <div id="sidebarOverlay"
        class="hidden fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm md:hidden"></div>

    <?= $this->include('partials/admin/flash') ?>
    <?= $this->include('partials/admin/scripts') ?>

</body>

</html>