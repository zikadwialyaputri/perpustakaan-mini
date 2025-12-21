@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Edit Kategori</h3>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.categories.form')
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
