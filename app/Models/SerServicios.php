<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerServicios extends Model
{
    protected $table = "SER_Servicios";

    public $timestamps = false;

    protected $hidden = [
        'SER_SER_TimeStamp'
    ];

    protected $primaryKey = 'SER_SER_Codigo';

    protected $keyType= 'string';
}