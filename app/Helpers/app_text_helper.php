<?php

if (!function_exists('extract_snippet')) {
    /**
     * Ambil teks hanya dari tag <p>, hilangkan tag HTML, dan potong jika terlalu panjang.
     *
     * @param string $content HTML content
     * @param int $limit Max characters
     * @param string $end Ending string if truncated
     * @return string
     */
    function extract_snippet(string $content, int $limit = 100, string $end = '...'): string
    {
        // 1. Ambil semua konten di dalam tag <p>
        preg_match_all('/<p>(.*?)<\/p>/s', $content, $matches);
        
        // Gabungkan semua hasil match (index 1 berisi inner text)
        $text = implode(' ', $matches[1] ?? []);

        // 2. Bersihkan tag HTML lain yang mungkin ada di dalam <p> (misal <b>, <i>, <br>)
        $text = strip_tags($text);

        // Bersihkan whitespace berlebih
        $text = trim(preg_replace('/\s+/', ' ', $text));

        // Jika kosong (mungkin tidak ada tag <p>), fallback ke strip_tags konten asli (opsional, tergantung requirement)
        if (empty($text)) {
           // Opsional: uncomment baris bawah jika ingin mengambil text apapun jika tidak ada <p>
           // $text = strip_tags($content); 
           // $text = trim(preg_replace('/\s+/', ' ', $text));
           return ''; // Sesuai request: "ambil hanya tag p" -> kalau gak ada p, kosong.
        }

        // 3. Cut text helper
        if (mb_strlen($text) <= $limit) {
            return $text;
        }

        return rtrim(mb_substr($text, 0, $limit)) . $end;
    }
}
