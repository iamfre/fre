<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    protected $table = 'trees';
    
    protected $fillable = [
        'type',
        'quantity_fruits',
        'uuid',
    ];
}
