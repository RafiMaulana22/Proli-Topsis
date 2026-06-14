<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $user = User::all();
        return view('Admin.User.user_index', compact('user'));
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'nama'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role'     => 'required|in:admin,super_admin',
        ], [
            'username.unique' => 'Username ini sudah dipakai, silakan pilih yang lain.',
            'email.unique'    => 'Email ini sudah terdaftar.',
            'password.min'    => 'Password minimal harus 8 karakter.',
        ]);

        // Menyimpan data
        User::create([
            'nama'     => $request->nama,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => $request->password,
            'role'     => $request->role,
        ]);

        return redirect()->back()->with('success', 'Data User berhasil ditambahkan!');
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'nama'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email'    => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8', // nullable berarti boleh kosong
            'role'     => 'required|in:admin,super_admin',
        ]);

        $dataUpdate = [
            'nama'     => $request->nama,
            'username' => $request->username,
            'email'    => $request->email,
            'role'     => $request->role,
        ];

        if ($request->filled('password')) {
            $dataUpdate['password'] = $request->password;
        }

        $user->update($dataUpdate);

        return redirect()->back()->with('success', 'Data User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Data User berhasil dihapus!');
    }

}
