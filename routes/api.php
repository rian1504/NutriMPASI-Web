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
    Route::post('food/favorite/{food}', [FoodController::class, 'favorite']);
});