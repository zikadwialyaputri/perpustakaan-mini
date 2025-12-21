<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $book = Book::when($request->search, function ($q) use ($request) {
            $q->where(function ($sub) use ($request) {
                $sub->where('judul', 'like', "%{$request->search}%")
                    ->orWhere('penulis', 'like', "%{$request->search}%");
            });
        })
            ->orderByDesc('id')
            ->paginate(10);

        return view('books.index', compact('book'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required',
            'penulis' => 'required',
            'cover'   => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $fileName = null;

        // Upload cover
        if ($request->hasFile('cover')) {
            $fileName = time() . '.' . $request->cover->extension();
            $request->cover->move(public_path('covers'), $fileName);
        }

        Book::create([
            'judul'       => $request->judul,
            'penulis'     => $request->penulis,
            'penerbit'    => $request->penerbit,
            'tahun'       => $request->tahun,
            'cover'       => $fileName,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    // Tambahkan ini di paling atas file jika belum ada
    public function edit(Book $book)
    {
        // Ambil semua data kategori dari database
        $categories = Category::all();

        // Sekarang variabel $categories sudah tersedia untuk dikirim ke view
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        // 1. Validasi menggunakan nama input yang ada di Blade
        $request->validate([
            'category_id' => 'required',
            'judul'       => 'required', // Sesuaikan dengan name="judul"
            'penulis'     => 'required', // Sesuaikan dengan name="penulis"
            'penerbit'    => 'required',
            'tahun'       => 'required|numeric',
            'cover'       => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // 2. Siapkan data untuk update
        $data = [
            'category_id' => $request->category_id,
            'judul'       => $request->judul,
            'penulis'     => $request->penulis,
            'penerbit'    => $request->penerbit,
            'tahun'       => $request->tahun,
        ];

        // 3. Logika Upload Foto (Jika ada file baru)
        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada di folder public/covers
            if ($book->cover && file_exists(public_path('covers/' . $book->cover))) {
                unlink(public_path('covers/' . $book->cover));
            }

            $fileName = time() . '.' . $request->cover->extension();
            $request->cover->move(public_path('covers'), $fileName);
            $data['cover'] = $fileName;
        }

        // 4. Eksekusi Update ke Database
        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui!');
    }
    public function destroy(Book $book)
    {
        // Hapus file fisik cover jika ada
        $coverPath = public_path('covers/' . $book->cover);
        if ($book->cover && file_exists($coverPath)) {
            unlink($coverPath);
        }

        // Hapus data dari database
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}
