<!doctype html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($pageTitle ?? 'Login') ?> - Web Desa CMS</title>

    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='128' height='128' viewBox='0 0 24 24'%3E%3Crect width='24' height='24' rx='6' ry='6' fill='%233b82f6'/%3E%3Ctext x='12' y='16' font-size='10' text-anchor='middle' fill='white' font-family='Roboto, sans-serif'%3ECMS%3C/text%3E%3C/svg%3E">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                            950: '#172554'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Roboto', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .scroll-thin::-webkit-scrollbar {
            width: 6px;
        }

        .scroll-thin::-webkit-scrollbar-track {
            background: transparent;
        }

        .scroll-thin::-webkit-scrollbar-thumb {
            background: rgba(148, 163, 184, .75);
            border-radius: 999px;
        }
    </style>

    <script>
        // Dark mode persist
        (function() {
            const saved = localStorage.getItem('theme');
            const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (saved === 'dark' || (!saved && prefersDark)) document.documentElement.classList.add('dark');
        })();

        function toggleTheme() {
            const el = document.documentElement;
            el.classList.toggle('dark');
            localStorage.setItem('theme', el.classList.contains('dark') ? 'dark' : 'light');
        }
    </script>
</head>

<body class="min-h-screen bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100">
    <!-- Background decor -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-24 -left-24 h-72 w-72 rounded-full bg-primary-200/60 blur-3xl dark:bg-primary-600/20"></div>
        <div class="absolute top-1/3 -right-24 h-72 w-72 rounded-full bg-sky-200/60 blur-3xl dark:bg-sky-600/20"></div>
        <div class="absolute -bottom-24 left-1/3 h-72 w-72 rounded-full bg-indigo-200/60 blur-3xl dark:bg-indigo-600/20"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(37,99,235,0.10),transparent_55%)] dark:bg-[radial-gradient(ellipse_at_top,rgba(37,99,235,0.12),transparent_55%)]"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Top bar -->
            <div class="mb-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-xl bg-primary-600 text-white flex items-center justify-center font-bold shadow-sm">
                        WD
                    </div>
                    <div class="leading-tight">
                        <p class="text-sm font-semibold">Web Desa CMS</p>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400">Panel Admin</p>
                    </div>
                </div>

                <button type="button" onclick="toggleTheme()"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white/70 px-3 py-2 text-xs text-slate-700 shadow-sm backdrop-blur hover:bg-white dark:border-slate-800 dark:bg-slate-900/60 dark:text-slate-200 dark:hover:bg-slate-900">
                    <!-- Sun/Moon -->
                    <svg class="h-4 w-4 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 18a6 6 0 1 0 0-12 6 6 0 0 0 0 12Z" />
                        <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" />
                    </svg>
                    <svg class="h-4 w-4 hidden dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z" />
                    </svg>
                    <span class="hidden sm:inline">Theme</span>
                </button>
            </div>

            <!-- Card -->
            <div class="rounded-2xl border border-slate-200/70 bg-white/80 shadow-xl shadow-slate-200/40 backdrop-blur dark:border-slate-800/70 dark:bg-slate-900/70 dark:shadow-black/20 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100/70 dark:border-slate-800/70">
                    <h1 class="text-base font-semibold text-slate-900 dark:text-white">Masuk ke Admin Panel</h1>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                        Gunakan username/email & password yang terdaftar.
                    </p>
                </div>

                <div class="px-6 py-5 space-y-3">
                    <?php if (session('success')): ?>
                        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs text-emerald-700 dark:border-emerald-500/40 dark:bg-emerald-500/10 dark:text-emerald-100">
                            <?= esc(session('success')) ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session('error')): ?>
                        <div class="rounded-xl border border-rose-200 bg-rose-50 px-3 py-2 text-xs text-rose-700 dark:border-rose-500/40 dark:bg-rose-500/10 dark:text-rose-100">
                            <?= esc(session('error')) ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($errors)): ?>
                        <div class="rounded-xl border border-rose-200 bg-rose-50 px-3 py-2 text-xs text-rose-700 dark:border-rose-500/40 dark:bg-rose-500/10 dark:text-rose-100">
                            <ul class="list-disc list-inside space-y-0.5">
                                <?php foreach ($errors as $err): ?>
                                    <li><?= esc($err) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('login') ?>" method="post" class="space-y-3">
                        <?= csrf_field() ?>

                        <!-- Identity -->
                        <div>
                            <label for="identity" class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">
                                Username / Email
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="3" />
                                    </svg>
                                </span>
                                <input type="text" id="identity" name="identity"
                                    value="<?= esc(old('identity')) ?>"
                                    class="w-full rounded-xl border border-slate-200 bg-white pl-10 pr-3 py-2 text-sm text-slate-800 shadow-sm
                                              focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500
                                              dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                                    placeholder="contoh: admin atau admin@email"
                                    autocomplete="username"
                                    required>
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs font-medium text-slate-700 dark:text-slate-200 mb-1">
                                Password
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 17a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                                        <path d="M6 10V8.5A6 6 0 0 1 12 2a6 6 0 0 1 6 6.5V10" />
                                        <rect x="5" y="10" width="14" height="11" rx="2" />
                                    </svg>
                                </span>

                                <input type="password" id="password" name="password"
                                    class="w-full rounded-xl border border-slate-200 bg-white pl-10 pr-11 py-2 text-sm text-slate-800 shadow-sm
                  focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:border-primary-500
                  dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                                    placeholder="••••••••"
                                    autocomplete="current-password"
                                    required>

                                <!-- Toggle show/hide -->
                                <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-2 inline-flex items-center justify-center rounded-lg px-2
                   text-slate-500 hover:text-slate-700 hover:bg-slate-100
                   dark:text-slate-300 dark:hover:text-white dark:hover:bg-slate-800"
                                    aria-label="Tampilkan password" aria-pressed="false">
                                    <!-- Eye (show) -->
                                    <svg id="iconEye" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                    <!-- Eye off (hide) -->
                                    <svg id="iconEyeOff" class="h-4 w-4 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10.58 10.58A3 3 0 0 0 12 15a3 3 0 0 0 2.42-4.42" />
                                        <path d="M9.88 5.09A10.43 10.43 0 0 1 12 5c6.5 0 10 7 10 7a18.5 18.5 0 0 1-4.3 5.2" />
                                        <path d="M6.61 6.61A18.5 18.5 0 0 0 2 12s3.5 7 10 7c1.2 0 2.3-.2 3.3-.6" />
                                        <path d="M2 2l20 20" />
                                    </svg>
                                </button>
                            </div>

                        </div>

                        <button type="submit"
                            class="group relative w-full inline-flex items-center justify-center gap-2 h-10 rounded-xl bg-primary-600 text-white text-sm font-medium
                                       shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:ring-offset-1
                                       focus:ring-offset-white dark:focus:ring-offset-slate-900">
                            <span class="absolute inset-0 rounded-xl opacity-0 group-hover:opacity-100 transition
                                         bg-[radial-gradient(circle_at_top,rgba(255,255,255,.25),transparent_55%)]"></span>

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A3.75 3.75 0 0 0 12 1.5a3.75 3.75 0 0 0-3.75 3.75V9m-.75 0h9A2.25 2.25 0 0 1 18.75 11.25v7.5A2.25 2.25 0 0 1 16.5 21h-9a2.25 2.25 0 0 1-2.25-2.25v-7.5A2.25 2.25 0 0 1 7.5 9Z" />
                            </svg>
                            <span class="relative">Masuk</span>
                        </button>

                        <div class="pt-2 text-center">
                            <p class="text-[11px] text-slate-500 dark:text-slate-400">
                                © <?= date('Y') ?> Web Desa CMS
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <p class="mt-4 text-center text-[11px] text-slate-500 dark:text-slate-400">
                Tip: gunakan email jika lupa username.
            </p>
        </div>
    </div>
</body>
<script>
    (function() {
        const input = document.getElementById('password');
        const btn = document.getElementById('togglePassword');
        const eye = document.getElementById('iconEye');
        const eyeOff = document.getElementById('iconEyeOff');

        if (!input || !btn) return;

        btn.addEventListener('click', function() {
            const isHidden = input.getAttribute('type') === 'password';
            input.setAttribute('type', isHidden ? 'text' : 'password');

            // swap icons
            eye.classList.toggle('hidden', isHidden);
            eyeOff.classList.toggle('hidden', !isHidden);

            btn.setAttribute('aria-pressed', isHidden ? 'true' : 'false');
            btn.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');

            // keep focus
            input.focus({
                preventScroll: true
            });
        });
    })();
</script>

</html>