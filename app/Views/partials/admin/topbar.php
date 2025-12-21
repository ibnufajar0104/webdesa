<header class="sticky top-0 z-40 h-16 bg-white/95 backdrop-blur border-b border-slate-200 
  flex items-center justify-between px-4 md:px-6 
  dark:bg-slate-900/95 dark:border-slate-800">

    <div class="flex items-center gap-3">
        <!-- Sidebar toggle (mobile) -->
        <button id="sidebarToggle"
            class="md:hidden inline-flex items-center justify-center w-9 h-9 rounded-xl border border-slate-200 bg-white shadow-sm text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:hover:bg-slate-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 5.25h16.5M3.75 12h16.5m-16.5 6.75h16.5" />
            </svg>
        </button>

        <div>
            <h1 class="text-sm md:text-base font-semibold text-slate-800 dark:text-slate-100">
                CMS WEB DESA BATILAI
            </h1>
            <p class="text-xs text-slate-500 hidden sm:block dark:text-slate-400">
                Panel manajemen konten Web Desa
            </p>
        </div>
    </div>

    <!-- User + theme toggle -->
    <div class="flex items-center gap-3">
        <!-- Toggle tema -->
        <button id="themeToggle"
            type="button"
            class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-xl border border-slate-200 bg-white text-[11px] text-slate-600 shadow-sm hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:hover:bg-slate-800">
            <!-- Icon Sun (light) -->
            <svg id="iconSun" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-3.5 h-3.5 block dark:hidden">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 3v1.5m0 15V21m9-9h-1.5M3 12H4.5m15.364 6.364L18.9 17.9M5.1 5.1L6.636 6.636m10.728 0L18.9 5.1M5.1 18.9L6.636 17.364" />
                <circle cx="12" cy="12" r="4" />
            </svg>
            <!-- Icon Moon (dark) -->
            <svg id="iconMoon" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-3.5 h-3.5 hidden dark:block">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
            </svg>
            <span id="themeToggleLabel" class="hidden sm:inline">Dark</span>
        </button>

        <!-- User dropdown -->
        <div class="relative">
            <button id="userMenuButton"
                type="button"
                class="inline-flex items-center gap-2 px-2.5 py-1.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs md:text-sm shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-primary-500/60 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:hover:bg-slate-800">
                <div class="hidden sm:flex flex-col items-end">
                    <span class="font-medium leading-tight">
                        <?= esc(session('nama') ?? 'Administrator') ?>
                    </span>
                    <span class="text-[10px] text-slate-400 leading-tight">Admin Web Desa</span>
                </div>
                <!-- <div class="w-8 h-8 rounded-full bg-primary-500 text-white flex items-center justify-center text-xs font-semibold shadow">
                    <?= strtoupper(substr((string)(session('username') ?? 'A'), 0, 1)) ?>
                </div> -->
                <!-- Chevron -->
                <svg class="w-3.5 h-3.5 text-slate-500 hidden sm:block" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.5 7.5L10 12l4.5-4.5" stroke="currentColor" stroke-width="1.6"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <div id="userMenuDropdown"
                class="hidden absolute right-0 mt-2 w-44 origin-top-right bg-white border border-slate-200 rounded-xl shadow-lg py-1 text-xs md:text-sm z-30 dark:bg-slate-900 dark:border-slate-700">
                <div class="px-3 py-2 border-b border-slate-100 dark:border-slate-700">
                    <p class="font-medium text-slate-800 dark:text-slate-100 truncate">
                        <?= esc(session('nama') ?? 'Administrator') ?>
                    </p>
                    <p class="text-[11px] text-slate-400 dark:text-slate-500">Desa Batilai</p>
                </div>

                <a href="<?= base_url('admin/profile') ?>"
                    class="flex items-center gap-2 px-3 py-2 hover:bg-slate-50 text-slate-700 dark:text-slate-100 dark:hover:bg-slate-800">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="9" r="3" />
                        <path d="M7 19.5c.8-2.3 2.6-3.5 5-3.5s4.2 1.2 5 3.5" />
                    </svg>
                    <span>Profil</span>
                </a>

                <form method="get" action="<?= base_url('logout') ?>">
                    <?= csrf_field() ?>
                    <button type="submit"
                        class="w-full flex items-center gap-2 px-3 py-2 text-left text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.7"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 5h-5.5A2.5 2.5 0 0 0 7 7.5v9A2.5 2.5 0 0 0 9.5 19H15" />
                            <path d="M12 12h8" />
                            <path d="M18 8l4 4-4 4" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>