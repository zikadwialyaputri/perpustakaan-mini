@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Data Kategori</h3>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            + Tambah Kategori
        </a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($book as $item)
            <tr>
                <td>
                    <a href="{{ route('books.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('books.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}
</div>
@endsection