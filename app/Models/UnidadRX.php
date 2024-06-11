<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadRX extends Model
{
    protected $table = 'BD_PPV.dbo.unidades_rx';

    public $timestamps = false;

    protected $fillable = [
        'ambito_id', 'nombre', 'vigente'
    ];

    public function ambito()
    {
        return $this->belongsTo(Ambito::class);
    }
}