<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request; // Tambahkan ini agar tidak error

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Logika Pencarian (Bisa untuk semua orang)
        $search = $request->query('search');

        $books = Book::when($search, function ($query, $search) {
            return $query->where('judul', 'like', "%{$search}%")
                ->orWhere('penulis', 'like', "%{$search}%");
        })->paginate(8);

        // 2. Data Statistik (Ganti 'stok' dengan nama kolom yang benar di DB Anda)
        // Kirim data dasar saja agar Guest tidak error
        $total_buku = Book::count();
        // Jika kolom stok tidak ada, baris ini sementara bisa dikomentari agar tidak error:
        // $stok_habis = Book::where('stok', 0)->count(); 
        $stok_habis = 0; // Nilai sementara agar tidak error undefined variable
        $buku_terbaru = Book::latest()->take(5)->get();

        return view('staff.dashboard', compact(
            'books',
            'total_buku',
            'stok_habis',
            'buku_terbaru'
        ));
    }
}
