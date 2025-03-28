<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodRecommendation extends Model
{
    // Guard the id field
    protected $guarded = ['id'];

    // hidden field
    protected $hidden = ['created_at', 'updated_at'];

    // Define the relationship
    public function baby(): BelongsTo
    {
        return $this->belongsTo(Baby::class);
    }

    public function food(): BelongsTo
    {
        return $this->belongsTo(Baby::class);
    }
}