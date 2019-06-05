<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{

    protected $fillable = [
        'id',
        'user_id',
        'email',
        'status',
    ];

}
