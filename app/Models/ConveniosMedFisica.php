<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConveniosMedFisica extends Model
{
    protected $table = 'BD_PPV.dbo.ConveniosMedFisica';

    public $timestamps = false;

    protected $fillable = [
        'name', 'estado'
    ];

}