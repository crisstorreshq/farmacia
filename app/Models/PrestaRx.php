<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestaRx extends Model
{
    protected $table = "BD_PPV.dbo.Prestaciones_Rx";

    public $timestamps = false;

    protected $fillable = [
        'codigo', 'nombre', 'profesional_id', 'informe', 'tipo', 'vigente'
    ];
}