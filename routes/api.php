<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BabyController;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\ThreadController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\ThreadUserController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\NutritionistController;
use App\Http\Controllers\Api\FoodSuggestionController;

// autentikasi
require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth:sanctum'], function () {
    // v1
    Route::prefix('v1')->group(function () {
        // Food
        Route::prefix('food')->group(function () {
            Route::get('', [FoodController::class, 'index']);
            Route::get('category', [FoodController::class, 'category']);
            Route::post('filter', [FoodController::class, 'filter']);
            Route::get('record', [FoodController::class, 'foodRecord']);
            Route::get('{food}', [FoodController::class, 'show']);
            Route::get('{food}/cook', [FoodController::class, 'showCookingGuide']);
            Route::post('{food}/cook/complete', [FoodController::class, 'completeCooking']);
        });

        // Favorite Food
        Route::prefix('favorite')->group(function () {
            Route::get('', [FavoriteController::class, 'index']);
            Route::post('{food}', [FavoriteController::class, 'store']);
        });

        // Schedule
        Route::prefix('schedule')->group(function () {
            Route::get('', [ScheduleController::class, 'index']);
            Route::post('filter', [ScheduleController::class, 'filter']);
            Route::post('{food}', [ScheduleController::class, 'store']);
            Route::get('{schedule}/edit', [ScheduleController::class, 'edit']);
            Route::post('{schedule}/update', [ScheduleController::class, 'update']);
            Route::delete('{schedule}', [ScheduleController::class, 'destroy']);
        });

        // Nutritionist
        Route::get('nutritionist', [NutritionistController::class, 'index']);

        // Food Suggestion
        Route::resource('food-suggestion', FoodSuggestionController::class)->except(['create', 'edit', 'update']);
        Route::post('food-suggestion/{food_suggestion}', [FoodSuggestionController::class, 'update'])->name('food_recommendation.update');

        // Baby
        Route::resource('baby', BabyController::class)->except(['create', 'edit', 'update']);
        Route::post('baby/{baby}', [BabyController::class, 'update'])->name('baby.update');
        Route::get('baby/food-recommendation/{baby}', [BabyController::class, 'foodRecommendation'])->name('baby.food-recommendation');

        // Thread User
        Route::resource('thread-user', ThreadUserController::class)->except(['create', 'show', 'edit', 'update']);
        Route::post('thread-user/{thread_user}', [ThreadUserController::class, 'update'])->name('thread.update');

        // Thread
        Route::prefix('thread')->group(function () {
            Route::get('', [ThreadController::class, 'index']);
            Route::get('{thread}', [ThreadController::class, 'show']);
        });

        // Like Thread
        Route::prefix('like')->group(function () {
            Route::get('', [LikeController::class, 'index']);
            Route::post('{thread}', [LikeController::class, 'store']);
        });

        // Comment
        Route::resource('comment', CommentController::class)->except(['index', 'create', 'show', 'edit', 'update']);
        Route::post('comment/{comment}', [CommentController::class, 'update'])->name('comment.update');

        // Notification
        Route::prefix('notification')->group(function () {
            Route::get('', [NotificationController::class, 'index']);
            Route::post('', [NotificationController::class, 'readAll']);
            Route::post('{notification}', [NotificationController::class, 'read']);
        });

        // Profil
        Route::prefix('profile')->group(function () {
            Route::get('', [ProfileController::class, 'index']);
            Route::post('{user}', [ProfileController::class, 'updateProfile']);
            Route::post('{user}/password', [ProfileController::class, 'updatePassword']);
        });

        // Report
        Route::post('report/{category}', [ReportController::class, 'store']);
    });

    // TESTING
    // Route::prefix('testing')->group(function () {
    //     // Food
    //     Route::prefix('food')->group(function () {
    //         Route::get('', [FoodController::class, 'index']);
    //         Route::get('category', [FoodController::class, 'category']);
    //         Route::post('filter', [FoodController::class, 'filter']);
    //         Route::get('record', [FoodController::class, 'foodRecord']);
    //         Route::get('{food}', [FoodController::class, 'show']);
    //         Route::get('{food}/cook', [FoodController::class, 'showCookingGuide']);
    //         Route::post('{food}/cook/complete', [FoodController::class, 'completeCooking']);
    //     });

    //     // Favorite Food
    //     Route::prefix('favorite')->group(function () {
    //         Route::get('', [FavoriteController::class, 'index']);
    //         Route::post('{food}', [FavoriteController::class, 'store']);
    //     });

    //     // Schedule
    //     Route::prefix('schedule')->group(function () {
    //         Route::get('', [ScheduleController::class, 'index']);
    //         Route::post('filter', [ScheduleController::class, 'filter']);
    //         Route::post('{food}', [ScheduleController::class, 'store']);
    //         Route::get('{schedule}/edit', [ScheduleController::class, 'edit']);
    //         Route::post('{schedule}/update', [ScheduleController::class, 'update']);
    //         Route::delete('{schedule}', [ScheduleController::class, 'destroy']);
    //     });

    //     // Nutritionist
    //     Route::get('nutritionist', [NutritionistController::class, 'index']);

    //     // Food Suggestion
    //     Route::resource('food-suggestion', FoodSuggestionController::class)->except(['create', 'edit', 'update']);
    //     Route::post('food-suggestion/{food_suggestion}', [FoodSuggestionController::class, 'update'])->name('food_recommendation.update');

    //     // Baby
    //     Route::resource('baby', BabyController::class)->except(['create', 'edit', 'update']);
    //     Route::post('baby/{baby}', [BabyController::class, 'update'])->name('baby.update');
    //     Route::get('baby/food-recommendation/{baby}', [BabyController::class, 'foodRecommendation'])->name('baby.food-recommendation');

    //     // Thread User
    //     Route::resource('thread-user', ThreadUserController::class)->except(['create', 'show', 'edit', 'update']);
    //     Route::post('thread-user/{thread_user}', [ThreadUserController::class, 'update'])->name('thread.update');

    //     // Thread
    //     Route::prefix('thread')->group(function () {
    //         Route::get('', [ThreadController::class, 'index']);
    //         Route::get('{thread}', [ThreadController::class, 'show']);
    //     });

    //     // Like Thread
    //     Route::prefix('like')->group(function () {
    //         Route::get('', [LikeController::class, 'index']);
    //         Route::post('{thread}', [LikeController::class, 'store']);
    //     });

    //     // Comment
    //     Route::resource('comment', CommentController::class)->except(['index', 'create', 'show', 'edit', 'update']);
    //     Route::post('comment/{comment}', [CommentController::class, 'update'])->name('comment.update');

    //     // Notification
    //     Route::prefix('notification')->group(function () {
    //         Route::get('', [NotificationController::class, 'index']);
    //         Route::post('', [NotificationController::class, 'readAll']);
    //         Route::post('{notification}', [NotificationController::class, 'read']);
    //     });

    //     // Profil
    //     Route::prefix('profile')->group(function () {
    //         Route::get('', [ProfileController::class, 'index']);
    //         Route::post('{user}', [ProfileController::class, 'updateProfile']);
    //         Route::post('{user}/password', [ProfileController::class, 'updatePassword']);
    //     });

    //     // Report
    //     Route::post('report/{category}', [ReportController::class, 'store']);
    // });
});
