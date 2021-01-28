<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\EmpleadoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/incidencias/{id}/delete', [IncidenciaController::class, "destroy"]);
Route::resource('/incidencias', IncidenciaController::class);

Route::get('/empleados/{empleado}/delete', [EmpleadoController::class, "destroy"]);
Route::resource('/empleados', EmpleadoController::class);
