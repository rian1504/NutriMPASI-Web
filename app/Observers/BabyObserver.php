<?php

namespace App\Observers;

use App\Models\Baby;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

class BabyObserver
{
    /**
     * Handle the Baby "created" event.
     */
    public function created(Baby $baby): void
    {
        //
    }

    /**
     * Handle the Baby "updated" event.
     */
    public function updated(Baby $baby): void
    {
        if ($baby->wasChanged()) {
            try {
                // Generate rekomendasi baru
                Artisan::call('food-recommendations:generate', [
                    'baby_id' => $baby->id
                ]);

                Log::info("Successfully regenerated recommendations for baby {$baby->id}");
            } catch (\Exception $e) {
                Log::error("Failed to refresh recommendations for baby {$baby->id}: " . $e->getMessage());
            }
        }
    }

    /**
     * Handle the Baby "deleted" event.
     */
    public function deleted(Baby $baby): void
    {
        //
    }

    /**
     * Handle the Baby "restored" event.
     */
    public function restored(Baby $baby): void
    {
        //
    }

    /**
     * Handle the Baby "force deleted" event.
     */
    public function forceDeleted(Baby $baby): void
    {
        //
    }
}