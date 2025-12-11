@extends('layouts.app')
@section('content')
    <div class="container py-4">

        <h3>Edit Buku</h3>

        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('admin.books.form')

            <button class="btn btn-primary">Update</button>
        </form>

    </div>
@endsection
