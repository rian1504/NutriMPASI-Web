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
        Schema::create('food_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('food_id')->nullable()->constrained('foods')->nullOnDelete();
            $table->string('food_name');
            $table->string('food_source');
            $table->string('food_image');
            $table->string('food_age');
            $table->date('date');
            $table->integer('portion');
            $table->float('total_energy');
            $table->float('total_protein');
            $table->float('total_fat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_records');
    }
};