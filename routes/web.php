<?php

use App\Models\PrestaKine;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdquisicionesController;

Route::get('login', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', '\App\Http\Controllers\Auth\LoginController@login');


Route::group(['middleware' => 'auth'], function ()
{
    Route::post('api/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    Route::get('/{any?}', '\App\Http\Controllers\ApplicationController@home')->where('any', '^(?!api).*$'); // home

    //getter api
    Route::get('api/getAuth', '\App\Http\Controllers\HelperController@getAuth');
    Route::get('api/getTransportistas', '\App\Http\Controllers\HelperController@getTransportistas');
    Route::get('api/getProveedores', '\App\Http\Controllers\HelperController@getProveedores');
    Route::get('api/getProductos', '\App\Http\Controllers\HelperController@getProductos');

    Route::resource('api/adquisiciones', AdquisicionesController::class)->only('store');
});