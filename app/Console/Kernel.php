<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Schedule the sales data export to run daily at midnight
        $schedule->command('export:sales-data')->dailyAt('00:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        // Register the ExportSalesData command if not auto-discovered
        // $this->commands([
        //     \App\Console\Commands\ExportSalesData::class,
        // ]);

        require base_path('routes/console.php');
    }
}
