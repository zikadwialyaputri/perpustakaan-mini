@extends('layouts.app')

@section('content')
    <div class="container-fluid p-4">
        <h3>Dashboard Staff</h3>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6>Total Buku</h6>
                        <h3>{{ $totalBuku }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Buku</h5>
            <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm">
                + Tambah Buku
            </a>
        </div>

        <div class="card-body">
            <div class="row g-4">
                @foreach ($books as $book)
                    <div class="col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm">

                            {{-- COVER --}}
                            @if ($book->cover)
                                <img src="{{ asset('covers/' . $book->cover) }}" class="card-img-top"
                                    style="height: 220px; object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light"
                                    style="height: 220px;">
                                    <span class="text-muted">No Cover</span>
                                </div>
                            @endif

                            {{-- BODY --}}
                            <div class="card-body d-flex flex-column">
                                <h6 class="fw-bold mb-1">{{ $book->judul }}</h6>
                                <small class="text-muted mb-1">
                                    ✍️ {{ $book->penulis }}
                                </small>
                                <small class="text-muted">
                                    🏢 {{ $book->penerbit ?? '-' }}
                                </small>
                                <small class="text-muted mb-3">
                                    📅 {{ $book->tahun ?? '-' }}
                                </small>

                                {{-- BUTTON --}}
                                <div class="mt-auto">
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm w-100">
                                        Edit Buku
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
