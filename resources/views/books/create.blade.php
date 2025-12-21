@extends('layouts.app')
@section('content')
    <div class="container py-4">

        <h3>Tambah Buku</h3>

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('books.form')

            <button class="btn btn-success">Simpan</button>
        </form>

    </div>
@endsection