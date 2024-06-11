<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrestaPatologia;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportePatologia;

use Carbon\Carbon;
use Auth;

class Patologia extends Controller
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

        $prestaciones = PrestaPatologia::with('servicio', 'paciente', 'prestacion')->orderBy('id', 'desc')->get();

        if($keyword = $search)
        {
            $keyword = strtolower($keyword);
            //busqueda
            $prestaciones = $prestaciones->filter(function($data) use ($keyword)
            {
                $filters = [$data->paciente->PAC_PAC_Nombre, 
                            $data->paciente->PAC_PAC_ApellPater, 
                            $data->paciente->PAC_PAC_ApellMater, 
                            $data->paciente->PAC_PAC_Rut,
                            $data->prestacion->codigo,
                            $data->prestacion->descripcion
                         ];
                return $this->filtering($filters, $keyword);
            });
        }

        if ($request['orderBy'] !== 'undefined') {
            if($sortBy = $request->orderBy) {
                $sorting = [
                            "Día" => "fecha_prestacion",
                            "Nombre Paciente" => "paciente->PAC_PAC_Nombre",
                            "Prestación" => "prestacion->codigo",
                            "Servicio" => "servicio->nombre"
                        ];
                $prestaciones = $this->ordering($prestaciones, $sorting, $sortBy, $request->sort);
            }
        }

        $oldArray =  $prestaciones->values()->toArray();

        $total=count($prestaciones);
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

    public function store(Request $request)
    {
        $pk = new PrestaPatologia;
        $pk->fill($request->all());
        $pk->created_by = Auth::user()->name;
        $pk->fecha_prestacion = Carbon::createFromFormat('Y-m-d', $request->fecha_prestacion)->format('Y-m-d');
        $pk->fecha_digitacion = Carbon::now()->format('Y-m-d H:i:s');
        $pk->vigente = 1;
        $pk->save();

        return response("Prestación guardada con éxito", 200);
    }

    public function update($id, Request $request)
    {
        $pr = PrestaPatologia::findOrFail($id);
        $pr->update($request->all());

        return response()->json([
            'data' => 'Prestación Actualizada con Éxito'
        ]);
    }

    public function destroy($id)
    {
        $data = PrestaPatologia::findOrFail($id);
        $data->delete();
        return response("Prestación Eliminada con éxito", 200);
    }

    public function export (Request $req)
    {
        $mes = $req->mes;
        $fin = Carbon::parse($mes.'-1')->format('Y-m-d');
        $termino = Carbon::parse($mes)->format('Y-m');
        $fter = Carbon::parse($termino)->endOfMonth()->toDateString();

        return Excel::download(new ReportePatologia($fin, $fter), 'SolicitudExamenes.xlsx');
    }
}