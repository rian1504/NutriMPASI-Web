<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Application;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('food-recommendations:generate --all')
            ->dailyAt('00:00')
            ->timezone('Asia/Jakarta')
            ->onFailure(function () {
                Log::error('Failed to run daily food recommendations');
            });
        $schedule->command('schedules:delete-expired')
            ->dailyAt('00:00')
            ->timezone('Asia/Jakarta')
            ->onFailure(function () {
                Log::error('Failed to run daily schedule delete expired');
            });
    })
    ->create();
