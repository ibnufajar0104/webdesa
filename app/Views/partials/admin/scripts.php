<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userBtn = document.getElementById('userMenuButton');
        const userMenu = document.getElementById('userMenuDropdown');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const themeToggle = document.getElementById('themeToggle');
        const themeLabel = document.getElementById('themeToggleLabel');

        document.addEventListener('click', function(e) {
            if (!userBtn || !userMenu) return;
            const clickInsideButton = userBtn.contains(e.target);
            const clickInsideMenu = userMenu.contains(e.target);

            if (clickInsideButton) userMenu.classList.toggle('hidden');
            else if (!clickInsideMenu) userMenu.classList.add('hidden');
        });

        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('hidden');
            });
        }

        const storedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        const initialTheme = storedTheme || (prefersDark ? 'dark' : 'light');

        function applyTheme(theme) {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                if (themeLabel) themeLabel.textContent = 'Light';
            } else {
                document.documentElement.classList.remove('dark');
                if (themeLabel) themeLabel.textContent = 'Dark';
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
    });
</script>