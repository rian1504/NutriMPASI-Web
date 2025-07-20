<?php

namespace App\Http\Controllers\Api;

use App\Models\Food;
use App\Models\FoodRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FoodCategory;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class FoodController extends Controller
{
    // method untuk mengambil semua data makanan
    public function index()
    {
        // mengambil id user
        $userId = Auth::id();

        // ambil semua data makanan
        $data = Food::select('id', 'food_category_id', 'user_id', 'name', 'source', 'image', 'age', 'description', 'created_at')
            ->withCount('favorites')
            ->withExists([
                'favorites as is_favorite' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                }
            ])
            ->inRandomOrder()
            ->get();

        // return response JSON
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil mengambil semua data makanan',
        ]);
    }

    // method untuk mengambil data kategori makanan
    public function category()
    {
        // ambil data kategori makanan
        $data = FoodCategory::all();

        // return response JSON
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil mengambil semua data kategori makanan',
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
                // Cari berdasarkan nama atau deskripsi
                return $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('description', 'like', '%' . $request->search . '%');
                });
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
        // Ambil data food beserta relasi food_category
        $food = $food->load(['food_category' => function ($query) {
            $query->select('id', 'name');
        }, 'user' => function ($query) {
            $query->select('id', 'name');
        }]);

        // filter data yang ingin disembunyikan
        $food = $food->makeHidden([
            'fruit',
            'recipe',
            'step',
            'created_at',
        ]);

        // Hitung jumlah record di tabel favorites yang terkait dengan food ini
        $favoriteCount = $food->favorites()->count();

        // Tambahkan jumlah record ke data yang akan dikembalikan
        $food['favorites_count'] = $favoriteCount;

        // mengambil id user
        $userId = Auth::id();

        // cek apakah user sudah menyukai makanan ini
        $isFavorite = $food->favorites()->where('user_id', $userId)->exists();

        // tambahkan informasi apakah makanan ini sudah difavoritkan
        $food['is_favorite'] = $isFavorite;

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
        ]);

        // filter data yang ingin ditampilkan
        $filteredFood = $food->only([
            'id',
            'name',
            'image',
            'portion',
        ]);

        // Konversi string ke array
        $filteredFood['recipe'] = explode(';', $food->recipe);
        $filteredFood['fruit'] = explode(';', $food->fruit);
        $filteredFood['step'] = explode(';', $food->step);

        // Hitung jumlah record di tabel food_records yang terkait dengan food ini
        $foodRecordCount = $food->food_records()->count();

        // Tambahkan jumlah record ke data yang akan dikembalikan
        $filteredFood['food_record_count'] = $foodRecordCount;

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
            'schedule_id' => ['nullable', 'integer']
        ]);

        // cek apakah data berasal dari jadwal
        if ($request->has('schedule_id')) {
            // jika dari schedule, hapus data schedule
            Schedule::where('id', $request->schedule_id)->delete();
        }

        // mengambil tanggal hari ini
        $today = date('Y-m-d');

        // mengambil id user
        $userId = Auth::id();

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

        // Simpan data ke tabel food_record untuk setiap baby_id
        foreach ($request->baby_id as $babyId) {
            // Simpan data ke tabel food_record
            FoodRecord::create([
                'food_id' => $food->id,
                'baby_id' => $babyId,
                'user_id' => $userId,
                'name' => $food->name,
                'source' => $food->source,
                'image' => 'image/food_records/' . $imageName,
                'age' => $food->age,
                'date' => $today,
                'portion' => $food->portion,
                'energy' => $food->energy,
                'protein' => $food->protein,
                'fat' => $food->fat,
            ]);
        }

        // return response JSON
        return response()->json([
            'message' => 'Berhasil menyelesaikan memasak',
        ]);
    }

    // method untuk menampilkan data food_record
    public function foodRecord()
    {
        // mengambil id user
        $userId = Auth::id();

        // mengambil data food_record
        $food_record = FoodRecord::where('user_id', $userId)->get();

        // hidden field
        $food_record->makeHidden(['user_id', 'age']);

        // return respon JSON
        return response()->json([
            'data' => $food_record,
            'message' => 'Berhasil mengambil data food record',
        ]);
    }
}
