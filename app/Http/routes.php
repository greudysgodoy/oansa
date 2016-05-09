<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('admin','FrontController@admin');

Route::resource('oansista','OansistaController');

Route::resource('area','AreaController');

Route::resource('lider','LiderController');

Route::resource('rol','RolController');

Route::resource('nivelManual','NivelManualController');

Route::get('manual/aprobar','ManualController@aprobar');
Route::get('manual/seleccionar','ManualController@seleccionar');
Route::get('manual/progreso', 'ManualController@progreso');
Route::get('manual/aprobada/{manual_id}/{oansista_id}/{seccion_id?}', 'ManualController@aprobada');

Route::resource('manual','ManualController');

Route::resource('log','LogController');
Route::get('logout','LogController@logout');


