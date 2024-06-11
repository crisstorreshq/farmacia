<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrestaKine;

use Auth;
use Carbon\Carbon;
use DB;

class ChartController extends Controller
{
    public function MedicinaFisica () 
    {
        $hoy = Carbon::now()->format('Y-m');
        $fin = Carbon::parse($hoy.'-1')->format('Y-m-d');
        $fter = Carbon::parse($hoy)->endOfMonth()->toDateString();

        $prestacion = PrestaKine::
        selectRaw("cast(pm.descripcion as varchar(MAX)) as name, cast(count(prestacion) as int) as value")
        ->join('BD_PPV.dbo.Presta_Med_Fisica as pm', 'pm.id', '=', 'prestacion')
        ->where('digitador', Auth::user()->name)
        ->whereBetween('fecha_ingreso', [$fin, $fter])
        ->groupBy(DB::raw('prestacion, cast(pm.descripcion as varchar(MAX))'))
        ->orderBy('value', 'desc')
        ->get();
        return $prestacion;
    }

    public function GeneroMedFisica ()
    {
        $hoy = Carbon::now()->format('Y-m');
        $fin = Carbon::parse($hoy.'-1')->format('Y-m-d');
        $fter = Carbon::parse($hoy)->endOfMonth()->toDateString();

        $prestacion = DB::table('BD_PPV.dbo.Prestaciones_Kine_New as pk')
        ->selectRaw("pac.PAC_PAC_Sexo as sexo, count(pac.PAC_PAC_Sexo) as cant")
        ->join('PAC_Paciente as pac', 'pac.PAC_PAC_Numero', '=', 'pk.PAC_PAC_Numero')
        ->where('digitador', Auth::user()->name)
        ->whereBetween('fecha_ingreso', [$fin, $fter])
        ->groupBy('pac.PAC_PAC_Sexo')
        ->orderBy('pac.PAC_PAC_Sexo', 'desc')
        ->get();
        return $prestacion;
    }
}
