<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Despachos extends Model
{
    protected $table = 'BD_BodegaFarmacia.dbo.Despacho';

    public $timestamps = false;

    protected $fillable = [
        'proveedor_id', 'documento', 'monto', 'transportista_id', 'cantidad_bultos', 'presentacion_id', 'destinatario_id', 'recibe', 'tens_id', 'qf_id', 'created_at', 'created_by', 'vigencia'
    ];
}