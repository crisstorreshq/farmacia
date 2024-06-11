<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RemRxExport;
use App\Exports\AllRxExport;
use App\Models\REM_Rayos;
use App\Models\Resonancias;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class Imagenologia extends Controller
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

        $prestaciones = DB::table('BD_PPV.dbo.REM_Rayos_3 as rem')
        ->selectRaw('rem.*, pac.PAC_PAC_Nombre, pac.PAC_PAC_ApellPater, pac.PAC_PAC_ApellMater, pac.PAC_PAC_Rut, CONVERT(int, car.PAC_CAR_NumerFicha) as PAC_CAR_NumerFicha, pre.PRE_PRE_Descripcio')
        //REM_Rayos::
        //with('paciente', 'prestacion')
        ->join('PAC_Paciente as pac', 'pac.PAC_PAC_Numero', '=', 'rem.PAC_PAC_Numero')
        ->leftJoin('PAC_Carpeta as car', 'pac.PAC_PAC_Numero', '=', 'car.PAC_PAC_Numero')
        ->join('PRE_Prestacion as pre', 'pre.PRE_PRE_Codigo', '=', 'rem.PRE_PRE_Codigo')
        ->orderBy('rem.id', 'desc')
        ->get();

        if($keyword = $search)
        {
            $keyword = strtolower($keyword);
            //busqueda
            $prestaciones = $prestaciones->filter(function($data) use ($keyword)
            {
                $filters = [$data->PAC_PAC_Nombre, 
                            $data->PAC_PAC_ApellPater, 
                            $data->PAC_PAC_ApellMater, 
                            $data->PAC_PAC_Rut,
                            $data->PRE_PRE_Codigo,
                            $data->PAC_CAR_NumerFicha ];
                return $this->filtering($filters, $keyword);
            });
        }

        if ($request['orderBy'] !== 'undefined') {
            if($sortBy = $request->orderBy) {
                $sorting = ["Código Examen" => "PRE_PRE_Codigo", 
                            "Nombre Paciente" => "PAC_PAC_Nombre", 
                            "Rut Paciente" => "PAC_PAC_Rut",
                            "Derivador" => "derivador",
                            "Servicio" => "servicio",
                            "Médico Solicitante" => "medico_solicita",
                            "Detalle" => "detalle",
                            "Diagnóstico" => "diagnostico",
                            "Fecha Derivación" => "fecha_derivacion",
                            "TM. responsable" => "tm_responsable",
                            "Radiólogo Responsable" => "medico_realiza",
                            "Ficha Paciente" => "PAC_CAR_NumerFicha"
                        ];
                $prestaciones = $this->ordering($prestaciones, $sorting, $sortBy, $request->sort);
            }
        }

        $oldArray =  $prestaciones->values()->toArray();

        $total = count($prestaciones);
        $total_pages = round($total / $per_page) + ($total % $per_page > 0 ? 0 : 1);
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

    public function store(Request $req)
    {
        try {
            $data = new REM_Rayos;
            $data->PAC_PAC_Numero = $req['PAC_PAC_Numero'];
            $data->RPA_FOR_NumerFormu = $req['RPA_FOR_NumerFormu'];
            $data->PRE_PRE_Codigo = $req['PRE_PRE_Codigo'];
            $data->derivador = $req['derivador'];
            $data->servicio = $req['servicio'];
            $data->medico_solicita = $req['medico_solicita'];
            $data->detalle = $req['detalle'];
            $data->diagnostico = $req['diagnostico'];
            $data->fecha_derivacion = $req['fecha_derivacion'];
            $data->tm_responsable = $req['tm_responsable'];
            $data->medico_realiza = $req['medico_realiza'];
            $data->cantidad_examen = $req['cantidad_examen'];
            $data->informe = $req['informe'];
            $data->informe_entregado = $req['informe_entregado'];
            $data->tac_contraste = $req['tac_contraste'];
            $data->fecha_creacion = Carbon::now()->format('Y-m-d H:i:s');
            $data->save();

            return response("Prestación guardada con éxito", 200);

        } catch (\Throwable $th) {
            return response($th, 400);
        }
    }

    public function destroy($id)
    {
        $data = REM_Rayos::findOrFail($id);
        $data->delete();
        return response("Prestación Eliminada con éxito", 200);
    }

    public function update($id, Request $req)
    {
        $data = REM_Rayos::find($id);
        $data->derivador = $req['derivador'];
        $data->servicio = $req['servicio'];
        $data->medico_solicita = $req['medico_solicita'];
        $data->detalle = $req['detalle'];
        $data->diagnostico = $req['diagnostico'];
        $data->fecha_derivacion = Carbon::parse($req['fecha_derivacion'])->format('Y-m-d H:i:s');
        $data->tm_responsable = $req['tm_responsable'];
        $data->medico_realiza = $req['medico_realiza'];
        $data->cantidad_examen = $req['cantidad_examen'];
        $data->informe = $req['informe'];
        $data->informe_entregado = $req['informe_entregado'];
        $data->tac_contraste = $req['tac_contraste'];
        $data->save();

        return response("Prestación Actualizada con éxito", 200);
    }

    public function getResonancias()
    {
        $data = Resonancias::where('estado', 1)->get();
        return $data;
    }

    public function exportREM(Request $request)
    {
        $mes = $request['mes'];
        $fin = Carbon::parse($mes.'-1')->format('Y-m-d');
        $termino = Carbon::parse($mes)->format('Y-m');
        $fter = Carbon::parse($termino)->endOfMonth()->toDateString();
        $data = $request->validate(
            [
                'mes' => 'required',
            ],
            [
                'mes.required' => 'El mes es Requerido',
            ]
        );
        return Excel::download(new RemRxExport($fin, $fter), 'Rem Rx.xlsx');
    }

    public function exportAll(Request $request)
    {
        $inicio = $request['inicio'];
        $termino = $request['termino'];
        $data = $request->validate(
            [
                'inicio' => 'required',
                'termino' => 'required',
            ],
            [
                'inicio.required' => 'El inicio es Requerido',
                'termino.required' => 'El termino es Requerido',
            ]
        );
        return Excel::download(new AllRxExport($inicio, $termino), 'Rem Rx.xlsx');
    }
}