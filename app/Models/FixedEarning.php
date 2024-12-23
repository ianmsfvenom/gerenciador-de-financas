<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FixedEarning extends Model
{
    protected $fillable = [
        'name',
        'value',
        'description'
    ];
}
