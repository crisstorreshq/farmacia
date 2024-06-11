<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SERProSERPre extends Model
{
    protected $table = 'NET_SERProSERPre';

    public $timestamps = false;

    protected $fillable = [
        'PRE_PRE_Codigo', 'SER_PRO_Rut', 'SER_ESP_Codigo', 'SER_SUB_Codigo'
    ];
}

