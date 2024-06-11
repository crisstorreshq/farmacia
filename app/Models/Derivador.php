<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Derivador extends Model
{
    protected $table = "BD_PPV.dbo.Derivador";

    public $timestamps = false;

    protected $fillable = [
        'SER_DER_Codigo', 'SER_DER_Descripcio', 'SER_PRO_Establecimiento', 'vigente'
    ];
}