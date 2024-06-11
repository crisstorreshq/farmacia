<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrestacionesKine;
use App\Models\UnidadKine;
use App\Models\Pacientes;
use App\Models\PrestaUMT;
use App\Models\UnidadUMT;
use App\Models\UnidadPatologia;
use App\Models\UnidadRX;
use App\Models\Derivador;
use App\Models\Profesional;
use App\Models\Formulario;
use App\Models\PrestaRx;
use App\Models\User;
use App\Models\EgresosMedFisica;
use App\Models\IngresosMedFisica;
use App\Models\ConveniosMedFisica;
use Auth;

class HelpersApi extends Controller
{
    public function getAuth()
    {
        return response()->json(Auth::user());
    }

    public function prestaciones()
    {
        return PrestacionesKine::selectRaw("id, descripcion as name")
        ->where([['estado', true],['id_profesional', Auth::user()->perfil->id_profesional]])
        ->get();
    }

    public function referenciaMF()
    {
        return UnidadKine::selectRaw("id, nombre as name")->get();
    }

    public function servicioMF()
    {
        return UnidadKine::selectRaw("id, nombre as name")->where('estado', 1)->get();
    }

    public function pacienteRut($rut)
    {
        $data = Pacientes::with('carpeta')->where('PAC_PAC_Rut' ,$rut)->first();
        $data->nacionalidad ? $data->nacionalidad_paciente = $data->nacionalidad->NAC_Descripcion : $data->nacionalidad_paciente = 'Chile';
        $data->sexo_paciente = $data->sexo_paciente;
        $data->nombre_paciente = $data->nombre_paciente;
        $data->prevision_paciente = $data->prevision_paciente;
        $data->edad_paciente > 1 ? $cant = " Años" : $cant = " Meses";
        $data->edad_paciente = $data->edad_paciente.$cant;
        $data->carpeta ? $data->ficha_paciente = $data->carpeta->PAC_CAR_NumerFicha : $data->ficha_paciente = 0;
        return $data;
    }

    public function pacienteFicha($ficha)
    {
        $data = Pacientes::whereHas('carpeta', function($q) use ($ficha){
            $q->whereRaw("PAC_CAR_NumerFicha = '$ficha'");
        })
        ->with('carpeta')->first();
        $data->nacionalidad ? $data->nacionalidad_paciente = $data->nacionalidad->NAC_Descripcion : $data->nacionalidad_paciente = 'Chile';
        $data->sexo_paciente = $data->sexo_paciente;
        $data->nombre_paciente = $data->nombre_paciente;
        $data->prevision_paciente = $data->prevision_paciente;
        $data->edad_paciente > 1 ? $cant = " Años" : $cant = " Meses";
        $data->edad_paciente = $data->edad_paciente.$cant;
        $data->carpeta ? $data->ficha_paciente = $data->carpeta->PAC_CAR_NumerFicha : $data->ficha_paciente = 0;
        return $data;
    }

    public function pacienteNombre(Request $req)
    {
        $data = Pacientes::with('carpeta')->where([['PAC_PAC_Nombre', 'like', '%'. strtoupper(trim($req->nombre)) .'%'], ['PAC_PAC_ApellPater', 'like', '%'. strtoupper(trim($req->apellido_paterno)) .'%'], ['PAC_PAC_ApellMater', 'like', '%'. strtoupper(trim($req->apellido_materno)) .'%']])->get();
        foreach ($data as $d) {
            $d->nacionalidad ? $d->nacionalidad_paciente = $d->nacionalidad->NAC_Descripcion : $d->nacionalidad_paciente = 'Chile';
            $d->sexo_paciente = $d->sexo_paciente;
            $d->nombre_paciente = $d->nombre_paciente;
            $d->prevision_paciente = $d->prevision_paciente;
            $d->edad_paciente > 1 ? $cant = " Años" : $cant = " Meses";
            $d->edad_paciente = $d->edad_paciente.$cant;
            $d->carpeta ? $d->ficha_paciente = $d->carpeta->PAC_CAR_NumerFicha : $d->ficha_paciente = 0;
        }

        return $data;
    }

    public function pacienteFolio($folio)
    {
        $data = Formulario::with('paciente.carpeta')->where([['RPA_FOR_NumerFormu', $folio],['RPA_FOR_TipoFormu', '04']])->first();
        $data->sexo = $data->paciente->sexo_paciente;
        $data->nombre_paciente = $data->paciente->nombre_paciente;
        $data->prevision = $data->paciente->prevision_paciente;
        $data->paciente->edad_paciente > 1 ? $cant = " Años" : $cant = " Meses";
        $data->edad = $data->paciente->edad_paciente.$cant;
        $data->carpeta ? $data->ficha_paciente = $data->paciente->carpeta->PAC_CAR_NumerFicha : $data->ficha_paciente = 0;
        return $data;
    }

