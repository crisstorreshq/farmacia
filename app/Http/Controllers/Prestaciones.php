<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Auth;

use App\Models\PrestaKine;

use App\Http\Requests\PrestaKineRequest;
use App\Http\Requests\UpdatePrestaKine;
use App\Http\Requests\ExportPresta;

use App\Exports\MedFisicaExport;
use App\Exports\MedFisicaBSB17;
use App\Exports\MedFisicaA28;

class Prestaciones extends Controller
{
    public function filtering($filters, $keyword)
    {
        $filters = array_map('strtolower', $filters);
        
        foreach($filters as $filter){
          if(strpos($filter, $keyword) !== false){
            return true;
            break;
          }
        }
        
        return false;
    }

    public function ordering($collection, $sorting, $sortBy, $order)
    {
        if ($order === "asc") {
            $collection = $collection->sortBy(function ($item) use ($sortBy, $sorting) {
                return $this->sorting($item, $sortBy, $sorting);
            });
        } else {
            $collection = $collection->sortByDesc(function ($item) use ($sortBy, $sorting) {
                return $this->sorting($item, $sortBy, $sorting);
            });
        }
        return $collection;
    }

    public function sorting($item, $sortBy, $sorting) 
    {
        $steps = explode("->", $sorting[$sortBy]);
        $attribute = array_pop($steps);
        
        $last_relation_result = "";
        foreach($steps as $key => $step){
            if ($key === 0) {
                $last_relation_result = $step;
            } else {
                $last_relation_result = $last_relation_result->$step;
            }
        }
        
        if ($last_relation_result === "") {
            $result = $item->$attribute;
        } else {
            $result = optional($item->$last_relation_result)->$attribute;
        }
        
        return $result;
    }
    public function index(Request $request)
    {
        $search = $request['search'];
        $per_page = $request['per_page'] ?? 5;
        $current_page = $request['page'] ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;

        $prestacion = PrestaKine::with('paciente', 'usuarios')->where('digitador', Auth::user()->name)->orderBy('id', 'desc')->get();

        if($keyword = $search)
        {
            $keyword = strtolower($keyword);
            //busqueda
            $prestacion = $prestacion->filter(function($data) use ($keyword)
            {
                $filters = [$data->paciente->PAC_PAC_Nombre, 
                            $data->paciente->PAC_PAC_ApellPater, 
                            $data->paciente->PAC_PAC_ApellMater, 
                            $data->paciente->PAC_PAC_Rut,
                            $data->PRE_PRE_Codigo ];
                if ($data->paciente->carpeta) {
                    array_push($filters, $data->paciente->carpeta->PAC_CAR_NumerFicha);
                }
                return $this->filtering($filters, $keyword);
            });
        }

        if ($request['orderBy'] !== 'undefined') {
            if($sortBy = $request->orderBy) {
                $sorting = ["Código Examen" => "PRE_PRE_Codigo", 
                            "Nombre Paciente" => "paciente->PAC_PAC_Nombre", 
                            "Rut Paciente" => "paciente->PAC_PAC_Rut",
                            "Apellido Paterno" => "paciente->PAC_PAC_ApellPater",
                            "Apellido Materno" => "paciente->PAC_PAC_ApellMater",
                            "Prestación" => "prestacion",
                            "Fecha Prestación" => "fecha_digitacion",
                            "Tipo Prestación" => "tipo",
                            "Referencia" => "referencia",
                            "Servicio" => "servicio",
                            "Covid" => "covid",
                            "Diagnóstico" => "diagnostico"
                        ];
                $prestacion = $this->ordering($prestacion, $sorting, $sortBy, $request->sort);
            }
        }

        $oldArray =  $prestacion->values()->toArray();
        $total=count($prestacion);
        $total_pages = round($total / $per_page) + ($total % $per_page > 0 ? 1 : 0);
        $array = array_slice($oldArray, $starting_point, $per_page, true);
        $data = collect($array)->values()->all();

        if ($data) {
            return response()->json([
                'page' => intval($current_page),
                'per_page' => intval($per_page),
                'total' => $total,
                'total_pages' => $total_pages,
                'data' => $data
            ]);
        } else {
            return response()->json([
                'page' => 0,
                'total' => 0,
                'data' => $data
            ]);
        }
    }

