<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Duplicidad extends Model
{
    protected $table = 'BD_PPV.dbo.Duplicidad_Ficha';

    public $timestamps = false;

    protected $fillable = [
        'PAC_PAC_Numero', 'PAC_NUM_Old', 'fecha_solicitud', 'fecha_realizacion', 'solicitante'
    ];
}