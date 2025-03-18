<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
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
        return $this->belongsTo(Food::class, 'refers_id');
    }

    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class, 'refers_id');
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'refers_id');
    }
}