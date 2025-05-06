<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredSchedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedules:delete-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete expired schedules';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Pertama, hitung jumlah schedule yang akan dihapus
        $count = Schedule::where('date', '<', Carbon::today())->count();

        $this->info("Found {$count} expired schedules to delete...");

        // Buat progress bar berdasarkan jumlah data
        $bar = $this->output->createProgressBar($count);

        // Jika tidak ada data, langsung selesaikan
        if ($count === 0) {
            $bar->finish();
            $this->newLine();
            $this->info("No expired schedules to delete.");
            return;
        }

        // Hapus data dengan chunk untuk efisiensi memory
        Schedule::where('date', '<', Carbon::today())
            ->chunkById(200, function ($schedules) use ($bar) {
                foreach ($schedules as $schedule) {
                    $schedule->delete();
                    $bar->advance();
                }
            });

        $bar->finish();
        $this->newLine();
        $this->info("Successfully deleted {$count} expired schedules.");
    }
}
