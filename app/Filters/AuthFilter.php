<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Sudah login?
        if (session()->get('isLoggedIn') === true) {
            return;
        }

        // Simpan URL yang mau dituju supaya setelah login bisa balik
        $uri = current_url(true);
        $fullUrl = (string) $uri;

        session()->set('redirect_url', $fullUrl);

        return redirect()->to(site_url('login'))
            ->with('error', 'Silakan login terlebih dahulu.');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // no-op
    }
}
