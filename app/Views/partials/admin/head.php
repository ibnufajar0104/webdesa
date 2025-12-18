<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/svg+xml"
    href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='128' height='128' viewBox='0 0 24 24'%3E%3Crect width='24' height='24' rx='6' ry='6' fill='%233b82f6'/%3E%3Ctext x='12' y='16' font-size='10' text-anchor='middle' fill='white' font-family='Roboto, sans-serif'%3ECMS%3C/text%3E%3C/svg%3E">

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
                    }
                }
            }
        }
    }
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="/assets/css/custom.css">

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

    /* Sidebar standby (nempel) + hanya menu yang scroll */
    #sidebar {
        position: sticky;
        /* nempel saat konten discroll */
        top: 0;
        height: 100vh;
        /* setinggi layar */
        display: flex;
        flex-direction: column;
    }

    /* Menu yang boleh scroll */
    #sidebar nav {
        flex: 1 1 auto;
        overflow-y: auto;
        overscroll-behavior: contain;
        /* scroll tidak “narik” body */
        -webkit-overflow-scrolling: touch;
    }

    /* Biar brand & footer tetap terlihat */
    #sidebar>.h-16,
    #sidebar>.h-14 {
        flex: 0 0 auto;
    }

    /* Scrollbar tipis (opsional) */
    #sidebar nav::-webkit-scrollbar {
        width: 8px;
    }

    #sidebar nav::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, .35);
        border-radius: 999px;
    }

    .dark #sidebar nav::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, .25);
    }
</style>