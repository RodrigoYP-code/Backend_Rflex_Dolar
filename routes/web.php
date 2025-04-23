<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\DolarValue;
// Ejemplo de una ruta para la API

// Route::get('/api', function () {
//     Artisan::call('dolar');

//     $ultimoDolar = DolarValue::latest()->first();

//     if (!$ultimoDolar) {
//         return response()->json([
//             'message' => 'No se pudo obtener el valor del dólar.',
//         ], 500);
//     }

//     // Retornar el valor del dólar y la fecha de la consulta
//     return response()->json([
//         'dolar' => $ultimoDolar->valor,  // Valor actual del dólar
//         'fecha' => $ultimoDolar->fecha,  // Fecha de la consulta
//     ]);
// });

// Route::prefix('api')->group(function () {
//     Route::get('/dolarrr', function () {
//         Artisan::call('import:dolar');  // Ejecutar el comando

//         // Obtener el último valor del dólar desde la base de datos
//         $ultimoDolar = DolarValue::latest()->first();

//         if (!$ultimoDolar) {
//             return response()->json([
//                 'message' => 'No se pudo obtener el valor del dólar.',
//             ], 500);
//         }

//         return response()->json([
//             'dolar' => $ultimoDolar->valor,  // Valor actual del dólar
//             'fecha' => $ultimoDolar->fecha,  // Fecha de la consulta
//         ]);
//     });
// });