<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestaKineRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'PAC_PAC_Numero' => 'required|exists:App\Models\Pacientes,PAC_PAC_Numero',
            'diagnostico' => 'required',
            'tipo' => 'required',
            'covid' => 'required',
            'prestacion' => 'required',
            'referencia' => 'required',
            'num_prestacion' => 'required',
            'fecha_ingreso' => 'required|date|before_or_equal:today',
            'servicio' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'num_prestacion' => 'N° Prestación',
        ];
    }

    public function messages()
    {
        return [
            'fecha_ingreso.before_or_equal' => 'Ingresa una fecha válida',
        ];
    }
}
