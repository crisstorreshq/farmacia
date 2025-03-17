<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Despacho_Items extends Model
{
    protected $table = 'BD_BodegaFarmacia.dbo.Despacho_Item';

    public $timestamps = false;

    protected $fillable = [
        'despacho_id', 'cod_externo', 'cod_interno', 'descripcion', 'created_by', 'created_at', 'vigencia'
    ];
}