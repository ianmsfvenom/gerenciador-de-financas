<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariableEarning extends Model
{
    protected $fillable = [
        'name',
        'value',
        'description',
        'type'
    ];
}
