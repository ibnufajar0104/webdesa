<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class FileHandler extends BaseController
{
    /**
     * Serve file gambar dari WRITEPATH/uploads/pages
     * URL: /file/pages/{filename}
     */
    public function pages($filename = null)
    {
        if (!$filename) {
            return $this->response->setStatusCode(404, 'File not found');
        }

        // Sanitasi nama file untuk mencegah path traversal
        $safeName = basename($filename); // buang path2 aneh
        // Bisa tambah filter ketat kalau mau:
        if (!preg_match('/^[A-Za-z0-9._-]+$/', $safeName)) {
            return $this->response->setStatusCode(400, 'Invalid file name');
        }

        $filePath = WRITEPATH . 'uploads/pages/' . $safeName;

        if (!is_file($filePath)) {
            return $this->response->setStatusCode(404, 'File not found');
        }

        // Deteksi mime type
        $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';

        // Hanya izinkan serve beberapa tipe gambar
        $allowed = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/webp'];
        if (!in_array($mimeType, $allowed, true)) {
            return $this->response->setStatusCode(403, 'Forbidden');
        }

        // Bisa tambahkan cache header
        $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Cache-Control', 'public, max-age=604800'); // 7 hari

        return $this->response->setBody(file_get_contents($filePath));
    }


    public function news($filename = null)
    {
        if (!$filename) {
            return $this->response->setStatusCode(404, 'File not found');
        }

        // Sanitasi nama file untuk mencegah path traversal
        $safeName = basename($filename); // buang path2 aneh
        // Bisa tambah filter ketat kalau mau:
        if (!preg_match('/^[A-Za-z0-9._-]+$/', $safeName)) {
            return $this->response->setStatusCode(400, 'Invalid file name');
        }

        $filePath = WRITEPATH . 'uploads/news/' . $safeName;

        if (!is_file($filePath)) {
            return $this->response->setStatusCode(404, 'File not found');
        }

        // Deteksi mime type
        $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';

        // Hanya izinkan serve beberapa tipe gambar
        $allowed = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/webp'];
        if (!in_array($mimeType, $allowed, true)) {
            return $this->response->setStatusCode(403, 'Forbidden');
        }

        // Bisa tambahkan cache header
        $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Cache-Control', 'public, max-age=604800'); // 7 hari

        return $this->response->setBody(file_get_contents($filePath));
    }

    public function banner($filename = null)
    {
        if (!$filename) {
            return $this->response->setStatusCode(404, 'File not found');
        }

        // Sanitasi nama file untuk mencegah path traversal
        $safeName = basename($filename); // buang path2 aneh
        // Bisa tambah filter ketat kalau mau:
        if (!preg_match('/^[A-Za-z0-9._-]+$/', $safeName)) {
            return $this->response->setStatusCode(400, 'Invalid file name');
        }

        $filePath = WRITEPATH . 'uploads/banner/' . $safeName;

        if (!is_file($filePath)) {
            return $this->response->setStatusCode(404, 'File not found');
        }

        // Deteksi mime type
        $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';

        // Hanya izinkan serve beberapa tipe gambar
        $allowed = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/webp'];
        if (!in_array($mimeType, $allowed, true)) {
            return $this->response->setStatusCode(403, 'Forbidden');
        }

        // Bisa tambahkan cache header
        $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Cache-Control', 'public, max-age=604800'); // 7 hari

        return $this->response->setBody(file_get_contents($filePath));
    }

    public function ktp($filename = null)
    {
        if (!$filename) {
            return $this->response->setStatusCode(404, 'File not found');
        }

        // Sanitasi nama file untuk mencegah path traversal
        $safeName = basename($filename); // buang path2 aneh

        if (!preg_match('/^[A-Za-z0-9._-]+$/', $safeName)) {
            return $this->response->setStatusCode(400, 'Invalid file name');
        }

        // Folder KTP seharusnya beda dari pages (lebih aman)
        $filePath = WRITEPATH . 'uploads/ktp/' . $safeName;

        if (!is_file($filePath)) {
            return $this->response->setStatusCode(404, 'File not found');
        }

        // Deteksi mime type
        $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';

        // Izinkan gambar + PDF
        $allowed = [
            'image/png',
            'image/jpeg',
            'image/jpg',
            'image/gif',
            'image/webp',
            'application/pdf',   // ⬅️ PDF diizinkan
        ];

        if (!in_array($mimeType, $allowed, true)) {
            return $this->response->setStatusCode(403, 'File type forbidden');
        }

        // PDF harus ditampilkan inline
        if ($mimeType === 'application/pdf') {
            $this->response->setHeader('Content-Disposition', 'inline; filename="' . $safeName . '"');
        }

        // Set header
        $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Cache-Control', 'public, max-age=604800'); // 7 hari

        return $this->response->setBody(file_get_contents($filePath));
    }


    public function galery($filename = null)
    {
        if (!$filename) {
            return $this->response->setStatusCode(404, 'File not found');
        }

        // Sanitasi nama file (anti path traversal)
        $safeName = basename($filename);

        // Hanya karakter aman
        if (!preg_match('/^[A-Za-z0-9._-]+$/', $safeName)) {
            return $this->response->setStatusCode(400, 'Invalid file name');
        }

        // Batasi ekstensi hanya gambar
        $ext = strtolower(pathinfo($safeName, PATHINFO_EXTENSION));
        $allowedExt = ['png', 'jpg', 'jpeg', 'gif', 'webp'];
        if (!in_array($ext, $allowedExt, true)) {
            return $this->response->setStatusCode(403, 'File type forbidden');
        }

        $filePath = WRITEPATH . 'uploads/galery/' . $safeName;

        if (!is_file($filePath)) {
            return $this->response->setStatusCode(404, 'File not found');
        }

        // Deteksi mime type
        $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';

        // Izinkan MIME gambar saja
        $allowedMime = [
            'image/png',
            'image/jpeg',
            'image/gif',
            'image/webp',
        ];

        if (!in_array($mimeType, $allowedMime, true)) {
            return $this->response->setStatusCode(403, 'File type forbidden');
        }

        // Header untuk image (inline)
        $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'inline; filename="' . $safeName . '"')
            ->setHeader('X-Content-Type-Options', 'nosniff')
            ->setHeader('Cache-Control', 'public, max-age=604800'); // 7 hari

        return $this->response->setBody(file_get_contents($filePath));
    }
}
