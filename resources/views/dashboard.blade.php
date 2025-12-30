@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">

    {{-- ========================= GUEST ========================= --}}
    @guest
        <h3 class="mb-4">Daftar Buku</h3>

        {{-- SEARCH --}}
        <form method="GET" class="mb-4">
            <div class="input-group">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Cari judul atau penulis buku..."
                       value="{{ request('search') }}">
                <button class="btn btn-primary">Cari</button>
            </div>
        </form>

        <div class="row">
            @forelse ($books as $book)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('covers/'.$book->cover) }}"
                             class="card-img-top"
                             style="height:200px; object-fit:cover">

                        <div class="card-body">
                            <h6 class="fw-bold mb-1">{{ $book->judul }}</h6>
                            <small class="text-muted">{{ $book->penulis }}</small>

                            <div class="mt-2">
                                <span class="badge bg-info">
                                    Stok: {{ $book->stok }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Buku tidak ditemukan
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-3">
            {{ $books->links() }}
        </div>
    @endguest



    {{-- ========================= STAFF ========================= --}}
    @auth
        <h1 class="h3 mb-3"><strong>Dashboard</strong> Staff</h1>

        {{-- INFO CARD --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6>Total Buku</h6>
                        <h3>{{ $total_buku }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6>Stok Habis</h6>
                        <h3>{{ $stok_habis }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- BUKU TERBARU --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="mb-0">Buku Terbaru</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku_terbaru as $buku)
                            <tr>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->penulis }}</td>
                                <td>
                                    <span class="badge bg-{{ $buku->stok == 0 ? 'danger' : 'success' }}">
                                        {{ $buku->stok }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- DAFTAR BUKU + TAMBAH --}}
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Buku</h5>
                <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm">
                    + Tambah Buku
                </a>
            </div>

            <div class="card-body">
                <div class="row">
                    @foreach ($books as $book)
                        <div class="col-md-3 mb-4">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('covers/'.$book->cover) }}"
                                     class="card-img-top"
                                     style="height:180px; object-fit:cover">

                                <div class="card-body">
                                    <h6 class="fw-bold">{{ $book->judul }}</h6>
                                    <small>{{ $book->penulis }}</small>

                                    <div class="mt-3 d-flex justify-content-between">
                                        <a href="{{ route('books.edit', $book->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('books.destroy', $book->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin hapus buku?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{ $books->links() }}
            </div>
        </div>
    @endauth

</div>
@endsection
