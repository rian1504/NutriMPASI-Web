<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // method untuk report
    public function store(Request $request, string $category)
    {
        // Validasi input
        $request->validate([
            'refers_id' => ['required', 'integer'],
            'content' => ['required', 'string', 'min:4'],
        ]);

        // Cek apakah kategori valid
        $allowedCategories = ['food', 'thread', 'comment'];
        if (!in_array($category, $allowedCategories)) {
            return response()->json([
                'message' => 'Kategori report tidak valid.',
            ], 400);
        }

        // Ambil user ID
        $userId = Auth::id();

        // Cek apakah user sudah melaporkan referensi yang sama sebelumnya
        $existingReport = Report::where('user_id', $userId)
            ->where('category_report', $category)
            ->where('refers_id', $request->refers_id)
            ->first();

        if ($existingReport) {
            return response()->json([
                'message' => 'Anda sudah melaporkan ini sebelumnya.',
            ], 409);
        }

        // Buat laporan baru
        $report = Report::create([
            'user_id' => $userId,
            'category_report' => $category,
            'refers_id' => $request->refers_id,
            'content' => $request->content,
        ]);

        // return response JSON
        return response()->json([
            'data' => $report,
            'message' => "Berhasil melaporkan $category.",
        ]);
    }
}