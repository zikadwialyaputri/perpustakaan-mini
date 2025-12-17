<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Book;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Mengambil data peminjaman untuk ditampilkan di view
        $peminjamans = Peminjaman::with(['book', 'user'])->latest()->get();
        return view('staff.peminjaman', compact('peminjamans'));
    }

    public function validasi($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        $pinjam->update(['status' => 'dipinjam']);
        
        // Mengurangi stok buku secara otomatis
        $pinjam->book->decrement('stok');
        
        return back()->with('success', 'Peminjaman telah divalidasi.');
    }

    public function kembali($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        $pinjam->update(['status' => 'kembali', 'tgl_kembali' => now()]);
        
        // Mengembalikan stok buku
        $pinjam->book->increment('stok');
        
        return back()->with('success', 'Buku telah dikembalikan.');
    }
}