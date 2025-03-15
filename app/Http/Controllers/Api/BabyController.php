<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Baby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BabyController extends Controller
{
    // method untuk mengambil data bayi berdasarkan user
    public function index()
    {
        // ambil user id
        $userId = Auth::id();

        // ambil data bayi
        $baby = Baby::where('user_id', $userId)->get();

        // filter data yang ingin disembunyikan
        $baby = $baby->makeHidden(['user_id', 'dob', 'condition', 'created_at', 'updated_at']);

        // return response JSON
        return response()->json([
            'data' => $baby,
            'message' => 'Berhasil mengambil data bayi user',
        ]);
    }

    // method untuk menambah data bayi
    public function store(Request $request)
    {
        // validasi request
        $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'dob' => ['required', 'date'],
            'gender' => ['required', 'string'],
            'height' => ['nullable', 'numeric'],
            'weight' => ['nullable', 'numeric'],
            'condition' => ['nullable', 'string', 'min:10'],
        ]);

        // Mengambil id user
        $userId = Auth::user()->id;

        // membuat data bayi
        $baby = Baby::create([
            'user_id' => $userId,
            'name' => $request->name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'height' => $request->height,
            'weight' => $request->weight,
            'condition' => $request->condition,
        ]);

        // return response JSON
        return response()->json([
            'data' => $baby,
            'message' => 'Berhasil menambah data bayi',
        ]);
    }

    // method untuk menampilkan detail bayi
    public function show(Baby $baby)
    {
        // filter data yang ingin disembunyikan
        $baby = $baby->makeHidden(['user_id', 'created_at', 'updated_at']);

        // return response JSON
        return response()->json([
            'data' => $baby,
            'message' => 'Berhasil mengambil detail data bayi user',
        ]);
    }

    // method untuk update data bayi
    public function update(Request $request, Baby $baby)
    {
        // validasi request
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'dob' => ['required', 'date'],
            'gender' => ['required', 'string'],
            'height' => ['nullable', 'numeric'],
            'weight' => ['nullable', 'numeric'],
            'condition' => ['nullable', 'string', 'min:10'],
        ]);

        // Update data bayi
        $baby->update($validatedData);

        // return response JSON
        return response()->json([
            'data' => $baby,
            'message' => 'Berhasil mengubah data bayi',
        ]);
    }

    // method untuk menghapus data bayi
    public function destroy(Baby $baby)
    {
        // ambil id user
        $userId = Auth::id();

        // Cek jumlah bayi yang tersisa
        $totalBabies = Baby::where('user_id', $userId)->count();

        if ($totalBabies <= 1) {
            return response()->json([
                'message' => 'Data bayi tidak dapat dihapus karena hanya tersisa satu bayi.',
            ], 400);
        }

        // Hapus data bayi
        $baby->delete();

        return response()->json([
            'message' => 'Data bayi berhasil dihapus',
        ]);
    }
}