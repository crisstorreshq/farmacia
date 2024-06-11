<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ambito extends Model
{
    protected $table = 'BD_PPV.dbo.Ambito';

    public $timestamps = false;

    protected $fillable = [
        'nombre', 'estado'
    ];
}