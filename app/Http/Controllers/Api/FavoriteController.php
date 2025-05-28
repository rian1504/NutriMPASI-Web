<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // method untuk menampilkan data favorite
    public function index()
    {
        // mengambil id user
        $userId = Auth::id();

        // mengambil data favorites berdasarkan user
        $favorites = Favorite::select('food_id')
            ->with(['food' => function ($query) {
                $query->select('id', 'name', 'image', 'description');
            }])
            ->where('user_id', $userId)
            ->get();

        // return respon JSON
        return response()->json([
            'data' => $favorites,
            'message' => 'Berhasil mengambil data favorites',
        ]);
    }

    // method untuk menambahkan/menghapus makanan ke favorit
    public function store(Food $food)
    {
        // mengambil id user
        $userId = Auth::id();

        // Toggle favorite status
        $food->favorites()->toggle($userId);

        // cek apakah user sudah menyukai makanan ini
        $isFavorite = $food->favorites()->where('user_id', $userId)->exists();

        $message = $isFavorite
            ? 'Berhasil menambahkan makanan ke favorit'
            : 'Berhasil menghapus makanan dari favorit';

        return response()->json([
            'message' => $message,
        ]);
    }
}
