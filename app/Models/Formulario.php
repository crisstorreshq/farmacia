<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $table = 'RPA_Formulario';

	protected $primaryKey = 'PAC_PAC_Numero';

    public $timestamps = false;

    protected $keyType= 'float';

    protected $hidden = [
        "RPA_FOR_FechaDigit", "RPA_FOR_TipoPacie", "RPA_FOR_ProceServi", "RPA_FOR_ProceEspec", "RPA_FOR_CodigRecep",  "RPA_FOR_Vigencia", "RPA_FOR_FolioRefer", "RPA_FOR_Observacio", "RPA_FOR_FechaTrasp", "RPA_FOR_Sala", "RPA_FOR_TimeStamp", "RPA_FOR_ProceDeriv", "RPA_FOR_TipoProc", "SER_PRO_Codigo", "RPA_FOR_TipoRecet", "RPA_FOR_CenResDeriv", "RPA_FOR_CenResProce", "RPA_FOR_SAO", "RPA_FOR_TipoPrograma", "RPA_FOR_ComSegurosCodigo", "RPA_FOR_CiruAmbulatoria", "RPA_FOR_ProfDeriv"
    ];

    public function paciente()
    {
        return $this->belongsTo(Pacientes::class, 'PAC_PAC_Numero', 'PAC_PAC_Numero');
    }
}