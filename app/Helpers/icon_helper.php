<?php

if (!function_exists('get_icon')) {
    function get_icon($name, $class = "w-3.5 h-3.5")
    {
        $icons = [
            'dashboard' => '<path d="M4 11.5L12 4l8 7.5" /><path d="M5.5 10.5V20h13v-9.5" />',
            
            'halaman_statis' => '<path d="M7 3.5h7.5L19 8v12H7z" /><path d="M14.5 3.5V8H19" /><path d="M10 11h5M10 14h5M10 17h3" />',
            
            'menu' => '<rect x="3" y="4" width="18" height="4" rx="1" /><rect x="3" y="10" width="18" height="4" rx="1" /><rect x="3" y="16" width="18" height="4" rx="1" />',
            
            'banner' => '<rect x="4" y="5" width="16" height="14" rx="1.5" /><path d="M8 13l2.5-2.5L14 14l2-2 2 3" /><circle cx="9" cy="9" r="1.1" />',
            
            'berita' => '<rect x="4" y="5" width="16" height="14" rx="1.5" /><path d="M8 9h5M8 12h5M8 15h3" /><rect x="15" y="9" width="3" height="6" rx="0.6" />',
            
            'galery' => '<rect x="4" y="6" width="16" height="12" rx="1.5" /><path d="M8 14l2.2-2.2L13.2 15l2.3-2.3L20 18" /><circle cx="9" cy="10" r="1.1" />',
            
            'dokumen' => '<path d="M7 3.5h7.5L19 8v12H7z" /><path d="M14.5 3.5V8H19" /><path d="M9.5 12h5M9.5 15h5M9.5 18h3" />',
            'dokumen_simple' => '<path d="M7 3.5h7.5L19 8v12H7z" /><path d="M14.5 3.5V8H19" /><path d="M9.5 12h5M9.5 15h5" />', // untuk submenu
            
            'kategori_dokumen' => '<path d="M4 7h7l2 2h7v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7z" />',
            
            'perangkat_desa' => '<rect x="4" y="8" width="16" height="10" rx="1.5" /><path d="M9 8V6.5A1.5 1.5 0 0 1 10.5 5h3A1.5 1.5 0 0 1 15 6.5V8" /><path d="M4 12h16" />',
            
            'bpd' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" />',
            
            'penduduk' => '<path d="M8 13.5c-2.2 0-4 1.3-4 3v1.5h8v-1.5c0-1.7-1.8-3-4-3z" /><circle cx="8" cy="8.5" r="2.5" /><path d="M16 12.5c1.7 0 3 1.1 3 2.6V18" /><circle cx="16" cy="8.5" r="2.1" />',
            
            'penerima_bantuan' => '<path d="M12 2.5 20 6v6c0 5-3.5 9-8 9s-8-4-8-9V6l8-3.5Z" /><path d="M8.5 12.5 11 15l4.5-5" />',
            
            'rt' => '<path d="M4 20V9.5L12 4l8 5.5V20" /><path d="M9.5 20v-6h6v6" />',
            
            'settings' => '<path d="M12 2c5.52 0 10 2.24 10 5s-4.48 5-10 5-10-2.24-10-5 4.48-5 10-5zm0 14c5.52 0 10-2.24 10-5" /><path d="M22 13c0 2.76-4.48 5-10 5S2 15.76 2 13" /><path d="M22 17c0 2.76-4.48 5-10 5S2 19.76 2 17" />',
            
            'master_pendidikan' => '<path d="M3 9.5L12 5l9 4.5-9 4.5-9-4.5z" /><path d="M7 12.5v3.5c0 1 2.2 2 5 2s5-1 5-2v-3.5" /><path d="M21 10v4" />',
            
            'master_pekerjaan' => '<path d="M10 6V4.5A1.5 1.5 0 0 1 11.5 3h1A1.5 1.5 0 0 1 14 4.5V6" /><rect x="4" y="6" width="16" height="12" rx="2" /><path d="M4 12h16" />',
            
            'master_agama' => '<path d="M12 4l9 5-9 5-9-5 9-5z" /><path d="M3 14l9 5 9-5" />',
            
            'master_dusun' => '<path d="M4 20V10l8-5 8 5v10" /><path d="M9 20v-6h6v6" /><path d="M7.5 12.5h.01M10.5 12.5h.01M13.5 12.5h.01M16.5 12.5h.01" />',
            
            'master_rt' => '<rect x="3.5" y="4.5" width="17" height="15" rx="2" /><path d="M7 9h10M7 12h10M7 15h6" />',
            
            'master_jabatan' => '<rect x="4" y="4" width="6" height="6" rx="1.2" /><rect x="14" y="4" width="6" height="6" rx="1.2" /><rect x="4" y="14" width="6" height="6" rx="1.2" /><rect x="14" y="14" width="6" height="6" rx="1.2" />',
            
            'pengguna' => '<circle cx="12" cy="8" r="3" /><path d="M4.5 20a7.5 7.5 0 0 1 15 0" />',
            
            'demografi' => '<path d="M3 21h18M5 21V7l8-4 8 4v14M8 21v-3a4 4 0 0 1 4-4v0a4 4 0 0 1 4 4v3" />',
            
            'sambutan_kades' => '<path d="M5 11v2l9 4V7L5 11z" /><path d="M18 9.5v5" /><path d="M7 13l-1 4" />',
            
            'jam_pelayanan' => '<circle cx="12" cy="12" r="7.5" /><path d="M12 8v4l2.5 2.5" />',
            
            'kontak' => '<path d="M7.5 4.5l2 3.5-1.7 1.2a2 2 0 0 0-.6 2.6 11.5 11.5 0 0 0 5 5 2 2 0 0 0 2.6-.6l1.2-1.7 3.5 2a1.3 1.3 0 0 1 .4 1.8l-1.1 1.7a2.3 2.3 0 0 1-2.3 1 16.5 16.5 0 0 1-9.1-4.3 16.2 16.2 0 0 1-4.3-9.1 2.3 2.3 0 0 1 1-2.3l1.7-1.1a1.3 1.3 0 0 1 1.8.4z" />',
            
            'globe' => '<circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/>',
        ];

        $content = $icons[$name] ?? '';
        
        return '<svg class="' . $class . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">' . $content . '</svg>';
    }
}
