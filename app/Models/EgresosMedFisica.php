<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EgresosMedFisica extends Model
{
    protected $table = 'BD_PPV.dbo.EgresosMedFisica';

    public $timestamps = false;

    protected $fillable = [
        'name', 'estado', 'tipo'
    ];

}