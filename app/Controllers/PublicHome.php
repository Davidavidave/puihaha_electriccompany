<?php

namespace App\Controllers;

class PublicHome extends BaseController
{
    public function index(): string
    {
        return view('public_home', [
            'title' => 'PowerFlow Electric - Reliable Energy Solutions',
            'page' => 'home',
        ]);
    }
}
