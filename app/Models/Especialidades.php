<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidades extends Model
{
    protected $table = "SER_Especiali";

    public $timestamps = false;

    protected $fillable = [
        'SER_ESP_Codigo', 'SER_ESP_Descripcio', 'SER_ESP_Vigencia'
    ];

    protected $hidden = [
        'SER_ESP_TimeStamp', 'SER_ESP_Soundex', 'SER_ESP_Codigo_IEH', 'SER_SER_PrestMinsal', 'SER_ESP_Deis_2010', 'SER_ESP_NivelCuidado'
    ];
}