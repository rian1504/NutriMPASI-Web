<?php

namespace App\Console\Commands;

use App\Models\Baby;
use App\Models\Food;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Services\GeminiRecommendationService;

class GenerateFoodRecommendations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'food-recommendations:generate {baby_id?} {--all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate food recommendations for babies';

    /**
     * Execute the console command.
     */
    public function handle(GeminiRecommendationService $recommendationService)
    {
        if ($this->option('all')) {
            // Generate untuk semua bayi
            $babies = Baby::whereNotNull('dob')
                ->whereNotNull('height')
                ->whereNotNull('weight')
                ->get();
            $this->info("Generating recommendations for all babies...");

            $bar = $this->output->createProgressBar(count($babies));

            foreach ($babies as $baby) {
                $this->generateForBaby($baby, $recommendationService);
                $bar->advance();
            }

            $bar->finish();
            $this->newLine();
            $this->info("Completed generating recommendations for all babies.");
            return;
        }

        // Generate untuk bayi spesifik
        $babyId = $this->argument('baby_id');
        if ($babyId) {
            $baby = Baby::find($babyId);
            if (!$baby) {
                $this->error("Baby not found with ID: {$babyId}");
                return;
            }

            $this->generateForBaby($baby, $recommendationService);
            $this->info("Recommendations generated for baby: {$baby->name}");
            return;
        }

        $this->error("Please specify either --all option or provide a baby ID");
    }

    protected function generateForBaby(Baby $baby, GeminiRecommendationService $service)
    {
        try {
            // Hapus rekomendasi lama
            $baby->food_recommendations()->delete();

            // Dapatkan makanan yang sesuai dengan kategori usia bayi dan verified
            $foods = Food::where('age', $baby->getAgeCategory())
                ->whereNull('user_id')
                ->whereNotNull('source')
                ->get();

            if ($foods->isEmpty()) {
                Log::info("No foods available for baby {$baby->id} with age category {$baby->getAgeCategory()}");
                return;
            }

            // Generate rekomendasi baru dengan menyertakan $baby dan $foods
            $recommendations = $service->generateRecommendation($baby, $foods);

            // Simpan food recommendation ke database
            foreach ($recommendations as $rec) {
                $baby->food_recommendations()->create([
                    'food_id' => $rec['food']['id'],
                    'reason' => $rec['reason']
                ]);
            }

            Log::info("Generated recommendations for baby {$baby->id}");
        } catch (\Exception $e) {
            Log::error("Failed to generate recommendations for baby {$baby->id}: " . $e->getMessage());
            $this->error("Error for baby {$baby->id}: " . $e->getMessage());
        }
    }
}