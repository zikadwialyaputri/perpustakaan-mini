@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">

        {{-- COVER --}}
        <div class="col-md-4 mb-3">
            <img
                src="{{ $book->cover
                        ? asset('covers/'.$book->cover)
                        : asset('img/no-cover.png') }}"
                class="img-fluid rounded shadow"
                alt="{{ $book->judul }}">
        </div>

        {{-- DETAIL --}}
        <div class="col-md-8">
            <h3 class="fw-bold mb-1">{{ $book->judul }}</h3>
            <p class="text-muted mb-3">
                {{ $book->penulis }}
            </p>

            <table class="table table-sm table-borderless">
                <tr>
                    <td width="140"><strong>Kategori</strong></td>
                    <td>: {{ $book->category->name ?? '-' }}</td>
                </tr>

                <tr>
                    <td><strong>Penerbit</strong></td>
                    <td>: {{ $book->penerbit ?? '-' }}</td>
                </tr>

                <tr>
                    <td><strong>Tahun Terbit</strong></td>
                    <td>: {{ $book->tahun ?? '-' }}</td>
                </tr>
            </table>

            {{-- DESKRIPSI --}}
            @if ($book->deskripsi)
                <hr>
                <h5>Deskripsi Buku</h5>
                <p style="text-align: justify;">
                    {{ $book->deskripsi }}
                </p>
            @endif

            <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">
                ← Kembali ke Koleksi
            </a>
        </div>

    </div>
</div>
@endsection
