<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $table = 'BD_BodegaFarmacia.dbo.Proveedores';

    public $timestamps = false;

    protected $fillable = [
        'name', 'rut', 'vigente'
    ];
}