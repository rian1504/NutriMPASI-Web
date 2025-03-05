<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BabyFoodRecord extends Model
{
    // Guard the id field
    protected $guarded = ['id'];

    // Define the relationship
    public function baby(): BelongsTo
    {
        return $this->belongsTo(Baby::class);
    }

    public function food_record(): BelongsTo
    {
        return $this->belongsTo(FoodRecord::class);
    }
}