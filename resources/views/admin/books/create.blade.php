@extends('layouts.app')
@section('content')
 <style>
        .invalid-feedback {
            display: block !important;
        }
    </style>

    <div class="container py-4">

        <h3>Tambah Buku</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('books.form')

            <button class="btn btn-success">Simpan</button>
        </form>

    </div>
@endsection
