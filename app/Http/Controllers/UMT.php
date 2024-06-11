<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UMTExport;

use App\Models\PrestacionesUMT;

use Carbon\Carbon;
use Auth;

class UMT extends Controller
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

        $prestaciones = PrestacionesUMT::with('prestacion', 'unidad', 'usuario')->orderBy('fecha_prestacion', 'desc')->get();

        if($keyword = $search)
        {
            $keyword = strtolower($keyword);
            //busqueda
            $prestaciones = $prestaciones->filter(function($data) use ($keyword)
            {
                $filters = [$data->fecha_prestacion, 
                            $data->prestacion->codigo, 
                            $data->prestacion->descripcion, 
                            $data->unidad->nombre];
                return $this->filtering($filters, $keyword);
            });
        }

        if ($request['orderBy'] !== 'undefined') {
            if($sortBy = $request->orderBy) {
                $sorting = ["Dia" => "fecha_prestacion", 
                            "Prestación" => "prestacion->id", 
                            "Servicio" => "unidad->id"
                        ];
                $prestaciones = $this->ordering($prestaciones, $sorting, $sortBy, $request->sort);
            }
        }

        $oldArray =  $prestaciones->values()->toArray();

        $total=count($prestaciones);
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

    public function store(Request $request)
    {
        $primer = Carbon::now()->startOfMonth();
        $ultimo = Carbon::now();
        $hoy = Carbon::now();
        $limite = Carbon::now()->startOfMonth()->addDay('4');//4

        if($hoy->greaterThan($limite))
        {
            $data = $request->validate(
                [
                    'prestacion_id' => 'required|exists:App\Models\PrestaUMT,id',
                    'unidad_id' => 'required|exists:App\Models\UnidadUMT,id',
                    'cantidad' => 'required|numeric|min:1',
                    'beneficiario' => 'required|numeric|min:0',
                    'fecha_prestacion' => 'required|date|after_or_equal:'.$primer->toDateString().'|before_or_equal:'.$ultimo->toDateString()
                ],
                [
                    'fecha_prestacion.after_or_equal' => 'La Fecha de Prestación debe pertenecer al mes actual',
                    'fecha_prestacion.before_or_equal' => 'La Fecha de Prestación debe pertenecer a un rango válido',
                ]
            );
        } else {
            $data = $request->validate(
                [
                    'prestacion_id' => 'required|exists:App\Models\PrestaUMT,id',
                    'unidad_id' => 'required|exists:App\Models\UnidadUMT,id',
                    'cantidad' => 'required|numeric|min:1',
                    'beneficiario' => 'required|numeric|min:0',
                    'fecha_prestacion' => 'required|date|after_or_equal:'.$primer->subMonth()->toDateString().'|before_or_equal:'.$ultimo->toDateString()
                ],
                [
                    'fecha_prestacion.after_or_equal' => 'La Fecha de Prestación debe pertenecer al mes actual',
                    'fecha_prestacion.before_or_equal' => 'La Fecha de Prestación debe pertenecer a un rango válido',
                ]
            );
        }

        $data['fecha_digitacion'] = Carbon::now()->format('Y-m-d H:i:s');
        $data['created_by'] = Auth::user()->name;
        PrestacionesUMT::create($data);
        return response("Prestación guardada con éxito", 200);
    }

    public function destroy($id)
    {
        $prestacion = PrestacionesUMT::find($id);
        $prestacion->delete();
        return response("Prestación Eliminada con éxito", 200);
    }

    public function update($id, Request $request)
    {
        $data = $request->validate([
            'prestacion_id' => 'required|exists:App\Models\PrestaUMT,id',
            'unidad_id' => 'required|exists:App\Models\UnidadUMT,id',
            'cantidad' => 'required|numeric|min:1',
            'beneficiario' => 'required|numeric|min:0',
        ]);

        $prestacion = PrestacionesUMT::find($id);
        $prestacion->prestacion_id = $request['prestacion_id'];
        $prestacion->unidad_id = $request['unidad_id'];
        $prestacion->cantidad = $request['cantidad'];
        $prestacion->beneficiario = $request['beneficiario'];
        $prestacion->updated_by = Auth::user()->name;
        $prestacion->fecha_update = Carbon::now()->format('Y-m-d H:i:s');
        $prestacion->save();

        return response("Prestación Actualizada con éxito", 200);
    }

    public function export(Request $request)
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
        return Excel::download(new UMTExport($fin, $fter), 'prestaciones.xlsx');
    }
}