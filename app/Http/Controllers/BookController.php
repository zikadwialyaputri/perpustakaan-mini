<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::when($request->search, function ($q) use ($request) {
            $q->where(function ($sub) use ($request) {
                $sub->where('judul', 'like', "%{$request->search}%")
                    ->orWhere('penulis', 'like', "%{$request->search}%");
            });
        })
            ->latest()
            ->paginate(10);

        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string|max:255',
            'penerbit'    => 'required|string|max:255',
            'tahun'       => 'required|digits:4',
            'deskripsi'   => 'required|string',
            'cover'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'category_id.required' => 'Kategori wajib dipilih',
            'judul.required'       => 'Judul buku wajib diisi',
            'penulis.required'     => 'Penulis wajib diisi',
            'penerbit.required'    => 'Penerbit wajib diisi',
            'tahun.required'       => 'Tahun wajib diisi',
            'tahun.digits'         => 'Tahun harus 4 digit',
            'deskripsi.required'   => 'Deskripsi wajib diisi',
        ]);

        $fileName = null;

        if ($request->hasFile('cover')) {
            $image = $request->file('cover');

            $fileName = Str::uuid() . '.jpg';

            $manager = new ImageManager(new Driver());

            $img = $manager->read($image)
                ->cover(600, 900) // ukuran konsisten
                ->toJpeg(85);     // kompres rapi

            $img->save(public_path('covers/' . $fileName));
        }

        Book::create([
            'category_id' => $request->category_id,
            'judul'       => $request->judul,
            'penulis'     => $request->penulis,
            'penerbit'    => $request->penerbit,
            'tahun'       => $request->tahun,
            'deskripsi'   => $request->deskripsi,
            'cover'       => $fileName,
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string|max:255',
            'penerbit'    => 'required|string|max:255',
            'tahun'       => 'required|digits:4',
            'deskripsi'   => 'required|string',
            'cover'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'category_id.required' => 'Kategori wajib dipilih',
            'judul.required'       => 'Judul buku wajib diisi',
            'penulis.required'     => 'Penulis wajib diisi',
            'penerbit.required'    => 'Penerbit wajib diisi',
            'tahun.required'       => 'Tahun wajib diisi',
            'tahun.digits'         => 'Tahun harus 4 digit',
            'deskripsi.required'   => 'Deskripsi wajib diisi',
        ]);

        $data = $request->only([
            'category_id',
            'judul',
            'penulis',
            'penerbit',
            'tahun',
            'deskripsi',
        ]);

        if ($request->hasFile('cover')) {

            // hapus cover lama
            if ($book->cover && file_exists(public_path('covers/' . $book->cover))) {
                unlink(public_path('covers/' . $book->cover));
            }

            $fileName = Str::uuid() . '.jpg';

            $manager = new ImageManager(new Driver());

            $img = $manager
                ->read($request->file('cover'))
                ->cover(600, 900) // ukuran konsisten
                ->toJpeg(85);     // kompres rapi

            $img->save(public_path('covers/' . $fileName));

            $data['cover'] = $fileName;
        }

        $book->update($data);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(Book $book)
    {
        if ($book->cover && file_exists(public_path('covers/' . $book->cover))) {
            unlink(public_path('covers/' . $book->cover));
        }

        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus!');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
}
