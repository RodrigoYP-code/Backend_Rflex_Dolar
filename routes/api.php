<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Models\DolarValue;
use App\Http\Controllers\DolarApiController;

use Illuminate\Http\Request;

Route::get('/rango', [DolarApiController::class, 'obtenerPorRango']);
Route::get('/dolar', [DolarApiController::class, 'dolar']);
Route::put('/dolar/actualizar', [DolarApiController::class, 'actualizarPorFecha']);
Route::delete('/dolar/eliminar', [DolarApiController::class, 'eliminarPorFecha']);

