<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define los comandos de Artisan disponibles.$schedule->command('import:dolar')->hourly();
     */
    protected $commands = [
        \App\Console\Commands\ImportDolar::class,
    ];

    /**
     * Define la programación de tareas del sistema.
     */
    protected function schedule(Schedule $schedule)
    {
        // Ejecuta el comando import:dolar cada hora
        $schedule->command('import:dolar')->hourly();
    }

    /**
     * Registra los comandos para la aplicación.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
