<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;

class Harvester extends Model
{
    protected $table = 'harvesters';

    protected $fillable = [
        'type',
        'status',
        'capacity',
        'uuid',
    ];
}
