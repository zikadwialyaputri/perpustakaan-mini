<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
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
            'role'     => 'required',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($request->hasFile('photo')) {
            $manager = new ImageManager(new Driver());

            $image = $manager->read($request->file('photo'));

            $fileName = Str::uuid() . '.jpg';

            $image->cover(300, 300)
                ->toJpeg(85)
                ->save(public_path('profiles/' . $fileName));

            $data['photo'] = $fileName;
        }


        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'photo'    => $data['photo'] ?? null,
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
            'role'  => 'required',
        ]);
        if ($request->hasFile('photo')) {

            if ($user->photo && file_exists(public_path('profiles/' . $user->photo))) {
                unlink(public_path('profiles/' . $user->photo));
            }
            $manager = new ImageManager(new Driver());

            $image = $manager->read($request->file('photo'));

            $fileName = Str::uuid() . '.jpg';

            $image->cover(300, 300) // crop + resize
                ->toJpeg(85)            // kompres
                ->save(public_path('profiles/' . $fileName));

            $data['photo'] = $fileName;
        }

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
