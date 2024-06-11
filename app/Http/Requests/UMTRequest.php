<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UMTRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'prestacion_id' => 'required|exists:App\Models\PrestaUMT,id',
            'unidad_id' => 'required|exists:App\Models\UnidadUMT,id',
            'cantidad' => 'required|numeric|min:1',
            'beneficiario' => 'required|numeric|min:0',
            'fecha_prestacion' => 'required|date|after_or_equal:'.Carbon::now()->startOfMonth()->toDateString().'|before_or_equal:'.Carbon::now()->endOfMonth()->toDateString()
        ];
    }
    //after después -> mes actual
    //before antes

    public function attributes()
    {
        return [
            'prestacion_id' => 'Prestación',
            'unidad_id' => 'Unidad',
            'fecha_prestacion' => 'Fecha de Prestación'
        ];
    }

    public function messages()
    {
        return [
            'fecha_prestacion.after_or_equal' => 'La Fecha de Prestación debe pertenecer al mes actual',
            'fecha_prestacion.before_or_equal' => 'La Fecha de Prestación debe pertenecer al mes actual',
        ];
    }
}
// $now = Carbon::now();
// $inicio = Carbon::now()->startOfMonth()->toDateString(); // 2022-05-01
// $fin = Carbon::now()->endOfMonth()->toDateString(); // 2022-05-31