<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('lead:email-marketing-new-member-dispatcher')->everyTwoHours();
        $schedule->command('lead:email-marketing-update-member-dispatcher')->everyTwoHours();

        $schedule->command('queue:work --queue=addMarketingMember --max-jobs=25 --stop-when-empty')->everyMinute();
        $schedule->command('queue:work --queue=syncMarketingMember --max-jobs=25 --stop-when-empty')->everyMinute();
        $schedule->command('queue:work --queue=deleteMarketingMember --max-jobs=25 --stop-when-empty')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
