@extends('layouts.app')
@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Buku</h3>

        <a href="{{ route('books.create') }}" class="btn btn-primary">+ Tambah Buku</a>
    </div>

    <form method="GET" class="mb-3">
        <input type="text" name="search" placeholder="Cari judul..." class="form-control"
            value="{{ request('search') }}">
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($book as $item)
            <tr>
                <td>
                    @if ($item->cover)
                    <img src="{{ asset('covers/' . $item->cover) }}" width="80">
                    @else
                    <span class="text-muted">Tidak ada</span>
                    @endif
                </td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->penulis }}</td>
                <td>{{ $item->penerbit }}</td>
                <td>{{ $item->tahun }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('books.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('books.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </tbody>
    </table>

    {{ $book->links() }}

</div>
@endsection