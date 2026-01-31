<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('frontend/index');
    }

    public function newsDetail($slug)
    {
        return view('frontend/berita/detail', ['slug' => $slug]);
    }

    public function news()
    {
        return view('frontend/berita/index');
    }
}
