@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3>Tambah Buku</h3>

    {{-- GLOBAL ERROR CARD --}}
    @if ($errors->any())
        <div class="card border-danger mb-3">
            <div class="card-header bg-danger text-white">
                Gagal menyimpan data
            </div>
            <div class="card-body text-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('books.form')

        <button class="btn btn-success">Simpan</button>
    </form>

</div>
@endsection
