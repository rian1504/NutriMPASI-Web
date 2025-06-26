<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $user = $request->user();

        // comment this for load testing
        $user->tokens()->delete();

        // Simpan FCM token jika ada
        if ($request->has('fcm_token') && $request->fcm_token) {
            $user->fcm_token = $request->fcm_token;
            $user->save();
        }

        // Membuat token
        $userToken = $user->createToken('user-token')->plainTextToken;

        // return data
        return response()->json([
            'user' => $user,
            'token' => $userToken,
            'message' => 'Berhasil Login!',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        // Dapatkan user sebelum logout
        $user = $request->user();

        // Hapus FCM token dari database
        if ($user->fcm_token) {
            $user->fcm_token = null;
            $user->save();
        }

        Auth::guard('web')->logout();

        // Menghapus token
        $request->user()->tokens()->delete();

        // return respons
        return response()->json([
            'message' => 'Berhasil Logout!',
        ]);
    }
}
