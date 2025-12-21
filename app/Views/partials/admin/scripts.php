<script>
    document.addEventListener('DOMContentLoaded', function() {
        // =========================
        // USER DROPDOWN
        // =========================
        const userBtn = document.getElementById('userMenuButton');
        const userMenu = document.getElementById('userMenuDropdown');

        function closeUserMenu() {
            if (userMenu) userMenu.classList.add('hidden');
        }

        document.addEventListener('click', function(e) {
            if (!userBtn || !userMenu) return;

            const insideBtn = userBtn.contains(e.target);
            const insideMenu = userMenu.contains(e.target);

            if (insideBtn) userMenu.classList.toggle('hidden');
            else if (!insideMenu) userMenu.classList.add('hidden');
        });

        // =========================
        // THEME TOGGLE
        // =========================
        const themeToggle = document.getElementById('themeToggle');
        const themeLabel = document.getElementById('themeToggleLabel');

        const storedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        const initialTheme = storedTheme || (prefersDark ? 'dark' : 'light');

        function applyTheme(theme) {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                if (themeLabel) themeLabel.textContent = 'Gelap';
            } else {
                document.documentElement.classList.remove('dark');
                if (themeLabel) themeLabel.textContent = 'Terang';
            }
        }
        applyTheme(initialTheme);

        if (themeToggle) {
            themeToggle.addEventListener('click', function() {
                const current = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
                const next = current === 'dark' ? 'light' : 'dark';
                localStorage.setItem('theme', next);
                applyTheme(next);
            });
        }

        // =========================
        // SIDEBAR OFF-CANVAS (MOBILE) - PAKAI #sidebarMobile
        // =========================
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarMobile = document.getElementById('sidebarMobile');
        const overlay = document.getElementById('sidebarOverlay');

        // kalau tidak ada komponen sidebar mobile, stop tanpa bikin error
        if (!sidebarToggle || !sidebarMobile || !overlay) return;

        const mqMobile = window.matchMedia('(max-width: 767px)');
        const mqDesktop = window.matchMedia('(min-width: 768px)');

        const openSidebar = () => {
            closeUserMenu();

            sidebarMobile.classList.remove('-translate-x-full', 'opacity-0', 'pointer-events-none');
            sidebarMobile.classList.add('translate-x-0', 'opacity-100', 'pointer-events-auto');

            overlay.classList.remove('hidden');
            document.documentElement.classList.add('overflow-hidden');
        };

        const closeSidebar = () => {
            sidebarMobile.classList.add('-translate-x-full', 'opacity-0', 'pointer-events-none');
            sidebarMobile.classList.remove('translate-x-0', 'opacity-100', 'pointer-events-auto');

            overlay.classList.add('hidden');
            document.documentElement.classList.remove('overflow-hidden');
        };

        const isSidebarOpen = () => sidebarMobile.classList.contains('translate-x-0');

        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault();
            if (mqDesktop.matches) return; // jaga-jaga kalau tombol tampil
            isSidebarOpen() ? closeSidebar() : openSidebar();
        });

        overlay.addEventListener('click', closeSidebar);

        // klik link di menu -> tutup
        sidebarMobile.addEventListener('click', function(e) {
            const a = e.target.closest('a');
            if (!a) return;
            if (mqMobile.matches) closeSidebar();
        });

        // ESC -> tutup
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isSidebarOpen()) closeSidebar();
        });

        // sync state ketika resize / load
        function syncSidebarState() {
            if (mqDesktop.matches) {
                overlay.classList.add('hidden');
                document.documentElement.classList.remove('overflow-hidden');
                closeSidebar(); // pastikan mobile sidebar tidak nyangkut state open
            } else {
                closeSidebar(); // default mobile tertutup saat load
            }
        }

        window.addEventListener('resize', syncSidebarState);
        syncSidebarState();
    });
</script>