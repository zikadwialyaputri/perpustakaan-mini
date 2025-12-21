@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h3>Edit User</h3>
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.users.form')
        <button class="btn btn-warning">Update</button>
    </form>
</div>
@endsection
