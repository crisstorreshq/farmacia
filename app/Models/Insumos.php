<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insumos extends Model
{
    protected $table = 'BD_BodegaFarmacia.dbo.Insumos';

    public $timestamps = false;

    protected $fillable = [
        'adquisiciones_id', 'producto_id', 'serie_lote', 'cantidad', 'fecha_vencimiento', 'created_at', 'created_by', 'vigencia'
    ];
}