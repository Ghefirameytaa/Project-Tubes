<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Bisa kirim data dummy kalau mau
        $data = [
            'welcome' => 'Selamat datang di dashboard admin!'
        ];

        return view('dashboard', $data);
    }
}