    public function pacienteNumero($numero)
    {
        $paciente = Pacientes::where('PAC_PAC_Numero', $numero)->first();
        $paciente->makeVisible('PAC_PAC_Fono', 'PAC_PAC_TelefonoMovil', 'PAC_PAC_FechaModif');
        $paciente->makeHidden(['PAC_PAC_Prevision', 'PAC_PAC_Codigo', 'PAC_PAC_TipoBenef', 'PAC_PAC_Nacionalidad', 'PAC_PAC_Sexo']);
        return $paciente;
    }

    public function pacienteFull(Request $request)
    {
        $query = Pacientes::query();

        $query->where(function($q) use ($request) {
            if ($request->has('rut')) {
                $q->orWhere('PAC_PAC_Rut', 'like', '%' . $request->rut . '%');
            }
            if ($request->has('ficha')) {
                $q->orWhereHas('carpeta', function ($subQuery) use ($request) {
                    $subQuery->where('PAC_CAR_NumerFicha', 'like', '%' . $request->ficha . '%');
                });
            }
        });

        if ($request->filled(['nombre', 'apellido_paterno', 'apellido_materno'])) {
            $query->where(function($q) use ($request) {
                $q->whereRaw('UPPER(PAC_PAC_Nombre) LIKE ?', ['%' . strtoupper($request->nombre) . '%'])
                ->whereRaw('UPPER(PAC_PAC_ApellPater) LIKE ?', ['%' . strtoupper($request->apellido_paterno) . '%'])
                ->whereRaw('UPPER(PAC_PAC_ApellMater) LIKE ?', ['%' . strtoupper($request->apellido_materno) . '%']);
            });
        }

        $pacientes = $query->with('carpeta')->get();

        return response()->json($pacientes);
    }

    public function prestaUMT()
    {
        return PrestaUMT::selectRaw("id, codigo+' - '+CAST(descripcion AS varchar(MAX)) as name")->where('vigente', true)->get();
    }

    public function unidadUMT()
    {
        return UnidadUMT::selectRaw("id, nombre as name")->where('vigente', true)->get();
    }

    public function derivador()
    {
        return Derivador::selectRaw("id, SER_DER_Descripcio as name")->where("vigente", 1)->orderByRaw("CAST(SER_DER_Descripcio AS NVARCHAR(MAX))")->get();
    }

    public function egresosMedFisica()
    {
        return EgresosMedFisica::select("id", "name")->where([["estado", 1], ['tipo', 'egreso']])->get();
    }

    public function derivacionMedFisica()
    {
        return EgresosMedFisica::select("id", "name")->where([["estado", 1], ['tipo', 'derivacion']])->get();
    }

    public function unidadRx()
    {
        return UnidadRX::selectRaw("id, nombre as name")->where('vigente', true)->get();
    }

    public function unidadPatologia()
    {
        return UnidadPatologia::selectRaw("id, nombre as name")->where('vigencia', true)->get();
    }

    public function medicos()
    {
        return Profesional::selectRaw("SER_PRO_Rut as rut, SER_PRO_ApellPater +' '+ SER_PRO_ApellMater +' '+ SER_PRO_Nombres as name")
        ->where([['SER_PRO_Estado', '0001'],['SER_PRO_Tipo', '0001'], ['SER_PRO_Procedencia', 'INTERNO']])
        ->whereNotNull(['SER_PRO_Nombres', 'SER_PRO_Rut', 'SER_PRO_ApellPater', 'SER_PRO_ApellMater'])
        ->orderBy('SER_PRO_ApellPater', 'asc')
        ->get();
    }

    public function prestacion()
    {
        return PrestaRx::where('vigente', 1)
        ->get();
    }

    public function profesionalxtipo($unidad, $tipo)
    {
        $datos = [];
        $cont = 0;
        $data = User::with('usuarios')
        ->whereHas('perfil', function($query) use ($unidad, $tipo){ 
            $query->where([['id_servicio', $unidad], ['id_profesional', $tipo]]);
        })
        ->whereHas('usuarios', function($query){ 
            $query->where('Segu_Vigente', 'si');
        })
        ->where('is_disabled', 0)
        ->orderBy('principal_id', 'asc')
        ->get();

        foreach ($data as $d) {
            $datos[$cont]['nombre'] = strtoupper($d->usuarios->Segu_Usr_Nombre).' '.strtoupper($d->usuarios->Segu_Usr_ApellidoPaterno).' '.strtoupper($d->usuarios->Segu_Usr_ApellidoMaterno);
            $datos[$cont]['rut'] = $d->usuarios->Segu_Usr_RUT;
            $cont++;
        }

        return $datos;
    }

    public function getPrestaPato()
    {
        return PrestacionesKine::selectRaw("id, codigo+' - '+convert(nvarchar(36), descripcion) as descripcion")
        ->where([['estado', 1],['id_servicio', 39]])
        ->get();
    }

    public function getIngresoMedFisica()
    {
        return IngresosMedFisica::where('estado', 1)->get();
    }

    public function getConvenioMedFisica()
    {
        return ConveniosMedFisica::where('estado', 1)->get();
    }
}