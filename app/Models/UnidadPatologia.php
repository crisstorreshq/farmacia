<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadPatologia extends Model
{
    protected $table = 'BD_PPV.dbo.unidades_patologia';

    protected $fillable = [
        'nombre', 'vigencia', 'ambito_id'
    ];
}