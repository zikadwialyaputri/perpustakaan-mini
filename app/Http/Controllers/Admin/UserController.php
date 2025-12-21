<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required'
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole($data['role']);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required'
        ]);

        $user->update($data);
        $user->syncRoles($data['role']);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus');
    }
}
