<?php

if (!function_exists('btn_add')) {
    function btn_add(string $url, string $label = 'Tambah'): string
    {
        return '
        <a href="' . $url . '"
            class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-primary-600 text-white text-xs md:text-sm font-medium shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:ring-offset-1 focus:ring-offset-slate-50 dark:focus:ring-offset-slate-900">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>' . $label . '</span>
        </a>';
    }
}

if (!function_exists('btn_back')) {
    function btn_back(string $url, string $label = 'Kembali'): string
    {
        return '
        <a href="' . $url . '"
            class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl border border-blue-500 text-blue-600 text-xs md:text-sm hover:bg-blue-50 active:bg-blue-100 dark:border-blue-400 dark:text-blue-300 dark:hover:bg-blue-900/30">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7" />
            </svg>
            ' . $label . '
        </a>';
    }
}

if (!function_exists('btn_cancel')) {
    function btn_cancel(string $url, string $label = 'Batal'): string
    {
        return '
        <a href="' . $url . '"
            class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl border border-red-500 text-red-600 text-xs md:text-sm hover:bg-red-50 active:bg-red-100 dark:border-red-400 dark:text-red-300 dark:hover:bg-red-900/30">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
            ' . $label . '
        </a>';
    }
}

if (!function_exists('btn_save')) {
    function btn_save(string $type = 'submit', string $label = 'Simpan'): string
    {
        return '
        <button type="' . $type . '"
            class="inline-flex h-9 items-center gap-1.5 px-3 rounded-xl bg-primary-600 text-white text-xs md:text-sm font-medium hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500/70 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-slate-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 13l4 4L19 7" />
            </svg>
            ' . $label . '
        </button>';
    }
}

if (!function_exists('btn_edit')) {
    function btn_edit(string $url, string $label = 'Edit'): string
    {
        return '
        <a href="' . $url . '"
            class="js-keep-page inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-sky-200 bg-sky-50 text-[11px] font-medium text-sky-700 hover:bg-sky-100 focus:outline-none focus:ring-1 focus:ring-sky-400/70 dark:border-sky-500/40 dark:bg-sky-500/10 dark:text-sky-200 dark:hover:bg-sky-500/20"
            title="' . $label . '">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="w-3.5 h-3.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687 1.688a1.875 1.875 0 0 1 0 2.652L8.21 19.167A4.5 4.5 0 0 1 6.678 20l-2.135.534A.75.75 0 0 1 4 19.808l.534-2.135a4.5 4.5 0 0 1 1.334-2.531l10.338-10.338a1.875 1.875 0 0 1 2.652 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 4.5 19.5 7.5" />
            </svg>
            <span>' . $label . '</span>
        </a>';
    }
}

if (!function_exists('btn_delete')) {
    function btn_delete(string|int $id, string $label = 'Hapus'): string
    {
        return '
        <button type="button"
            class="btnDelete inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-rose-200 bg-rose-50 text-[11px] font-medium text-rose-700 hover:bg-rose-100 focus:outline-none focus:ring-1 focus:ring-rose-400/70 dark:border-rose-500/40 dark:bg-rose-500/10 dark:text-rose-200 dark:hover:bg-rose-500/20"
            data-id="' . $id . '" title="' . $label . '">
            <svg xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="w-3.5 h-3.5">
                <path d="M6 7h12" />
                <path d="M9 7V5h6v2" />
                <rect x="7" y="7" width="10" height="12" rx="1.5" />
                <path d="M10 11v5" />
                <path d="M14 11v5" />
            </svg>
            <span>' . $label . '</span>
        </button>';
    }
}

if (!function_exists('status_badge')) {
    function status_badge(string $status): string
    {
        $color = $status === 'active' ?
            'bg-emerald-100 text-emerald-700 border-emerald-200 dark:bg-emerald-900/40 dark:text-emerald-200 dark:border-emerald-700' :
            'bg-slate-100 text-slate-600 border-slate-200 dark:bg-slate-800/60 dark:text-slate-200 dark:border-slate-700';
        $label = $status === 'active' ? 'Aktif' : 'Nonaktif';
        
        return '<span class="inline-flex px-2 py-0.5 rounded-full border text-[11px] ' . $color . '">' . $label . '</span>';
    }
}
