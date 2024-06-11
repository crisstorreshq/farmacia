<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestacion extends Model
{

    protected $table = "PRE_Prestacion";

    public $timestamps = false;

    protected $hidden = [
        "PRE_PRE_Compuesta", "PRE_PRE_RecarNoctu", "PRE_PRE_CargoPacie", "PRE_PRE_ValorVaria", "PRE_PRE_Cobra", "PRE_PRE_SubTipo", "PRE_PRE_TimeStamp", "PRE_PRE_Soundex", "PRE_PRE_FichPac", "PRE_PRE_Realiza", "PRE_PRE_Tiempo", "PRE_PRE_ItemPresu", "PRE_PRE_Equipo", "PRE_PAB_Codigo", "PRE_PRE_Grupo", "PRE_Lateralidad", "COD_DEIS_ESPECIALIDAD"
    ];
}