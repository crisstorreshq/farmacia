<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transportistas extends Model
{
    protected $table = 'BD_BodegaFarmacia.dbo.Transportistas';

    public $timestamps = false;

    protected $fillable = [
        'name', 'vigente'
    ];
}