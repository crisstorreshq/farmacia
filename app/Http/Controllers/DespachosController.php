<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Despachos;
use App\Models\Despacho_Items;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use DB;
use Auth;

class DespachosController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'proveedor' => 'required|integer', 
            'factura_guia_oc' => 'required|string', 
            'monto' => 'required|integer', 
            'transportista' => 'required|integer', 
            'cantidad_bultos' => 'required|integer', 
            'presentacion' => 'required|integer', 
            'destinatario' => 'required|integer', 
            'recibe' => 'required|string', 
            'tens' => 'required|integer', 
            'qf' => 'required|integer', 
            'items' => 'required|array', 
            'items.*.cod_externo' => 'required|string', 
            'items.*.cod_interno' => 'required|array', 
        ]);

        try {
            DB::beginTransaction();

            $despacho = Despachos::create([
                'proveedor_id' => $validatedData['proveedor'],
                'documento' => $validatedData['factura_guia_oc'],
                'monto' => $validatedData['monto'],
                'transportista_id' => $validatedData['transportista'],
                'cantidad_bultos' => $validatedData['cantidad_bultos'],
                'presentacion_id' => $validatedData['presentacion'],
                'destinatario_id' => $validatedData['destinatario'],
                'recibe' => $validatedData['recibe'],
                'tens_id' => $validatedData['tens'],
                'qf_id' => $validatedData['qf'],
                'created_by' => Auth::user()->name,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'vigencia' => 1,
            ]);

            foreach ($validatedData['items'] as $insumo) {
                Despacho_Items::create([
                    'despacho_id' => $despacho->id,
                    'cod_externo' => Arr::get($insumo, 'cod_externo'),
                    'cod_interno' => Arr::get($insumo, 'cod_interno.id'),
                    'descripcion' => Arr::get($insumo, 'descripcion', null),
                    'created_by' => Auth::user()->name,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'vigencia' => 1,
                ]);
            }

            DB::commit();

            return response()->json(['message' => 'Adquisición y insumos guardados correctamente'], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => 'Error al guardar la adquisición: ' . $e->getMessage()], 500);
        }
    }
}