<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('baby_food_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('baby_id')->constrained('babies')->cascadeOnDelete();
            $table->foreignId('food_record_id')->constrained('food_records')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baby_food_records');
    }
};