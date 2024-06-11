<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SEREspSERPro extends Model
{
    protected $table = 'NET_SEREspSERPro';

    public $timestamps = false;

    protected $fillable = [
        'SER_ESP_Codigo', 'SER_PRO_Rut'
    ];
}