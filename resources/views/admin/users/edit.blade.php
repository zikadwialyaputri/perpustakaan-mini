@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3>Edit User</h3>

    {{-- GLOBAL ERROR --}}
    @if ($errors->any())
        <div class="card border-danger mb-3">
            <div class="card-header bg-danger text-white">
                Gagal mengupdate user
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

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.users.form')

        <button class="btn btn-primary">Update</button>
    </form>

</div>
@endsection
