<?php

namespace App\Console;

use App\Jobs\CalculateTutorFee;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->job(new CalculateTutorFee())->monthlyOn(2, '7:55')->sendOutputTo(storage_path('app/log/calculateTutorFee.log', true))
        ->emailOutputTo('admin@kasi.web.id');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
