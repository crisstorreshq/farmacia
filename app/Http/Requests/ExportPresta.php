<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ExportPresta extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'mes' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'mes' => 'Mes a Exportar',
        ];
    }
}
