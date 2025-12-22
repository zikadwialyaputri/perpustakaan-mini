@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Tambah Kategori</h3>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        @include('admin.categories.form')
        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
