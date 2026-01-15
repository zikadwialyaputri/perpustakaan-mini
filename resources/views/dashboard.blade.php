@extends('layouts.app')

@section('styles')
    <style>
        .book-card-guest {
            border-radius: 18px;
            background: #fff;

            border: 1px solid rgba(0, 0, 0, 0.04);

            box-shadow:
                0 10px 25px rgba(0, 0, 0, 0.10),
                0 4px 10px rgba(0, 0, 0, 0.05);

            transition: all 0.25s ease;
            overflow: hidden;
        }

        .book-card-guest:hover {
            transform: translateY(-6px);
            box-shadow:
                0 18px 40px rgba(0, 0, 0, 0.14),
                0 6px 14px rgba(0, 0, 0, 0.08);
        }

        .book-card-guest .book-cover {
            height: 220px;
            object-fit: cover;
            background: #f4f6f8;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid p-4">

        <div class="hero-mini">
            <h2>📚 Jelajahi Koleksi Buku</h2>
            <p>Temukan bacaan terbaik untuk menemani harimu</p>
        </div>
        <div class="search-box">
            {{-- SEARCH + FILTER --}}
            <form method="GET" action="{{ route('dashboard') }}" class="row mb-4 g-2">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Cari judul atau penulis buku..."
                        value="{{ request('search') }}">
                </div>

                <div class="col-md-4">
                    <select name="category" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <button class="btn btn-primary w-100">
                        Cari
                    </button>
                </div>
            </form>
        </div>
        {{-- LIST BUKU --}}
        <h5 class="mb-3 fw-semibold d-flex justify-content-between align-items-center">
            <span>📖 Koleksi Buku</span>
            <span class="text-muted fs-6">{{ $books->total() }} buku</span>
        </h5>
        <div class="row">
            @forelse ($books as $book)
                <div class="col-md-3 mb-4">

                    <a href="{{ route('books.show', $book->id) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 book-card book-card-guest">

                            <img src="{{ $book->cover ? asset('covers/' . $book->cover) : asset('img/no-cover.png') }}"
                                class="card-img-top book-cover" alt="Cover {{ $book->judul }}" loading="lazy">

                            <div class="card-body">
                                <h6 class="fw-bold mb-1">
                                    {{ $book->judul }}
                                </h6>

                                <small class="text-muted d-block">
                                    {{ $book->penulis }}
                                </small>

                                @if ($book->penerbit || $book->tahun)
                                    <small class="text-muted">
                                        {{ $book->penerbit }}
                                        @if ($book->tahun)
                                            • {{ $book->tahun }}
                                        @endif
                                    </small>
                                @endif
                                @if ($book->category)
                                    <div class="mt-2">
                                        <span class="badge bg-secondary">
                                            {{ $book->category->name }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </a>

                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Buku tidak ditemukan
                    </div>
                </div>
            @endforelse
        </div>
        @guest
            <div class="mt-4">
                {{ $books->links('pagination.guest') }}
            </div>
        @endguest

    </div>
@endsection
