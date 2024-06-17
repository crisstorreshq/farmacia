<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adquisiciones;
use App\Models\Insumos;
use DB;
use Auth;
use Carbon\Carbon;

class AdquisicionesController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipo_adquisicion_id' => 'required|integer',
            'fecha_recepcion' => 'required|date',
            'transportista_id' => 'required|integer',
            'ot' => 'required|string',
            'tipo_documento_id' => 'required|integer',
            'numero_oc' => 'required|string',
            'numero_bultos' => 'required|integer',
            // 'numero_oc' => 'required|string|regex:/^[A-Za-z0-9]{3,4}-[A-Za-z0-9]{3,4}-[A-Za-z0-9]{3,4}$/',
            'proveedor_id' => 'required|integer',
            'observacion' => 'nullable|string',
            'insumos' => 'required|array',
            'insumos.*.producto_id' => 'required|string',
            'insumos.*.serie_lote' => 'required|string',
            'insumos.*.cantidad' => 'required|integer|min:1',
            'insumos.*.fecha_vencimiento' => 'required|date|after:today',
        ]);

        try {
            DB::beginTransaction();

            $adquisicion = Adquisiciones::create([
                'tipo_adquisicion_id' => $validatedData['tipo_adquisicion_id'],
                'fecha_recepcion' => $validatedData['fecha_recepcion'],
                'transportista_id' => $validatedData['transportista_id'],
                'numero_bultos' => $validatedData['numero_bultos'],
                'ot' => $validatedData['ot'],
                'tipo_documento_id' => $validatedData['tipo_documento_id'],
                'numero_oc' => $validatedData['numero_oc'],
                'proveedor_id' => $validatedData['proveedor_id'],
                'observacion' => $validatedData['observacion'] ?? '',
                'created_by' => Auth::user()->name,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'vigencia' => 1,
            ]);

            foreach ($validatedData['insumos'] as $insumo) {
                Insumos::create([
                    'adquisiciones_id' => $adquisicion->id,
                    'producto_id' => $insumo['producto_id'],
                    'serie_lote' => $insumo['serie_lote'],
                    'cantidad' => $insumo['cantidad'],
                    'fecha_vencimiento' => $insumo['fecha_vencimiento'],
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