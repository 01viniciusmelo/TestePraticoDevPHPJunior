<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidades extends Model
{

    protected $fillable = [
        'id',
        'nome',
        'estado_id',
        'status',
    ];

}
