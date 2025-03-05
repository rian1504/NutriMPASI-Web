<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FoodCategory extends Model
{
    // Guard the id field
    protected $guarded = ['id'];

    // Define the relationship
    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }
}