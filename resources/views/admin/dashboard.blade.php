@extends('layouts.app')

@section('content')
    <div class="container-fluid p-4">
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
    </div>
@endsection
