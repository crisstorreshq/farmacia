<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadUMT extends Model
{
    protected $table = 'BD_PPV.dbo.Unidades_UMT';

    public $timestamps = false;

    protected $fillable = [
        'ambito_id', 'nombre', 'vigente'
    ];

    public function ambito()
    {
        return $this->belongsTo(Ambito::class);
    }
}