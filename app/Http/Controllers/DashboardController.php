<?php

namespace App\Http\Controllers;

use App\Models\Book; // Pastikan Model Book dipanggil
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data untuk ditampilkan di Dashboard
        $data = [
            'total_buku'    => Book::count(), // Munculkan total semua buku
            'stok_habis'    => Book::where('stok', 0)->count(), // Buku yang stoknya 0
            'buku_terbaru'  => Book::latest()->take(5)->get(), // 5 buku terakhir yang ditambah/edit
        ];

        return view('dashboard', $data);
    }
}