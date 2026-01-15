@extends('layouts.app')

@section('content')
    <div class="container-fluid p-4">

        {{-- ALERT SUCCESS --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- GREETING --}}
        <div class="hero-mini mb-4">
            <h4 class="mb-1">
                👋 Selamat datang,
                {{ auth()->user()->nickname ?? auth()->user()->name }}
            </h4>

            <p class="text-muted mb-0">
                Semoga harimu menyenangkan 🌱
            </p>
        </div>

        {{-- JUDUL --}}
        <h3 class="mb-4">Dashboard Staff</h3>

        {{-- STATISTIK --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm dashboard-card">
                    <div class="card-body">
                        <h6 class="text-muted">Total Buku</h6>
                        <h3 class="mb-0">{{ $totalBuku }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- DAFTAR BUKU --}}
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Buku</h5>
                <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm">
                    + Tambah Buku
                </a>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    @forelse ($books as $book)
                        <div class="col-md-4 col-lg-3">
                            <a href="{{ route('books.show', $book->id) }}" class="text-decoration-none text-dark">
                                <div class="book-card h-100">

                                    {{-- COVER --}}
                                    @if ($book->cover)
                                        <img src="{{ asset('covers/' . $book->cover) }}" class="book-cover"
                                            alt="{{ $book->judul }}">
                                    @else
                                        <div class="book-cover d-flex align-items-center justify-content-center">
                                            <span class="text-muted">No Cover</span>
                                        </div>
                                    @endif

                                    {{-- BODY --}}
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="fw-bold mb-1">{{ $book->judul }}</h6>

                                        <small class="text-muted mb-1">
                                            ✍️ {{ $book->penulis }}
                                        </small>

                                        <small class="text-muted mb-1">
                                            🏢 {{ $book->penerbit ?? '-' }}
                                        </small>

                                        <small class="text-muted mb-3">
                                            📅 {{ $book->tahun ?? '-' }}
                                        </small>

                                        {{-- ACTION --}}
                                        <a href="{{ route('books.edit', $book->id) }}"
                                            class="btn btn-warning btn-sm mt-auto w-100">
                                            Edit Buku
                                        </a>
                                    </div>
                                </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <span class="text-muted fst-italic">
                                Belum ada buku.
                            </span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="mt-4">
            {{ $books->links('pagination.guest') }}
        </div>

    </div>
@endsection
