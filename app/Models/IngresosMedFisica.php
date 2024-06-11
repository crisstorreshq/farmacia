<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngresosMedFisica extends Model
{
    protected $table = 'BD_PPV.dbo.IngresosMedFisica';

    public $timestamps = false;

    protected $fillable = [
        'name', 'estado'
    ];

}