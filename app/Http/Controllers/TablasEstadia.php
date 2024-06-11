<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Consulta;

class TablasEstadia extends Controller
{
    protected $tablasEstadia  = [
        ['tabla' => 'ATC_Estadia', 'columna' => 'PAC_PAC_Numero', 'fecha' => 'ATC_EST_FechaEstad', 'estadia' => 'ATC_EST_Numero'],
        ['tabla' => 'ATC_OcupaCama', 'columna' => 'PAC_PAC_Numero', 'fecha' => 'ATC_OCA_FechaDigit', 'estadia' => 'ATC_EST_Numero'],
        ['tabla' => 'ATE_Prestacion', 'columna' => 'ATE_PRE_NumerPacie', 'fecha' => 'ATE_PRE_FechaDigit', 'estadia' => 'ATC_EST_Numero'],
        ['tabla' => 'ATE_Insumos', 'columna' => 'ATE_INS_NumerPacie', 'fecha' => 'ATE_INS_FechaDigit', 'estadia' => 'ATC_EST_Numero'],
        ['tabla' => 'ATC_Cuenta', 'columna' => 'PAC_PAC_Numero', 'fecha' => 'ATC_CTA_FecEstCuen', 'estadia' => 'ATC_EST_Numero'],
        ['tabla' => 'CAT_CatCamas', 'columna' => 'PAC_PAC_Numero', 'fecha' => 'CAT_FechaDigit', 'estadia' => 'CAT_CAT_Numero'],
        ['tabla' => 'BD_FARMACIA.dbo.FAR_Recetas', 'columna' => 'PAC_PAC_Numero', 'fecha' => 'Fld_FechaDigit', 'estadia' => 'ATC_EST_Numero'],
        ['tabla' => 'BD_HCE.dbo.HCE_EvolucionHospitalizacion', 'columna' => 'HCE_PAC_Numero', 'fecha' => 'HCE_Fecha_Solicitud', 'estadia' => 'ATC_EST_Numero'],
        ['tabla' => 'PAC_TextoEpi', 'columna' => 'PAC_PAC_Numero', 'fecha' => 'PAC_TEX_FechaDigit', 'estadia' => 'ATC_EST_Numero'],
        ['tabla' => 'PAC_Epicrisis', 'columna' => 'PAC_PAC_Numero', 'fecha' => 'PAC_EPI_FechaDigit', 'estadia' => 'ATC_EST_Numero'],
    ];

    public function show($numeroPaciente)
    {
        $data = DB::table('ATC_Estadia')
            ->select('PAC_PAC_Numero', 'ATC_EST_Numero', 'ATC_EST_FechaEstad')
            ->where('PAC_PAC_Numero', $numeroPaciente)
            ->get()
            ->map(function ($item) {
                $item->ATC_EST_Numero = (int) $item->ATC_EST_Numero;
                $item->PAC_PAC_Numero = (int) $item->PAC_PAC_Numero;
                return $item;
            });
        return $data;
    }

    public function update(Request $req)
    {
        $validated = $req->validate([
            'paciente_viejo' => 'required|integer',
            'estadia_vieja' => 'required|integer',
            'paciente_nuevo' => 'required|integer',
            'estadia_nueva' => 'required|integer'
        ]);

        DB::beginTransaction();

        try {
            foreach ($this->tablasEstadia as $tablaInfo) {
                DB::table($tablaInfo['tabla'])
                    ->where($tablaInfo['columna'], $validated['paciente_viejo'])
                    ->where($tablaInfo['estadia'], $validated['estadia_vieja'])
                    ->update([
                        $tablaInfo['columna'] => $validated['paciente_nuevo'],
                        $tablaInfo['estadia'] => $validated['estadia_nueva']
                    ]);
            }

            DB::commit();

            return response()->json(['message' => 'Datos actualizados correctamente']);
            
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['message' => 'Error al actualizar los datos, no se actualizó ningún dato.', 'error' => $e->getMessage()], 500);
        }
    }
}