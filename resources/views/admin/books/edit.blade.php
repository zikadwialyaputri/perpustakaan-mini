@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h3>Edit Buku</h3>
    
    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Penerbit</label>
            <input type="text" name="penerbit" class="form-control" 
                   value="{{ old('penerbit', $book->penerbit ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Tahun Terbit</label>
            <input type="number" name="tahun" class="form-control" 
                   value="{{ old('tahun', $book->tahun ?? '') }}">
        </div>

        @include('books.form')

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection