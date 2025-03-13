<?php

namespace App\Http\Controllers\Api;

use App\Models\Food;
use App\Models\FoodRecord;
use Illuminate\Http\Request;
use App\Models\BabyFoodRecord;
use App\Http\Controllers\Controller;
use App\Models\BabySchedule;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class FoodController extends Controller
{
    // method untuk mengambil semua data makanan
    public function index()
    {
        // ambil data food dengan pagination 10 data
        $data = Food::select('id', 'user_id', 'name', 'source', 'image', 'description')
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
        $data = Food::select('id', 'user_id', 'name', 'source', 'image', 'description')
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

    // method untuk menampilkan panduan memasak
    public function showCookingGuide(Request $request, Food $food)
    {
        // validasi input
        $request->validate([
            'baby_id' => ['required', 'array'],
            'baby_id.*' => ['required', 'integer'],
            'portion' => ['required', 'integer'],
        ]);

        // filter data yang ingin ditampilkan
        $filteredFood = $food->only([
            'id',
            'user_id',
            'name',
            'source',
            'image',
            'recipe',
            'step',
        ]);

        // // Hitung jumlah record di tabel food_records yang terkait dengan food ini
        // $foodRecordCount = $food->food_records()->count();

        // // Tambahkan jumlah record ke data yang akan dikembalikan
        // $filteredFood['food_record_count'] = $foodRecordCount;

        // return response JSON
        return response()->json([
            'data' => [
                'food' => $filteredFood,
                'request' => $request->all(),
            ],
            'message' => 'Berhasil mengambil data panduan memasak',
        ]);
    }

    // method untuk menyelesaikan memasak
    public function completeCooking(Request $request, Food $food)
    {
        // validasi input
        $request->validate([
            'baby_id' => ['required', 'array'],
            'baby_id.*' => ['required', 'integer'],
            'portion' => ['required', 'integer'],
        ]);

        // mengambil tanggal hari ini
        $today = now();

        // mengambil id user
        $userId = Auth::id();

        // menghitung total portion
        $totalPortion = $request->portion / $food->portion;

        // menghitung total gizi
        $totalEnergy = $food->energy * $totalPortion;
        $totalProtein = $food->protein * $totalPortion;
        $totalFat = $food->fat * $totalPortion;

        // Path gambar asli dari food
        $originalImagePath = public_path('storage/' . $food->image);

        // Nama file gambar
        $imageName = basename($originalImagePath);

        // Path tujuan untuk gambar di folder food_record
        $destinationFolder = public_path('storage/image/food_records/');
        $destinationImagePath = $destinationFolder . $imageName;

        // Cek apakah folder tujuan sudah ada, jika belum buat folder
        if (!File::exists($destinationFolder)) {
            File::makeDirectory($destinationFolder, 0755, true);
        }

        // Cek apakah gambar sudah ada di folder food_record
        if (!File::exists($destinationImagePath)) {
            // Jika belum ada, copy gambar ke folder food_record
            File::copy($originalImagePath, $destinationImagePath);
        }

        // Simpan data ke tabel food_record
        $foodRecord = FoodRecord::create([
            'user_id' => $userId,
            'food_name' => $food->name,
            'food_source' => $food->source,
            'food_image' => 'image/food_records/' . $imageName,
            'food_age' => $food->age,
            'date' => $today,
            'portion' => $request->portion,
            'total_energy' => $totalEnergy,
            'total_protein' => $totalProtein,
            'total_fat' => $totalFat,
        ]);

        // Simpan data ke tabel baby_food_record untuk setiap baby_id
        foreach ($request->baby_id as $babyId) {
            BabyFoodRecord::create([
                'food_record_id' => $foodRecord->id,
                'baby_id' => $babyId,
            ]);
        }

        // return response JSON
        return response()->json([
            'data' => $foodRecord,
            'message' => 'Berhasil menyelesaikan memasak',
        ]);
    }
}