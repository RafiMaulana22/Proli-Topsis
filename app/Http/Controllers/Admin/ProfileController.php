<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('Admin.User.profile_index');
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'nama'         => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'        => 'required|email|max:255|unique:users,email,' . $user->id,
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'username.unique'         => 'Username ini sudah dipakai oleh pengguna lain.',
            'email.unique'            => 'Email ini sudah terdaftar pada akun lain.',
            'foto_profile.image'      => 'File harus berupa gambar.',
            'foto_profile.mimes'      => 'Format gambar harus jpeg, png, atau jpg.',
            'foto_profile.max'        => 'Ukuran foto maksimal adalah 2MB.',
        ]);

        $user->nama     = $request->nama;
        $user->username = $request->username;
        $user->email    = $request->email;

        if ($request->hasFile('foto_profile')) {

            if ($user->foto_profile && Storage::disk('public')->exists($user->foto_profile)) {
                Storage::disk('public')->delete($user->foto_profile);
            }

            $path = $request->file('foto_profile')->store('foto_profile', 'public');

            $user->foto_profile = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Data profil dan foto berhasil diperbarui!');
    }


    public function updatePassword(Request $request)
    {
        // Validasi aturan password
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'new_password.min'       => 'Password baru minimal harus 8 karakter!',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok!',
        ]);

        $user = $request->user();

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Password lama yang Anda masukkan salah!']);
        }

        $user->update([
            'password' => $request->new_password,
        ]);

        return redirect()->back()->with('success', 'Password Anda berhasil diubah dengan aman!');
    }
}
