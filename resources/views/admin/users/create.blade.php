@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h3>Tambah User</h3>
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.users.form')
        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
