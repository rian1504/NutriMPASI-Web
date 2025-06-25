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
        Auth::guard('web')->logout();

        // Menghapus token
        $request->user()->tokens()->delete();

        // return respons
        return response()->json([
            'message' => 'Berhasil Logout!',
        ]);
    }
}
