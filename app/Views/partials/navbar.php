    <!-- Navigation (Official Style) -->
    <nav class="bg-white/95 backdrop-blur-md sticky top-0 z-50 shadow-sm dark:bg-slate-900/95 dark:border-b dark:border-slate-800 transition-colors" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex-shrink-0 flex items-center gap-3 group">
                        <img src="<?= base_url('logo.png') ?>" alt="Logo Desa" class="w-12 h-12 object-contain group-hover:scale-105 transition duration-300">
                        <div class="flex flex-col">
                            <h1 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white tracking-tight leading-none font-serif">Desa Batilai</h1>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="w-8 h-[2px] bg-primary"></span>
                                <p class="text-[10px] md:text-xs text-gray-500 dark:text-gray-400 font-semibold tracking-wide uppercase">Kec. Takisung Kab. Tanah Laut</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-2">
                    <div id="desktop-menu" class="flex items-center space-x-1 mr-4">
                        <!-- Dynamic Menu -->
                    </div>
                    
                    <!-- Search & Theme Toggle -->
                    <div class="flex items-center gap-2 pl-4 border-l border-gray-200 dark:border-slate-700">
                        <button id="theme-toggle-btn" class="p-2 text-gray-500 hover:text-amber-500 dark:text-gray-400 dark:hover:text-amber-400 transition" aria-label="Toggle Theme">
                            <!-- Sun Icon (Hidden in Dark) -->
                            <svg id="theme-sun-icon" class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <!-- Moon Icon (Hidden in Light) -->
                            <svg id="theme-moon-icon" class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center lg:hidden gap-3">
                     <button id="mobile-theme-btn" class="text-gray-500 hover:text-amber-500 dark:text-gray-400 p-1">
                        <svg class="w-6 h-6 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <svg class="w-6 h-6 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                     </button>
                    <button id="mobile-menu-btn" type="button" class="text-gray-500 hover:text-primary focus:outline-none p-2 rounded-md transition bg-gray-50 dark:bg-slate-800 dark:text-gray-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu (Moved Outside Nav for Z-Index Safety) -->
    <div id="mobile-menu" class="lg:hidden fixed top-20 left-0 w-full bg-white dark:bg-slate-900 border-t border-gray-100 dark:border-slate-800 shadow-xl hidden z-[9999] max-h-[calc(100vh-80px)] overflow-y-auto">
        <div class="px-4 pt-2 pb-4 space-y-1 shadow-inner bg-gray-50/50 dark:bg-slate-900/50">
             <div id="mobile-menu-items"></div>
        </div>
    </div>
