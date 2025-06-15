<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // method untuk mengambil data user
    public function index(Request $request)
    {
        // mengambil data user
        $user = $request->user();

        // return respons JSON
        return response()->json([
            'data' => $user,
            'message' => 'Berhasil mengambil data user'
        ]);
    }

    // method untuk update profile
    public function updateProfile(Request $request, User $user)
    {
        // validasi input
        $validatedData = $request->validate([
            'name' => 'required|min:4',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:1024'
            ],
        ]);

        // Menangani upload avatar jika ada
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar && Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }

            // Simpan avatar baru
            $avatarPath = $request->file('avatar')->store('image/avatars');
            $validatedData['avatar'] = $avatarPath;
        }

        // Update User Profile
        $user->update($validatedData);

        // Mengembalikan response API
        return response()->json([
            'user' => $user,
            'message' => 'Berhasil mengubah profil',
        ]);
    }

    // method untuk update password
    public function updatePassword(Request $request, User $user)
    {
        // Validasi input
        $request->validate([
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            // Mengembalikan response API Gagal
            return response()->json([
                'message' => 'Password lama tidak sesuai!'
            ], 400);
        }

        // Jika password sesuai
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Mengembalikan response API
        return response()->json([
            'message' => 'Berhasil mengubah password'
        ]);
    }
}
