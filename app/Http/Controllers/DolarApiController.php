<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;  // Importación de Artisan
use App\Models\DolarValue;

class DolarApiController extends Controller
{
    // Método para obtener los valores del dólar en un rango de fechas
    public function obtenerPorRango(Request $request)
    {
        // Validación de las fechas de inicio y fin
        $request->validate([
            'inicio' => 'required|date',
            'fin' => 'required|date|after_or_equal:inicio',
        ]);

        // Obtener los valores del dólar dentro del rango de fechas
        $valores = DolarValue::whereBetween('fecha', [$request->inicio, $request->fin])
            ->orderBy('fecha')
            ->get();

        // Retornar los valores encontrados en formato JSON
        return response()->json($valores);
    }

    // Método para ejecutar el comando Artisan y obtener el valor del dólar
    public function dolar()
    {
        try {
            // Ejecutar el comando Artisan para importar el valor del dólar
            Artisan::call('import:dolar');  // Asegúrate de que el comando 'import:dolar' exista

            // Obtener el último valor del dólar desde la base de datos
            $ultimoDolar = DolarValue::latest('fecha')->first();

            // Si no se encuentra un valor de dólar, retornar un mensaje de error
            if (!$ultimoDolar) {
                return response()->json([
                    'message' => 'No se pudo obtener el valor del dólar.',
                ], 500);
            }

            // Retornar el valor y la fecha de la última consulta exitosa
            return response()->json([
                'dolar' => $ultimoDolar->valor,  // Valor actual del dólar
                'fecha' => $ultimoDolar->fecha,  // Fecha de la consulta
            ]);
        } catch (\Exception $e) {
            // Manejo de errores, si el comando o la consulta fallan
            return response()->json([
                'message' => 'Error al ejecutar el comando',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function actualizarPorFecha(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'valor' => 'required|numeric|min:0',
        ]);

        $dolar = DolarValue::where('fecha', $request->fecha)->first();

        if (!$dolar) {
            return response()->json([
                'message' => 'No se encontró un registro con esa fecha.',
            ], 404);
        }

        $dolar->valor = $request->valor;
        $dolar->save();

        return response()->json([
            'message' => 'Valor actualizado correctamente.',
            'data' => $dolar,
        ]);
    }
    public function eliminarPorFecha(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
        ]);

        $dolar = DolarValue::where('fecha', $request->fecha)->first();

        if (!$dolar) {
            return response()->json([
                'message' => 'No se encontró un registro con esa fecha.',
            ], 404);
        }

        $dolar->delete();

        return response()->json([
            'message' => 'Registro eliminado correctamente.',
        ]);
    }

}

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Artisan;
// use App\Models\DolarValue;
// class DolarApiController extends Controller
// {
//     public function obtenerPorRango(Request $request)
//     {
//         $request->validate([
//             'inicio' => 'required|date',
//             'fin' => 'required|date|after_or_equal:inicio',
//         ]);

//         $valores = DolarValue::whereBetween('fecha', [$request->inicio, $request->fin])
//             ->orderBy('fecha')
//             ->get();

//         return response()->json($valores);
//     }
//     public function dolar()
//     {
//         try {
//             Artisan::call('import:dolar');

//             $ultimoDolar = DolarValue::latest()->first();

//             if (!$ultimoDolar) {
//                 return response()->json([
//                     'message' => 'No se pudo obtener el valor del dólar.',
//                 ], 500);
//             }

//             return response()->json([
//                 'dolar' => $ultimoDolar->valor, 
//                 'fecha' => $ultimoDolar->fecha, 
//             ]);
//         } catch (\Exception $e) {
//             return response()->json([
//                 'message' => 'Error al ejecutar el comando',
//                 'error' => $e->getMessage(),
//             ], 500);
//         }
//     }
 
// }



