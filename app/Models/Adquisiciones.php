<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adquisiciones extends Model
{
    protected $table = 'BD_BodegaFarmacia.dbo.Adquisiciones';

    public $timestamps = false;

    protected $fillable = [
        'tipo_adquisicion_id', 'fecha_recepcion', 'transportista_id', 'ot', 'tipo_documento_id', 'numero_oc', 'proveedor_id', 'observacion', 'created_by', 'created_at', 'vigencia', 'numero_bultos'
    ];
}