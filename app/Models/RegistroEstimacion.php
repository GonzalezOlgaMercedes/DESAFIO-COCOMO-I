<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroEstimacion extends Model
{
    //
    protected $fillable = ['estimacion'];

    //la columna estimacion es de tipo json
    protected $casts = [
        'estimacion' => 'array',
    ];
}
