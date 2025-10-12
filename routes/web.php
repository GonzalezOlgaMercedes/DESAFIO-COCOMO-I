<?php

use App\Http\Controllers\COCOMOController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

//Ruta para la vista de COCOMO I nivel intermedio
Route::get('/estimacion/intermedia', function () {
    return view('modo_de_desarrollo_intermedio');
})->name('estimacion.intermedia');
//Ruta para la vista de COCOMO I nivel básico
Route::get('/estimacion/basica', function () {
    return view('modo_de_desarrollo_basico');
})->name('estimacion.basica');

Route::post('/modo-de-desarrollo', [COCOMOController::class, 'testearFormulario'])->name('modo-de-desarrollo');
//Ruta para acceder al formulario de selección del modo de desarrollo
Route::get('/modo-de-desarrollo', function () {
    return view('modo_de_desarrollo');
});
