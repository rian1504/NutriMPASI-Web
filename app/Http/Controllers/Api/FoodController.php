<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    // method untuk mengambil semua data makanan
    public function index()
    {
        // ambil data food dengan pagination 10 data
        $data = Food::select('id', 'user_id', 'name', 'source', 'image')
            ->withCount('favorites')
            ->paginate(10);

        // return response JSON
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil mengambil semua data makanan',
        ]);
    }

    // method untuk memfilter data makanan
    public function filter(Request $request)
    {
        // validasi input
        $request->validate([
            'search' => ['nullable', 'string'],
            'food_category_id' => ['nullable', 'integer'],
            'source' => ['nullable', 'string'],
            'age' => ['nullable', 'string'],
        ]);

        // ambil data food dengan pagination 10 data
        $data = Food::select('id', 'user_id', 'name', 'source', 'image')
            ->withCount('favorites')
            ->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->food_category_id, function ($query) use ($request) {
                return $query->where('food_category_id', $request->food_category_id);
            })
            ->when($request->source, function ($query) use ($request) {
                return $query->where('source', $request->source);
            })
            ->when($request->age, function ($query) use ($request) {
                return $query->where('age', $request->age);
            })
            ->paginate(10);

        // return response JSON
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil memfilter data makanan',
        ]);
    }

    // method untuk menampilkan detail data makanan
    public function show(Food $food)
    {
        // filter data yang ingin disembunyikan
        $food = $food->makeHidden([
            'food_category_id',
            'recipe',
            'step',
            'created_at',
            'updated_at',
        ]);

        // mengambil id user
        $userId = Auth::id();

        // cek apakah user sudah menyukai makanan ini
        $isFavorite = $food->favorites()->where('user_id', $userId)->exists();

        // tambahkan informasi apakah makanan ini sudah difavoritkan
        $food->is_favorite = $isFavorite;

        // return response JSON
        return response()->json([
            'data' => $food,
            'message' => 'Berhasil mengambil detail data makanan',
        ]);
    }

    // method untuk menambahkan/menghapus makanan ke favorit
    public function favorite(Food $food)
    {
        // mengambil id user
        $userId = Auth::id();

        // Toggle favorite status
        $food->favoritedBy()->toggle($userId);

        // cek apakah user sudah menyukai makanan ini
        $isFavorite = $food->favoritedBy()->where('user_id', $userId)->exists();

        $message = $isFavorite
            ? 'Berhasil menambahkan makanan ke favorit'
            : 'Berhasil menghapus makanan dari favorit';

        return response()->json([
            'message' => $message,
        ]);
    }
}