<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadKine extends Model
{
    protected $table = 'BD_PPV.dbo.unidades_kines';

    protected $fillable = [
        'id', 'nombre', 'estado', 'id_ambito'
    ];

    protected $casts = [
        'id_ambito' => 'integer',
    ];
}
