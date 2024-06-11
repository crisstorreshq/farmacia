<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubEspecia extends Model
{
    protected $table = "SER_SubEspecia";

    public $timestamps = false;

    protected $fillable = [
        'SER_SUB_Codigo', 'SER_SUB_Descripcio', 'SER_SUB_Vigencia', 'SER_ESP_Codigo'
    ];

    protected $hidden = [
        'SER_SUB_TimeStamp'
    ];

    protected $primaryKey = 'SER_SUB_Codigo'; 

    protected $keyType= 'string';
}