<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefones extends Model
{

    protected $fillable = [
        'id',
        'user_id',
        'tipo',
        'ddd',
        'telefone',
        'status',
    ];

}
