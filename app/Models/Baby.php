<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Baby extends Model
{
    // Guard the id field
    protected $guarded = ['id'];

    // Define the relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function baby_schedules(): HasMany
    {
        return $this->hasMany(BabySchedule::class);
    }

    public function baby_food_records(): HasMany
    {
        return $this->hasMany(BabyFoodRecord::class);
    }
}