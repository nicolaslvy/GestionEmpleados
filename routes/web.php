<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CargoController;

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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [EmpleadoController::class, 'index'])->name('empleados.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('empleados', EmpleadoController::class);
Route::get('/cargos', [CargoController::class, 'index'])->name('cargos.index');
Route::post('/cargos', [CargoController::class, 'store'])->name('cargos.store');
Route::put('/cargos/{cargo}', [CargoController::class, 'update'])->name('cargos.update');
Route::delete('/cargos/{cargo}', [CargoController::class, 'destroy'])->name('cargos.destroy');

//Route::get('/empleados', [App\Http\Controllers\EmpleadoController::class, 'index'])->name('empleados');
