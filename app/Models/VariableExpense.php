<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariableExpense extends Model
{
    protected $fillable = [
        'name',
        'value',
        'description'
    ];
}
