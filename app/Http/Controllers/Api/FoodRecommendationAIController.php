<?php

namespace App\Http\Controllers\Api;

use App\Models\Baby;
use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GeminiRecommendationService;

class FoodRecommendationAIController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiRecommendationService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function recommend(Baby $baby)
    {
        // Ambil data bayi
        $baby = $baby->with('user')->first();

        // Ambil makanan yang sesuai dengan kategori usia bayi
        $foods = Food::with('food_category')
            ->where('age', $baby->getAgeCategory())
            ->get();

        if ($foods->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada makanan yang tersedia untuk kategori usia bayi ini'
            ], 404);
        }

        try {
            $recommendations = $this->geminiService->generateRecommendation($baby, $foods);

            return response()->json([
                'baby' => [
                    'id' => $baby->id,
                    'name' => $baby->name,
                    'age_months' => $baby->getAgeInMonths(),
                    'age_category' => $baby->getAgeCategory(),
                    'gender' => $baby->gender,
                    'height' => $baby->height,
                    'weight' => $baby->weight,
                    'condition' => $baby->condition
                ],
                'recommendations' => $recommendations
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal mendapatkan rekomendasi',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}