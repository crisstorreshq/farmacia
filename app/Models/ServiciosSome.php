<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiciosSome extends Model
{
    protected $table = 'SER_ServiciosSOME';

    public $timestamps = false;

    protected $primaryKey = 'SER_SER_Codigo';

    protected $keyType= 'string';

    protected $fillable = [
        'SER_SER_Codigo'
    ];
}