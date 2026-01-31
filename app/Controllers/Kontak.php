<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KontakModel;

class Kontak extends BaseController
{
    public function index()
    {
        $kontakModel = new KontakModel();
        // Assuming we take the first active contact info or just the first one
        $kontak = $kontakModel->where('is_active', 1)->first();
        
        // If no active contact, maybe fallback or empty
        if (!$kontak) {
           $kontak = $kontakModel->first();
        }

        $data = [
            'title' => 'Kontak & layanan Aduan',
            'detail_kontak' => $kontak
        ];

        return view('frontend/kontak/index', $data);
    }
}
