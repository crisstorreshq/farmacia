<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transportistas;
use App\Models\Proveedores;
use App\Models\Materiales;
use App\Models\User;
use Auth;


class HelperController extends Controller
{
    public function getAuth()
    {
        return response()->json(Auth::user());
    }

    public function getTransportistas()
    {
        return Transportistas::where('vigente', 1)->get();
    }

    public function getProveedores()
    {
        return Proveedores::where('vigente', 1)->get();
    }

    public function getProductos()
    {
        $materials = Materiales::getFilteredMaterials();
        return response()->json($materials);
    }

    public function getProfesionales($id)
    {
        $datos = [];
        $cont = 0;
        $data = User::with('usuarios')
        ->whereHas('perfil', function($query) use ($id){ 
            $query->where([['id_servicio', 67], ['id_profesional', $id]]);
        })
        ->whereHas('usuarios', function($query){ 
            $query->where('Segu_Vigente', 'si');
        })
        ->where('is_disabled', 0)
        ->orderBy('principal_id', 'asc')
        ->get();

        foreach ($data as $d) {
            $datos[$cont]['id'] = $d->principal_id;
            $datos[$cont]['name'] = strtoupper($d->usuarios->Segu_Usr_Nombre).' '.strtoupper($d->usuarios->Segu_Usr_ApellidoPaterno).' '.strtoupper($d->usuarios->Segu_Usr_ApellidoMaterno);
            $cont++;
        }

        return $datos;
    }
}