@extends('layouts.app')

@section('content')
    <div class="container-fluid p-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        <h4 class="mb-1">
            👋 Selamat datang,
            {{ auth()->user()->nickname ?? auth()->user()->name }}
        </h4>

        <p class="text-muted mb-4">
            Semoga harimu menyenangkan 🌱
        </p>
        <h3 class="mb-4">Dashboard Admin</h3>

        <div class="row">

            {{-- TOTAL BUKU --}}
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6>Total Buku</h6>
                        <h2>{{ $totalBuku }}</h2>
                        <a href="{{ route('books.index') }}" class="btn btn-sm btn-outline-primary mt-2">
                            Kelola Buku
                        </a>
                    </div>
                </div>
            </div>

            {{-- TOTAL KATEGORI --}}
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6>Total Kategori</h6>
                        <h2>{{ $totalKategori }}</h2>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-success mt-2">
                            Kelola Kategori
                        </a>
                    </div>
                </div>
            </div>

            {{-- TOTAL USER --}}
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6>Total User</h6>
                        <h2>{{ $totalUser }}</h2>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-warning mt-2">
                            Kelola User
                        </a>
                    </div>
                </div>
            </div>

        </div>
        {{-- DAFTAR BUKU --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="mb-0">Daftar Buku</h5>
                    <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm">
                        + Tambah Buku
                    </a>
                </div>

                <div class="row g-4">
                    @forelse ($books as $book)
                        <div class="col-md-4 col-lg-3">
                            <div class="card h-100 shadow-sm">

                                {{-- COVER --}}
                                @if ($book->cover)
                                    <img src="{{ asset('covers/' . $book->cover) }}" class="card-img-top"
                                        style="height:220px;object-fit:cover;">
                                @else
                                    <div class="d-flex justify-content-center align-items-center bg-light"
                                        style="height:220px;">
                                        <span class="text-muted">No Cover</span>
                                    </div>
                                @endif

                                {{-- BODY --}}
                                <div class="card-body d-flex flex-column">
                                    <h6 class="fw-bold">{{ $book->judul }}</h6>
                                    <small class="text-muted">✍️ {{ $book->penulis }}</small>
                                    <small class="text-muted">🏢 {{ $book->penerbit ?? '-' }}</small>
                                    <small class="text-muted mb-3">📅 {{ $book->tahun ?? '-' }}</small>

                                    <a href="{{ route('books.edit', $book->id) }}"
                                        class="btn btn-warning btn-sm mt-auto w-100">
                                        Edit Buku
                                    </a>
                                </div>

                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center">Belum ada buku</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
