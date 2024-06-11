<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SERSubSERPro extends Model
{
    protected $table = 'NET_SERSubSERPro';

    protected $fillable = [
        'SER_SUB_Codigo', 'SER_ESP_Codigo', 'SER_PRO_Rut', 'Net_Ambito', 'NET_Vigencia'
    ];

    protected $primaryKey = 'SER_PRO_Rut';

    protected $keyType= 'string';

    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'SER_PRO_Rut', 'SER_PRO_Rut');
    }

    public $timestamps = false;
}