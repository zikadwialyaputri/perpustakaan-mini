<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman edit profile
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update data profile user yang sedang login
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'nickname' => 'nullable|string|max:100',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {

            if ($user->photo && file_exists(public_path('profiles/' . $user->photo))) {
                unlink(public_path('profiles/' . $user->photo));
            }
            $path = public_path('profiles');
            if (! file_exists($path)) {
                mkdir($path, 0755, true);
            }
            $manager = new ImageManager(new Driver());
            $image   = $manager->read($request->file('photo'));

            $fileName = Str::uuid() . '.jpg';

            $image->cover(300, 300)
                ->toJpeg(85)
                ->save($path . '/' . $fileName);

            $data['photo'] = $fileName;
        }

        // Update user
        $user->update($data);

        return redirect()->route('dashboard')
            ->with('success', 'Profil berhasil diperbarui');
    }
}
