<?php

namespace App\Services;

use App\Models\DolarValue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;

class DolarService
{
    public function importarPorAnio(int $anio): void
    {
        $url = "https://mindicador.cl/api/dolar/{$anio}";

        $http = Http::withOptions([
            'verify' => !App::isLocal() // Desactiva SSL solo si estás en entorno local
        ]);

        $response = $http->get($url);

        if ($response->successful()) {
            $datos = $response->json()['serie'];

            foreach ($datos as $dato) {
                DolarValue::updateOrCreate(
                    ['fecha' => substr($dato['fecha'], 0, 10)],
                    ['valor' => $dato['valor']]
                );
            }
        } else {
            Log::error("Error al consumir la API para el año {$anio}: " . $response->status());
        }
    }
}
