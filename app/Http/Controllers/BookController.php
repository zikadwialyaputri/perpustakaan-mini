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

    public function edit(Book $book)
    {
        return view('books.edit', compact('book', 'categories'));
        $categories = Category::all();

    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul'       => 'required',
            'penulis'     => 'required',
            'cover'       => 'image|mimes:jpg,png,jpeg|max:2048',
            'category_id' => $request->category_id,
        ]);

        $fileName = $book->cover;

        // Jika upload cover baru
        if ($request->hasFile('cover')) {

            // Hapus file lama (jika ada)
            $oldPath = public_path('covers/' . $book->cover);
            if ($book->cover && file_exists($oldPath)) {
                unlink($oldPath);
            }

            // Upload baru
            $fileName = time() . '.' . $request->cover->extension();
            $request->cover->move(public_path('covers'), $fileName);
        }

        $book->update([
            'judul'    => $request->judul,
            'penulis'  => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun'    => $request->tahun,
            'cover'    => $fileName,
        ]);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diupdate!');
    }

    public function destroy(Book $book)
    {
        // hapus file cover
        $coverPath = public_path('covers/' . $book->cover);
        if ($book->cover && file_exists($coverPath)) {
            unlink($coverPath);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}
