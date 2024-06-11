<?php

use App\Models\PrestaKine;
use Illuminate\Support\Facades\Route;

Route::get('login', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', '\App\Http\Controllers\Auth\LoginController@login');


Route::group(['middleware' => 'auth'], function ()
{
    Route::post('api/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    Route::get('/{any?}', '\App\Http\Controllers\ApplicationController@home')->where('any', '^(?!api).*$'); // home

    //getter api
    Route::get('api/getAuth', '\App\Http\Controllers\HelpersApi@getAuth');
    Route::get('api/prestaciones', '\App\Http\Controllers\HelpersApi@prestaciones');
    Route::get('api/referenciaMF', '\App\Http\Controllers\HelpersApi@referenciaMF');
    Route::get('api/servicioMF', '\App\Http\Controllers\HelpersApi@servicioMF');
    Route::get('api/pacienteRut/{rut}', '\App\Http\Controllers\HelpersApi@pacienteRut');
    Route::get('api/pacienteNombre', '\App\Http\Controllers\HelpersApi@pacienteNombre');
    Route::get('api/pacienteFicha/{ficha}', '\App\Http\Controllers\HelpersApi@pacienteFicha');
    Route::get('api/pacienteFolio/{folio}', '\App\Http\Controllers\HelpersApi@pacienteFolio');
    Route::get('api/pacienteNumero/{numero}', '\App\Http\Controllers\HelpersApi@pacienteNumero');
    
    Route::post('api/pacienteFull', '\App\Http\Controllers\HelpersApi@pacienteFull');

    Route::get('api/prestaUMT', '\App\Http\Controllers\HelpersApi@prestaUMT');
    Route::get('api/unidadUMT', '\App\Http\Controllers\HelpersApi@unidadUMT');
    Route::get('api/unidadPatologia', '\App\Http\Controllers\HelpersApi@unidadPatologia');
    Route::get('api/derivador', '\App\Http\Controllers\HelpersApi@derivador');
    Route::get('api/unidadRx', '\App\Http\Controllers\HelpersApi@unidadRx');
    Route::get('api/medicos', '\App\Http\Controllers\HelpersApi@medicos');
    Route::get('api/prePrestacion', '\App\Http\Controllers\HelpersApi@prestacion');
    Route::get('api/profexunidad/{unidad}/{tipo}', '\App\Http\Controllers\HelpersApi@profesionalxtipo');
    Route::get('api/getPrestaPato', '\App\Http\Controllers\HelpersApi@getPrestaPato');
    Route::get('api/getEgresosMedFisica', '\App\Http\Controllers\HelpersApi@egresosMedFisica');
    Route::get('api/getDerivacionMedFisica', '\App\Http\Controllers\HelpersApi@derivacionMedFisica');
    Route::get('api/getConvenioMedFisica', '\App\Http\Controllers\HelpersApi@getConvenioMedFisica');
    Route::get('api/getIngresoMedFisica', '\App\Http\Controllers\HelpersApi@getIngresoMedFisica');
    
    // Medicina Fisica
    Route::resource('api/prestacion', '\App\Http\Controllers\Prestaciones')->except([ 'create', 'show', 'edit' ]);
    Route::get('api/searchPrestaciones/{numero}', '\App\Http\Controllers\Prestaciones@search');
    Route::get('api/prestaciones/export', '\App\Http\Controllers\Prestaciones@export');
    Route::get('api/medfisica/exportBsb17', '\App\Http\Controllers\Prestaciones@exportBsb17');
    Route::get('api/medfisica/exportA28', '\App\Http\Controllers\Prestaciones@exportA28');

    // UMT
    Route::resource('api/UMT', '\App\Http\Controllers\UMT')->except([ 'create', 'show', 'edit' ]);
    Route::get('api/exportUMT', '\App\Http\Controllers\UMT@export');

    // Imagenología
    Route::resource('api/rx', '\App\Http\Controllers\Imagenologia')->except([ 'create', 'show', 'edit' ]);
    Route::get('api/exportRx', '\App\Http\Controllers\Imagenologia@exportREM');
    Route::get('api/exportAllRx', '\App\Http\Controllers\Imagenologia@exportAll');
    Route::get('api/getResonancias', '\App\Http\Controllers\Imagenologia@getResonancias');

    // Patologia

    Route::resource('api/patologia', '\App\Http\Controllers\Patologia')->except([ 'create', 'show', 'edit' ]);
    Route::get('api/exportPatologia', '\App\Http\Controllers\Patologia@export');

    // Lista Espera

    Route::resource('api/lEspera', '\App\Http\Controllers\ListaEspera')->only([ 'index', 'show' ]);

    // Ayudas especialidad sub especialidad etc
    Route::get('api/getEspec', '\App\Http\Controllers\AyudaController@getEspecialidades');
    Route::get('api/getSubEsp/{esp}', '\App\Http\Controllers\AyudaController@getSubEspe');
    Route::get('api/getLugar/{subEsp}', '\App\Http\Controllers\AyudaController@getLugar');
    Route::get('api/getLugares', '\App\Http\Controllers\AyudaController@getLugares');
    Route::post('api/addSubEsp', '\App\Http\Controllers\AyudaController@addSubEspe');
    Route::put('api/updateSubEsp/{id}', '\App\Http\Controllers\AyudaController@updateSubEspe');
    Route::get('api/getProfesxSub/{subEsp}', '\App\Http\Controllers\AyudaController@getProfesxSub');
    Route::post('api/addProfe', '\App\Http\Controllers\AyudaController@addProfe');
    Route::post('api/updateLugar', '\App\Http\Controllers\AyudaController@updateLugar');
    Route::post('api/deleteProfe', '\App\Http\Controllers\AyudaController@deleteProfe');

    // Charts

    Route::get('api/chartMF', '\App\Http\Controllers\ChartController@MedicinaFisica');
    Route::get('api/generoMF', '\App\Http\Controllers\ChartController@GeneroMedFisica');

    // duplicidad de fichas

    Route::resource('api/duplicidad', '\App\Http\Controllers\DuplicidadFichas')->only([ 'show', 'update' ]);
    Route::resource('api/estadia', '\App\Http\Controllers\TablasEstadia')->only([ 'show', 'update' ]);
    Route::put('api/duplicidadAte/{numero}', '\App\Http\Controllers\DuplicidadFichas@updateAte');
    Route::post('api/duplicidadDatos', '\App\Http\Controllers\DuplicidadFichas@updateDatos');
});