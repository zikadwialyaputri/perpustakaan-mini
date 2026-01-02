@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Edit Profile</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', auth()->user()->name) }}">
        </div>

        <div class="mb-3">
            <label>Nama Panggilan</label>
            <input type="text" name="nickname" class="form-control"
                   value="{{ old('nickname', auth()->user()->nickname) }}">
        </div>

        <div class="mb-3">
            <label>Foto Profil</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
