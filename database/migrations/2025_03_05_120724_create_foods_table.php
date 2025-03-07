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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_category_id')->nullable()->constrained('food_categories')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->string('source')->nullable();
            $table->string('image');
            $table->string('age');
            $table->float('energy');
            $table->float('protein');
            $table->float('fat');
            $table->integer('portion');
            $table->text('fruit')->nullable();
            $table->text('recipe');
            $table->text('step');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};