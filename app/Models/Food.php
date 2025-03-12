<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Food extends Model
{
    // set table name
    protected $table = 'foods';

    // Guard the id field
    protected $guarded = ['id'];

    // Define the relationship
    public function food_category(): BelongsTo
    {
        return $this->belongsTo(FoodCategory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function food_records(): HasMany
    {
        return $this->hasMany(FoodRecord::class);
    }
}