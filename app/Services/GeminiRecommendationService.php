<?php

namespace App\Services;

use App\Models\Baby;
use App\Models\Food;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiRecommendationService
{
    /**
     * Generate food recommendations for a baby
     *
     * @param Baby $baby
     * @param \Illuminate\Database\Eloquent\Collection $foods
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function generateRecommendation(Baby $baby, $foods)
    {
        try {
            // Prepare baby data
            $babyData = $this->prepareBabyData($baby);

            // Prepare food data
            $foodsData = $this->prepareFoodsData($foods);

            // Create the prompt
            $prompt = $this->createPrompt($babyData, $foodsData);

            // Send request to Gemini API
            $response = $this->callGeminiApi($prompt);

            // Process the response
            return $this->processResponse($response, $foods);
        } catch (\Exception $e) {
            Log::error('Gemini recommendation failed: ' . $e->getMessage());
            throw new \Exception('Failed to generate food recommendations');
        }
    }

    /**
     * Prepare baby data for the prompt
     *
     * @param Baby $baby
     * @return array
     */
    protected function prepareBabyData(Baby $baby): array
    {
        return [
            'Nama' => $baby->name,
            'Usia (bulan)' => $baby->getAgeInMonths(),
            'Kategori Usia' => $baby->getAgeCategory(),
            'Jenis Kelamin' => $baby->gender == 'L' ? 'Laki-laki' : 'Perempuan',
            'Tinggi Badan (cm)' => $baby->height,
            'Berat Badan (kg)' => $baby->weight,
            'Kondisi Khusus' => $baby->condition ?? 'Tidak ada'
        ];
    }

    /**
     * Prepare foods data for the prompt
     *
     * @param \Illuminate\Database\Eloquent\Collection $foods
     * @return array
     */
    protected function prepareFoodsData($foods): array
    {
        return $foods->map(function ($food) {
            return [
                'ID' => $food->id,
                'Nama' => $food->name,
                'Kategori' => $food->food_category->name ?? 'Umum',
                'Rentang Usia' => $food->age,
                'Energi (kkal)' => $food->energy,
                'Protein (g)' => $food->protein,
                'Lemak (g)' => $food->fat,
                'Porsi' => $food->portion,
                'Buah' => $food->fruit,
                'Deskripsi' => $food->description
            ];
        })->toArray();
    }

    /**
     * Create the prompt for Gemini AI
     *
     * @param array $babyData
     * @param array $foodsData
     * @return string
     */
    protected function createPrompt(array $babyData, array $foodsData): string
    {
        return "Saya memiliki data bayi dengan kondisi sebagai berikut:\n\n" .
            json_encode($babyData, JSON_PRETTY_PRINT) .
            "\n\nDan data makanan yang tersedia:\n\n" .
            json_encode($foodsData, JSON_PRETTY_PRINT) .
            "\n\nBerdasarkan data tersebut, rekomendasikan 3-5 makanan yang paling sesuai untuk bayi ini. " .
            "Pertimbangkan:\n" .
            "1. Kesesuaian dengan kategori usia bayi ({$babyData['Kategori Usia']})\n" .
            "2. Kebutuhan nutrisi berdasarkan berat dan tinggi badan\n" .
            "3. Kondisi khusus bayi jika ada\n" .
            "4. Komposisi nutrisi (energi, protein, lemak)\n\n" .
            "Berikan respon dalam format JSON yang hanya berisi array ID makanan yang direkomendasikan " .
            "beserta alasan singkat untuk setiap rekomendasi. Contoh output:\n\n" .
            '{
                 "recommendations": [
                     {
                         "food_id": 1,
                         "reason": "Tinggi protein untuk pertumbuhan, sesuai bayi 8 bulan"
                     },
                     {
                         "food_id": 3,
                         "reason": "Energi cukup untuk berat badan bayi"
                     }
                 ]
                }';
    }

    /**
     * Call Gemini API
     *
     * @param string $prompt
     * @return array
     * @throws \Exception
     */
    protected function callGeminiApi(string $prompt): array
    {
        $modelName = 'gemini-2.0-flash';

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->timeout(30)->post(
            "https://generativelanguage.googleapis.com/v1beta/models/{$modelName}:generateContent?key=" . env('GEMINI_API_KEY'),
            [
                'contents' => [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ],
                'generationConfig' => [
                    'response_mime_type' => 'application/json',
                    'temperature' => 0.5
                ]
            ]
        );

        if ($response->failed()) {
            throw new \Exception('Gemini API request failed: ' . $response->body());
        }

        return $response->json();
    }

    /**
     * Process Gemini API response
     *
     * @param array $response
     * @param \Illuminate\Database\Eloquent\Collection $foods
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    protected function processResponse(array $response, $foods)
    {
        $responseText = $response['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (!$responseText) {
            throw new \Exception('Invalid response from Gemini API');
        }

        $recommendations = json_decode($responseText, true);

        if (!isset($recommendations['recommendations'])) {
            throw new \Exception('Invalid recommendations format from Gemini API');
        }

        return collect($recommendations['recommendations'])->map(function ($item) use ($foods) {
            $food = $foods->where('id', $item['food_id'])->first();

            return [
                'food' => $food,
                'reason' => $item['reason']
            ];
        })->filter()->values()->toArray();
    }
}