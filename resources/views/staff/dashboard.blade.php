@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">

    {{-- 1. FORM PENCARIAN (Muncul untuk semua orang: Guest & Auth) --}}
    <form action="{{ route('dashboard') }}" method="GET" class="mb-4">
        <div class="input-group shadow-sm">
            <input type="text" name="search" class="form-control" placeholder="Cari judul atau penulis buku..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    {{-- 2. BAGIAN KHUSUS STAFF/ADMIN (Hanya muncul jika sudah Login) --}}
    @auth
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <div class="card bg-primary text-white shadow-sm border-0">
                <div class="card-body py-2">
                    <h5 class="card-title mb-0">Total Koleksi: {{ $total_buku }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-end">
            {{-- Tombol Tambah disembunyikan dari Guest dengan @auth --}}
            <a href="{{ route('books.create') }}" class="btn btn-success shadow-sm">+ Tambah Buku Baru</a>
        </div>
    </div>
    @endauth

    {{-- 3. DAFTAR BUKU (Dilihat oleh semua orang termasuk Guest) --}}
    <div class="row">
        @forelse ($books as $book) {{-- Perulangan untuk setiap data buku --}}
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                {{-- Menampilkan Gambar Cover --}}
                @if($book->cover)
                    <img src="{{ asset('covers/'.$book->cover) }}" class="card-img-top" style="height:250px; object-fit:cover" alt="{{ $book->judul }}">
                @else
                    <div class="bg-light text-center py-5" style="height:250px">Tidak Ada Cover</div>
                @endif
                
                <div class="card-body">
                    <h6 class="fw-bold text-dark">{{ $book->judul }}</h6> {{-- Variabel $book hanya boleh dipanggil di sini --}}
                    <p class="text-muted small mb-3">Penulis: {{ $book->penulis }}</p>

                    {{-- 4. TOMBOL EDIT & HAPUS (Hanya muncul jika user LOGIN) --}}
                    @auth {{-- Pembatasan fitur untuk Guest --}}
                    <div class="d-flex gap-2 border-top pt-3">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning w-100">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="w-100">
                            @csrf 
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger w-100" onclick="return confirm('Hapus buku ini?')">Hapus</button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <h5 class="text-muted italic">Buku tidak ditemukan.</h5>
        </div>
        @endforelse
    </div>

    {{-- 5. NAVIGASI HALAMAN (PAGINATION) --}}
    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>
@endsection