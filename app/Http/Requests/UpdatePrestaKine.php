<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrestaKine extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'diagnostico' => 'required',
            'tipo' => 'required',
            'covid' => 'required',
            'prestacion' => 'required',
            'referencia' => 'required',
            'num_prestacion' => 'required',
            'fecha_ingreso' => 'required',
            'servicio' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'num_prestacion' => 'N° Prestación',
        ];
    }
}
