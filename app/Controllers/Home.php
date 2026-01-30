<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('home/index');
    }

    public function newsDetail($slug)
    {
        return view('home/news_detail', ['slug' => $slug]);
    }

    public function news()
    {
        return view('home/news');
    }
}
