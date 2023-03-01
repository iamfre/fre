<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    protected $table = 'fruits';

    protected $fillable = [
        'type',
        'quantity',
        'weight',
    ];
}
