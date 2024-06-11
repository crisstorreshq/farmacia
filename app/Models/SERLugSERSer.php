<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SERLugSERSer extends Model
{
    protected $table = 'NET_SERLugSERSer';

    public $timestamps = false;

    protected $fillable = [
        'SER_LUG_Codigo', 'SER_SER_Codigo', 'SER_LUG_TipoLugar', 'NET_Vigencia'
    ];
}