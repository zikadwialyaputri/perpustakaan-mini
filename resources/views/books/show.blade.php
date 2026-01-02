@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('covers/'.$book->cover) }}"
                 class="img-fluid rounded shadow">
        </div>

        <div class="col-md-8">
            <h3>{{ $book->judul }}</h3>
            <p class="text-muted">{{ $book->penulis }}</p>

            <p>
                <strong>Kategori:</strong>
                {{ $book->category->nama ?? '-' }}
            </p>

            <p>
                <strong>Tahun:</strong> {{ $book->tahun }}
            </p>

            <p>
                <strong>Stok:</strong> {{ $book->stok }}
            </p>

            <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">
                ← Kembali
            </a>
        </div>
    </div>
</div>
@endsection
