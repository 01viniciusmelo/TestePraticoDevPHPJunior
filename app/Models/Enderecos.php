<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enderecos extends Model
{

    protected $fillable = [
        'id',
        'user_id',
        'cidade_id',
        'estado_id',
        'tipo',
        'endereco',
        'complemento',
        'bairro',
        'status',
    ];

}
