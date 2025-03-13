<?php

use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\ScheduleController;
use Illuminate\Support\Facades\Route;

// autentikasi
require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth:sanctum'], function () {
    // Food
    Route::prefix('food')->group(function () {
        Route::get('', [FoodController::class, 'index']);
        Route::get('{food}', [FoodController::class, 'show']);
        Route::post('filter', [FoodController::class, 'filter']);
        Route::get('{food}/cook', [FoodController::class, 'showCookingGuide']);
        Route::post('{food}/cook/complete', [FoodController::class, 'completeCooking']);
    });

    // Favorite
    Route::prefix('favorite')->group(function () {
        Route::get('', [FavoriteController::class, 'index']);
        Route::post('{food}', [FavoriteController::class, 'store']);
    });

    // Schedule
    Route::prefix('schedule')->group(function () {
        Route::get('', [ScheduleController::class, 'index']);
        Route::post('filter', [ScheduleController::class, 'filter']);
        Route::post('{food}', [ScheduleController::class, 'store']);
    });
});