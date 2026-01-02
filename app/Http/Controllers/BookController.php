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
            'judul'       => 'required',
            'penulis'     => 'required',
            'penerbit'    => 'required',
            'tahun'       => 'required|numeric',
            'deskripsi'   => 'required',
            'cover'       => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
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
            'deskripsi'   => $request->deskripsi,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'category_id' => 'required',
            'judul'       => 'required',
            'penulis'     => 'required',
            'penerbit'    => 'required',
            'tahun'       => 'required|numeric',
            'deskripsi'   => 'required',
            'cover'       => 'nullable|image|mimes:jpg,png,jpeg|max:2048',

        ]);
        $data = [
            'category_id' => $request->category_id,
            'judul'       => $request->judul,
            'penulis'     => $request->penulis,
            'penerbit'    => $request->penerbit,
            'tahun'       => $request->tahun,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('cover')) {
            if ($book->cover && file_exists(public_path('covers/' . $book->cover))) {
                unlink(public_path('covers/' . $book->cover));
            }

            $fileName = time() . '.' . $request->cover->extension();
            $request->cover->move(public_path('covers'), $fileName);
            $data['cover'] = $fileName;
        }

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
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
}
