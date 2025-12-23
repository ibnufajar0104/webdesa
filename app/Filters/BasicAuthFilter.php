<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class BasicAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = $request->getHeaderLine('Authorization');

        if (!$auth || stripos($auth, 'Basic ') !== 0) {
            return $this->unauthorized('Missing Basic Authorization header.');
        }

        $encoded = trim(substr($auth, 6));
        $decoded = base64_decode($encoded, true);

        if ($decoded === false || !str_contains($decoded, ':')) {
            return $this->unauthorized('Invalid Basic Authorization format.');
        }

        [$username, $password] = explode(':', $decoded, 2);

        // Ambil kredensial dari .env
        $envUser = (string) env('API_BASIC_USER');
        $envPass = (string) env('API_BASIC_PASS');

        if ($envUser === '' || $envPass === '') {
            return $this->unauthorized('Server auth not configured.');
        }

        // Timing-safe compare
        $okUser = hash_equals($envUser, $username);
        $okPass = hash_equals($envPass, $password);

        if (!$okUser || !$okPass) {
            return $this->unauthorized('Invalid credentials.');
        }

        return null; // lanjut
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }

    private function unauthorized(string $msg)
    {
        $res = service('response');
        return $res->setStatusCode(401)
            ->setHeader('WWW-Authenticate', 'Basic realm="News API"')
            ->setJSON([
                'status'  => false,
                'message' => $msg,
            ]);
    }
}
