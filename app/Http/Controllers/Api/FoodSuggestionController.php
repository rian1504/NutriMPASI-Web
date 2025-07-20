<?php

namespace App\Http\Controllers\Api;

use App\Models\Food;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FoodSuggestionController extends Controller
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
            'recipe' => ['required', 'string', 'min:5'],
            'step' => ['required', 'string', 'min:5'],
            'description' => ['required', 'string', 'min:5'],
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
    public function show(Food $food_suggestion)
    {
        // Ambil data food beserta relasi food_category
        $food_suggestion = $food_suggestion->load(['food_category' => function ($query) {
            $query->select('id', 'name');
        }]);

        // filter data yang ingin disembunyikan
        $food_suggestion = $food_suggestion->makeHidden(['source', 'created_at', 'updated_at']);

        // Konversi string ke array
        $food_suggestion['recipe'] = explode(';', $food_suggestion->recipe);
        $food_suggestion['fruit'] = explode(';', $food_suggestion->fruit);
        $food_suggestion['step'] = explode(';', $food_suggestion->step);

        // filter data yang ingin disembunyikan
        $food_suggestion = $food_suggestion->makeHidden([
            'user_id'
        ]);

        // Hitung jumlah record di tabel favorites yang terkait dengan food ini
        $favoriteCount = $food_suggestion->favorites()->count();

        // Tambahkan jumlah record ke data yang akan dikembalikan
        $food_suggestion['favorite_count'] = $favoriteCount;

        // return response JSON
        return response()->json([
            'data' => $food_suggestion,
            'message' => 'Berhasil mengambil detail data makanan user',
        ]);
    }

    // method untuk update data makanan
    public function update(Request $request, Food $food_suggestion)
    {
        // validasi request
        $validatedData = $request->validate([
            'food_category_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
            'age' => ['required', 'string'],
            'energy' => ['required', 'numeric'],
            'protein' => ['required', 'numeric'],
            'fat' => ['required', 'numeric'],
            'portion' => ['required', 'integer'],
            'fruit' => ['nullable', 'string'],
            'recipe' => ['required', 'string', 'min:5'],
            'step' => ['required', 'string', 'min:5'],
            'description' => ['required', 'string', 'min:5'],
        ]);

        // Jika ada gambar baru
        if ($request->hasFile('image')) {
            // Delete image lama
            if ($food_suggestion->image && Storage::exists($food_suggestion->image)) {
                Storage::delete($food_suggestion->image);
            }

            // Store image baru
            $imagePath = $request->file('image')->store('image/foods');
            $validatedData['image'] = $imagePath;
        }

        // Update data makanan
        $food_suggestion->update($validatedData);

        // return response JSON
        return response()->json([
            'data' => $food_suggestion,
            'message' => 'Berhasil mengubah data makanan',
        ]);
    }

    // method untuk menghapus data makanan
    public function destroy(Food $food_suggestion)
    {
        // jika ada image
        if ($food_suggestion->image && Storage::exists($food_suggestion->image)) {
            // delete image
            Storage::delete($food_suggestion->image);
        }

        // Hapus report terkait food ini
        Report::where('category', 'food')
            ->where('refers_id', $food_suggestion->id)
            ->delete();

        // delete data
        $food_suggestion->delete();

        // return response JSON
        return response()->json([
            'message' => 'Data makanan berhasil dihapus',
        ]);
    }
}
