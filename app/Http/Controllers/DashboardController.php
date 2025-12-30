<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index(Request $request)
{
    // 1. Logika Pencarian (Bisa untuk semua orang)
    $search = $request->query('search');
    $books = \App\Models\Book::when($search, function($query, $search) {
        return $query->where('judul', 'like', "%{$search}%")
                     ->orWhere('penulis', 'like', "%{$search}%");
    })->paginate(8);

    // 2. Data Statistik (Penyebab error jika tidak didefinisikan)
    // Kita definisikan di luar agar Guest tetap punya variabel ini meskipun isinya 0 atau data publik
    $total_buku = \App\Models\Book::count();
    $stok_habis = \App\Models\Book::where('stok', 0)->count();
    $buku_terbaru = \App\Models\Book::latest()->take(5)->get();

    return view('staff.dashboard', compact(
        'books', 'total_buku', 'stok_habis', 'buku_terbaru'
    ));
    }
}
