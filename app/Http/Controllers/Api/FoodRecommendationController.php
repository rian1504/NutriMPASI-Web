<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FoodRecommendationController extends Controller
{
    // method untuk mengambil data makanan berdasarkan user
    public function index()
    {
        // ambil user id
        $userId = Auth::id();

        // ambil data makanan
        $food = Food::select('id', 'name', 'image', 'description')
            ->withCount('favorites')
            ->where('user_id', $userId)
            ->paginate(5);

        // return response JSON
        return response()->json([
            'data' => $food,
            'message' => 'Berhasil mengambil data makanan user',
        ]);
    }

    // method untuk menambah data makanan
    public function store(Request $request)
    {
        // validasi request
        $request->validate([
            'food_category_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
            'age' => ['required', 'string'],
            'energy' => ['required', 'numeric'],
            'protein' => ['required', 'numeric'],
            'fat' => ['required', 'numeric'],
            'portion' => ['required', 'integer'],
            'fruit' => ['nullable', 'string'],
            'recipe' => ['required', 'string', 'min:20'],
            'step' => ['required', 'string', 'min:20'],
            'description' => ['required', 'string', 'min:10'],
        ]);

        // Mengambil id user
        $userId = Auth::user()->id;

        // Upload gambar
        $image = $request->file('image');
        $image->storeAs('image/foods', $image->hashName());

        // membuat data makanan
        $food = Food::create([
            'food_category_id' => $request->food_category_id,
            'user_id' => $userId,
            'name' => $request->name,
            'source' => $request->source,
            'image' => 'image/foods/' . $image->hashName(),
            'age' => $request->age,
            'energy' => $request->energy,
            'protein' => $request->protein,
            'fat' => $request->fat,
            'portion' => $request->portion,
            'fruit' => $request->fruit,
            'recipe' => $request->recipe,
            'step' => $request->step,
            'description' => $request->description,
        ]);

        // return response JSON
        return response()->json([
            'data' => $food,
            'message' => 'Berhasil menambah data makanan',
        ]);
    }

    // method untuk menampilkan detail makanan
    public function show(Food $food_recommendation)
    {
        // Ambil data food beserta relasi food_category
        $food_recommendation = $food_recommendation->load(['food_category' => function ($query) {
            $query->select('id', 'name');
        }]);

        // filter data yang ingin disembunyikan
        $food_recommendation = $food_recommendation->makeHidden(['created_at', 'updated_at']);

        // Hitung jumlah record di tabel favorites yang terkait dengan food ini
        $favoriteCount = $food_recommendation->favorites()->count();

        // Tambahkan jumlah record ke data yang akan dikembalikan
        $food_recommendation['favorite_count'] = $favoriteCount;

        // return response JSON
        return response()->json([
            'data' => $food_recommendation,
            'message' => 'Berhasil mengambil detail data makanan user',
        ]);
    }

    // method untuk update data makanan
    public function update(Request $request, Food $food_recommendation)
    {
        // validasi request
        $validatedData = $request->validate([
            'food_category_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
            'age' => ['required', 'string'],
            'energy' => ['required', 'numeric'],
            'protein' => ['required', 'numeric'],
            'fat' => ['required', 'numeric'],
            'portion' => ['required', 'integer'],
            'fruit' => ['nullable', 'string'],
            'recipe' => ['required', 'string', 'min:20'],
            'step' => ['required', 'string', 'min:20'],
            'description' => ['required', 'string', 'min:10'],
        ]);

        // Jika ada gambar baru
        if ($request->hasFile('image')) {
            // Delete image lama
            if ($food_recommendation->image && Storage::exists($food_recommendation->image)) {
                Storage::delete($food_recommendation->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('image/foods');
            $validatedData['image'] = $imagePath;
        }

        // Update the food recommendation data
        $food_recommendation->update($validatedData);

        // return response JSON
        return response()->json([
            'data' => $food_recommendation,
            'message' => 'Berhasil mengubah data makanan',
        ]);
    }

    // method untuk menghapus data makanan
    public function destroy(Food $food_recommendation)
    {
        // jika ada image
        if ($food_recommendation->image && Storage::exists($food_recommendation->image)) {
            // delete image
            Storage::delete($food_recommendation->image);
        }

        // delete data
        $food_recommendation->delete();

        // return response JSON
        return response()->json([
            'message' => 'Data makanan berhasil dihapus',
        ]);
    }
}