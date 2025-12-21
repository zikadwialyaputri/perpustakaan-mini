@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Kelola User</h3>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Tambah User</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles->pluck('name')->first() }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin hapus user ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection
