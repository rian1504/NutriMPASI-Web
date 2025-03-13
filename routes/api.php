<?php

use App\Http\Controllers\Api\FoodController;
use Illuminate\Support\Facades\Route;

// autentikasi
require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth:sanctum'], function () {
    // Food
    Route::get('food', [FoodController::class, 'index']);
    Route::get('food/{food}', [FoodController::class, 'show']);
    Route::post('food/filter', [FoodController::class, 'filter']);
    Route::post('food/{food}/favorite', [FoodController::class, 'favorite']);
    Route::get('food/{food}/cook', [FoodController::class, 'showCookingGuide']);
    Route::post('food/{food}/cook/complete', [FoodController::class, 'completeCooking']);
    Route::post('food/{food}/schedule', [FoodController::class, 'schedule']);
});
