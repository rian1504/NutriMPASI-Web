<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nutritionist extends Model
{
    // Guard the id field
    protected $guarded = ['id'];

    // hidden field
    protected $hidden = ['created_at', 'updated_at'];
}