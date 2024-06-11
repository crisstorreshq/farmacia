<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionLogin extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user' => 'required|exists:App\Models\User,name',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user.required' => 'Debe ingresar un Usuario',
            'user.exists' => 'Usuario inexistente',
            'password.required' => 'Debe ingresar una Contraseña',
        ];
    }
}
