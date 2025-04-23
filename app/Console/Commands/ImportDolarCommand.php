<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DolarService;

class ImportDolarCommand extends Command
{
    protected $signature = 'import:dolar';
    protected $description = 'Importa valores del dólar desde la API';

    protected $dolarService;

    public function __construct(DolarService $dolarService)
    {
        parent::__construct();
        $this->dolarService = $dolarService;
    }

    public function handle()
    {
        
        foreach ([2024, 2025] as $anio) {
            $this->dolarService->importarPorAnio($anio);
        }

        $this->info('Importación completada.');
    }
}

