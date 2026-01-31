<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AduanModel;

class Kontak extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $model = new \App\Models\KontakModel();
        $kontak = $model->where('is_active', 1)->first();
        if (!$kontak) {
            $kontak = $model->first();
        }
        
        // Wrap in array for consistency with other APIs if needed, or just return object
        // home.js expects response.data to be the object or array of objects
        // If query returns single row, we might wrap it.
        // Let's check home.js 'loadProfile':
        // const d = response.data; const data = Array.isArray(d) ? d[0] : d;
        // So single object is fine.
        
        return $this->respond([
            'status' => true,
            'data'   => $kontak
        ]);
    }

    public function kirim()
    {
        // 1. Brute Force Protection (Throttling)
        // Allow 3 requests every 60 seconds per IP
        $throttler = \Config\Services::throttler();
        $ip = $this->request->getIPAddress();
        
        if ($throttler->check(md5($ip . 'aduan'), 2, 60) === false) {
             return $this->failTooManyRequests('Terlalu banyak permintaan. Silakan coba lagi dalam beberapa menit.');
        }

        // 2. Validation
        $rules = [
            'email' => 'required|valid_email|max_length[255]',
            'wa'    => 'required|numeric|max_length[20]',
            'pesan' => 'required|min_length[10]|max_length[5000]',
            'nama'  => 'permit_empty|max_length[100]'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        // 3. Sanitization (XSS Protection for Input)
        // We strip tags to ensure no HTML is stored for this simple text field.
        $pesan = strip_tags($this->request->getVar('pesan'));
        $nama  = strip_tags($this->request->getVar('nama'));
        $email = strip_tags($this->request->getVar('email'));
        $wa    = strip_tags($this->request->getVar('wa'));

        $data = [
            'nama'       => $nama,
            'email'      => $email,
            'wa'         => $wa,
            'pesan'      => $pesan,
        ];

        // Add System Info
        $data['ip_address'] = $ip;
        $data['user_agent'] = $this->request->getUserAgent()->getAgentString();
        $data['status']     = 'pending';

        // Save
        $model = new AduanModel();
        if ($model->insert($data)) {
            return $this->respondCreated(['status' => true, 'message' => 'Laporan Anda berhasil dikirim. Kami akan segera menindaklanjutinya.']);
        } else {
            // Return validation errors from model if any
            if ($model->errors()) {
                return $this->fail($model->errors());
            }
            return $this->failServerError('Gagal menyimpan data.');
        }
    }
}
