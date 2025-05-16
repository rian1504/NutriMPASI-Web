<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendTomorrowScheduleNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedules:send-tomorrow-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications for tomorrow schedules to all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        // Ambil semua user yang memiliki jadwal besok
        $usersWithSchedules = User::whereHas('schedules', function ($query) use ($tomorrow) {
            $query->whereDate('date', $tomorrow);
        })->with(['schedules' => function ($query) use ($tomorrow) {
            $query->whereDate('date', $tomorrow);
        }])->get();

        $this->info("Generating notifications for all users...");

        $bar = $this->output->createProgressBar(count($usersWithSchedules));

        foreach ($usersWithSchedules as $user) {
            $scheduleCount = $user->schedules->count();

            Notification::create([
                'user_id' => $user->id,
                'category' => 'schedule',
                'title' => "Anda memiliki $scheduleCount jadwal memasak besok",
            ]);

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Successfully sent tomorrow schedule notifications.');
    }
}
