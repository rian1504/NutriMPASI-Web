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

    // hidden field
    protected $hidden = ['updated_at'];

    // Define the relationship
    public function food_category(): BelongsTo
    {
        return $this->belongsTo(FoodCategory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function food_records(): HasMany
    {
        return $this->hasMany(FoodRecord::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'refers_id')->where('category', 'food');
    }

    public function food_recommendations(): HasMany
    {
        return $this->hasMany(FoodRecommendation::class);
    }
}