    public function store(PrestaKineRequest $request) 
    {
        $pk = new PrestaKine;
        $pk->fill($request->all());
        $pk->unidad_id = Auth::user()->perfil->id_servicio;
        $pk->profesional_id = Auth::user()->perfil->id_profesional;
        $pk->rut_profesional = Auth::user()->usuarios->Segu_Usr_RUT;
        $pk->fecha_digitacion = Carbon::now()->format('Y-m-d H:i:s');
        $pk->digitador = Auth::user()->name;
        $pk->save();

        return response("Prestación guardada con éxito", 200);
    }

    public function update($id, UpdatePrestaKine $request)
    {
        $prestacion = PrestaKine::find($id);
        $prestacion->unidad_id = $request['unidad_id'];
        $prestacion->diagnostico = $request['diagnostico'];
        $prestacion->tipo = $request['tipo'];
        $prestacion->covid = $request['covid'];
        $prestacion->prestacion = $request['prestacion'];
        $prestacion->referencia = $request['referencia'];
        $prestacion->num_prestacion = $request['num_prestacion'];
        $prestacion->fecha_ingreso = $request['fecha_ingreso']? Carbon::parse($request['fecha_ingreso'])->format('Y-m-d') : null;
        $prestacion->fecha_alta = $request['fecha_alta'] ? Carbon::parse($request['fecha_alta'])->format('Y-m-d') : null;
        $prestacion->servicio = $request['servicio'];
        $prestacion->fecha_update = Carbon::now()->format('Y-m-d H:i:s');
        $prestacion->actualiza = Auth::user()->name;
        $prestacion->save();

        return response("Prestación Actualizada con éxito", 200);
    }

    public function destroy($id)
    {
        $prestacion = PrestaKine::find($id);
        $prestacion->delete();
        return response("Prestación Eliminada con éxito", 200);
    }

    public function export(ExportPresta $request)
    {
        $mes = $request['mes'];
        $fin = Carbon::parse($mes.'-1')->format('Y-m-d');
        $termino = Carbon::parse($mes)->format('Y-m');
        $fter = Carbon::parse($termino)->endOfMonth()->toDateString();
        return Excel::download(new MedFisicaExport($fin, $fter), 'MedFisica.xlsx');
    }

    public function search($numero)
    {
        $data = PrestaKine::where([['PAC_PAC_Numero', $numero],['digitador', Auth::user()->perfil->user]])
        ->orderBy('id', 'desc')
        ->first();

        if ($data != '') {
            if ($data->fecha_alta != "") {
                $data = "";
            }
        }

        if ($data == '') {
            $data = PrestaKine::where('PAC_PAC_Numero', $numero)
            ->orderBy('id', 'desc')
            ->first();
        }

        if ($data != ''){
            if($data->fecha_alta != ""){
                $data = "";
            }
        }

        return $data;
    }

    public function exportBsb17(Request $request)
    {
        $mes = $request['mes'];
        $fin = Carbon::parse($mes.'-1')->format('Y-m-d');
        $termino = Carbon::parse($mes)->format('Y-m');
        $fter = Carbon::parse($termino)->endOfMonth()->toDateString();
        return Excel::download(new MedFisicaBSB17($fin, $fter), 'exportBsb17.xlsx');
    }

    public function exportA28(Request $request)
    {
        $mes = $request['mes'];
        $fin = Carbon::parse($mes.'-1')->format('Y-m-d');
        $termino = Carbon::parse($mes)->format('Y-m');
        $fter = Carbon::parse($termino)->endOfMonth()->toDateString();
        return Excel::download(new MedFisicaA28($fin, $fter), 'exportA28.xlsx');
    }
}