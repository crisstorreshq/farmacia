<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestaUMT extends Model
{
    protected $table = 'BD_PPV.dbo.Presta_UMT';

    public $timestamps = false;

    protected $fillable = [
        'codigo', 'descripcion', 'valor', 'vigente'
    ];

    // protected $hidden = [
    //     'nada'
    // ];
}