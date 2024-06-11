<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resonancias extends Model
{
    protected $table = 'BD_PPV.dbo.Resonancias';

    public $timestamps = false;

    protected $fillable = [
        'name', 'codigo', 'precio', 'estado'
    ];
}