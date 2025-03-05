<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    // Guard the id field
    protected $guarded = ['id'];

    // Define the relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}