<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function view()
    {
        return view('profile.view');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'telp' => 'nullable|numeric',
            'address' => 'nullable|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'telp.numeric' => 'Nomor telepon harus berupa angka.',
            'address.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            'profile_picture.image' => 'File harus berupa gambar.',
            'profile_picture.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'profile_picture.max' => 'Ukuran gambar maksimal 2MB.'
        ]);

        $user = User::find(Auth::id());

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $profile_picture;
        }

        $user->name = $request->name;
        $user->telp = $request->telp;
        $user->address = $request->address;
        $user->update();

        return redirect()->route('profile.view')->with('success', 'Profile updated successfully!');
    }
}
