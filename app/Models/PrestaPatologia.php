<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestaPatologia extends Model
{
    protected $table = "BD_PPV.dbo.Prestaciones_Patologia";

    public $timestamps = false;

    protected $fillable = [
        "servicio_id", "prestacion_id", "PAC_PAC_Numero", "fecha_prestacion", "fecha_digitacion", "created_by", "updated_by", "deleted_by", "vigente", "PAC_CAR_NumerFicha"
    ];

    public function servicio()
    {
        return $this->belongsTo('App\Models\UnidadPatologia', 'servicio_id', 'id');
    }

    public function paciente()
    {
        return $this->belongsTo('App\Models\Pacientes', 'PAC_PAC_Numero', 'PAC_PAC_Numero');
    }

    public function prestacion()
    {
        return $this->belongsTo('App\Models\PrestacionesKine', 'prestacion_id', 'id');
    }

}