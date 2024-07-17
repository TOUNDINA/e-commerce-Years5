<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\CheckPromotionsStatus::class,
    ];
    

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('promotions:check')->daily();
        $schedule->command('promotions:update-discounts')->dialy();
    }
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
