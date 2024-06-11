<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PrestaKine extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'BD_PPV.dbo.Prestaciones_Kine_New';

    public $timestamps = false;

    protected $fillable = [
        "id_egreso", "id_derivacion", "unidad_id", "profesional_id", "PAC_PAC_Numero", "diagnostico", "tipo", "covid", "prestacion", "referencia", "num_prestacion", "fecha_ingreso", "fecha_alta", "servicio", "rut_profesional", "fecha_digitacion", "fecha_update", "digitador", "actualiza", "id_egreso", "id_derivacion", 'id_ingreso', 'id_convenio'
    ];

    protected $casts = [
        'prestacion' => 'integer',
        'servicio' => 'integer',
        'PAC_PAC_Numero' => 'integer',
        'id_egreso' => 'integer',
        'id_derivacion' => 'integer',
        'id_ingreso' => 'integer',
        'id_convenio' => 'integer',
    ];

    public function paciente()
    {
        return $this->belongsTo('App\Models\Pacientes', 'PAC_PAC_Numero', 'PAC_PAC_Numero');
    }

    public function prestaciones()
    {
        return $this->belongsTo(PrestacionesKine::class, 'prestacion', 'id');
    }

    public function usuarios()
    {
        return $this->belongsTo(Usuarios::class, 'rut_profesional', 'Segu_Usr_RUT');
    }

    public function servicios()
    {
        return $this->belongsTo(UnidadKine::class, 'servicio', 'id');
    }
}
