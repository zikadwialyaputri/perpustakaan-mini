@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3>Tambah User</h3>

    {{-- GLOBAL ERROR --}}
    @if ($errors->any())
        <div class="card border-danger mb-3">
            <div class="card-header bg-danger text-white">
                Gagal menyimpan user
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

    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('admin.users.form')

        <button class="btn btn-primary">Simpan</button>
    </form>

</div>
@endsection
