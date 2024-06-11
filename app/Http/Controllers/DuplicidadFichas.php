<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

use App\Models\Consulta;
use App\Models\Pacientes;
use App\Models\Carpeta;

class DuplicidadFichas extends Controller
{
    protected $queries = [
        ['tabla' => 'RPA_Formulario', 'columna' => 'PAC_PAC_Numero', 'fecha' => 'RPA_FOR_FechaDigit'],
        ['tabla' => 'PAB_Solicitud', 'columna' => 'PAC_PAC_Numero', 'fecha' => 'PAB_SOL_FechaSolicit'],
        ['tabla' => 'PCA_Agenda', 'columna' => 'PCA_AGE_NumerPacie', 'fecha' => 'PCA_AGE_FechaDigit'],
        ['tabla' => 'AFC_DetNomina', 'columna' => 'NOM_NumerPacie', 'fecha' => 'fecha'],
        ['tabla' => 'BD_HCE.dbo.Peticion_Centro_Apoyo', 'columna' => 'numeroPaciente', 'fecha' => 'fechaSolicitud'],
        ['tabla' => 'PCA_ListaEspera', 'columna' => 'PCA_LTA_NumerPacie', 'fecha' => 'PCA_LTA_FechaDigit'],
        ['tabla' => 'PCA_ListaEsperaxPlan', 'columna' => 'PCA_LTA_NumerPacie', 'fecha' => 'PCA_LTA_FechaIngreso'],
        ['tabla' => 'BD_HCE.dbo.HCE_GesInforme', 'columna' => 'HCE_NumerPacie', 'fecha' => 'HCE_FechaInforme'],
        ['tabla' => 'BD_HCE.dbo.HCE_GesConstancia', 'columna' => 'HCE_NumerPacie', 'fecha' => 'HCE_FechaNotificacion'],
        ['tabla' => 'BD_HCE.dbo.HCE_GesExcepcion', 'columna' => 'HCE_NumerPacie', 'fecha' => 'HCE_FechaJustifica'],
        ['tabla' => 'BD_HCE.dbo.HCE_GesCierre', 'columna' => 'HCE_NumerPacie', 'fecha' => 'HCE_FechaCierre'],
    ];

    public function show($numeroPaciente)
    {
        $results = [];

        foreach ($this->queries as $query) {
            $count = DB::table($query['tabla'])
                ->where($query['columna'], $numeroPaciente)
                ->count();

            if ($count > 0) {
                $results[] = ['name' => $query['tabla'], 'cantidad' => $count];
            }
        }

        return response()->json($results);
    }

    public function update($numero, Request $req)
    {
        $validated = $req->validate([
            'paciente_actual' => 'required|integer',
            'paciente_new' => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            foreach ($this->queries as $tablaInfo) {
                $existenRegistros = DB::table($tablaInfo['tabla'])
                    ->where($tablaInfo['columna'], $validated['paciente_actual'])
                    ->exists();

                if ($existenRegistros) {
                    DB::table($tablaInfo['tabla'])
                        ->where($tablaInfo['columna'], $validated['paciente_actual'])
                        ->update([
                            $tablaInfo['columna'] => $validated['paciente_new'],
                        ]);
                }
            }
            DB::update('UPDATE ATE_Prestacion SET ATE_PRE_NumerPacie = ? WHERE ATE_PRE_NumerPacie = ? and ATC_EST_Numero = 0', [$req->paciente_new, $req->paciente_actual]);
            DB::update('UPDATE ATE_Insumos SET ATE_INS_NumerPacie = ? WHERE ATE_INS_NumerPacie = ? and ATC_EST_Numero = 0', [$req->paciente_new, $req->paciente_actual]);
            DB::update('UPDATE BD_FARMACIA.dbo.FAR_Recetas SET PAC_PAC_Numero = ? WHERE PAC_PAC_Numero = ? and ATC_EST_Numero = -1  and ATC_EST_Numero = 0' , [$req->paciente_new, $req->paciente_actual]);

            DB::commit();
            
            return response()->json(['message' => 'Datos actualizados correctamente']);

        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['message' => 'Error al actualizar los datos, no se actualizó ningún dato.', 'error' => $th->getMessage()], 500);
        }
    }

    public function updateDatos(Request $request)
    {
        $datosFormulario = $request->all();

        $paciente = Pacientes::where('PAC_PAC_Numero', $datosFormulario['PAC_PAC_Numero'])->first();
        if ($paciente) {
            $paciente->update($datosFormulario);
        }

        $pacienteOld = Pacientes::where('PAC_PAC_Numero', $datosFormulario['PAC_Numero_Old'])->first();
        if ($pacienteOld) {
            Carpeta::where('PAC_PAC_Numero', $pacienteOld->PAC_PAC_Numero)->delete();
            
            $pacienteOld->update([
                'PAC_PAC_ApellMater' => '',
                'PAC_PAC_Rut' => '',
                'PAC_PAC_ApellPater' => '',
                'PAC_PAC_Nombre' => "se regulariza con pac_numero {$datosFormulario['PAC_PAC_Numero']}"
            ]);

            DB::statement('EXEC ATAPAC_Fusionar_Paciente ?, ?, ?', [
                $datosFormulario['PAC_PAC_Numero'],
                $datosFormulario['PAC_Numero_Old'],
                Auth::user()->name
            ]);
        }

        return response()->json(['message' => 'Operaciones realizadas con éxito']);
    }
}