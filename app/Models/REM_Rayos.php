<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class REM_Rayos extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = "BD_PPV.dbo.REM_Rayos_3";

    public $timestamps = false;

    protected $fillable = [
        "PAC_PAC_Numero", "RPA_FOR_NumerFormu", "PRE_PRE_Codigo", "derivador", "servicio", "medico_solicita", "detalle", "diagnostico", "fecha_derivacion", "tm_responsable", "medico_realiza", "cantidad_examen", "informe", "informe_entregado", "tac_contraste", "fecha_creacion"
    ];

    public function scopeCodigo($query, $codigo)
    {
        if ($codigo)
            return $query->where('PRE_PRE_Codigo', 'LIKE', "%$codigo%");
    }

    public function scopeDiagnostico($query, $diagnostico)
    {
        if ($diagnostico)
            return $query->where('diagnostico', 'LIKE', "%$diagnostico%");
    }

    public function paciente()
    {
        return $this->belongsTo(Pacientes::class, 'PAC_PAC_Numero', 'PAC_PAC_Numero');
    }

    public function prestacion()
    {
        return $this->belongsTo(Prestacion::class, 'PRE_PRE_Codigo', 'PRE_PRE_Codigo');
    }

    public function derivador()
    {
        return $this->belongsTo(UnidadRX::class, 'derivador', 'id');
    }

    public function servicio()
    {
        return $this->belongsTo(UnidadRX::class, 'servicio', 'id');
    }

    public function solicitante()
    {
        return $this->belongsTo(Profesional::class, 'medico_solicita', 'SER_PRO_Rut');
    }

    public function tm()
    {
        return $this->belongsTo(Usuarios::class, 'tm_responsable', 'Segu_Usr_RUT');
    }

    public function profeRealiza()
    {
        return $this->belongsTo(Usuarios::class, 'medico_realiza', 'Segu_Usr_RUT');
    }
}