<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transportistas;
use App\Models\Proveedores;
use App\Models\Materiales;
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
}