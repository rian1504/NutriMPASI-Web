<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FoodRecord extends Model
{
    // Guard the id field
    protected $guarded = ['id'];

    // Define the relationship
    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function baby(): BelongsTo
    {
        return $this->belongsTo(Baby::class);
    }
}