<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    // Guard the id field
    protected $guarded = ['id'];

    // hidden field
    protected $hidden = ['created_at', 'updated_at'];

    // Define the relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }

    public function baby_schedules(): HasMany
    {
        return $this->hasMany(BabySchedule::class);
    }
}
