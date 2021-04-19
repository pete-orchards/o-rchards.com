<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\StoreLogMostViewPostsJob;
use App\Jobs\StoreActionLogCountJob;
use Log;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		//
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->call(new StoreLogMostViewPostsJob(Carbon::yesterday()))->dailyAt('2:00');
		$schedule->call(new StoreActionLogCountJob(Carbon::yesterday()))->dailyAt('2:00');

		$schedule->command('queue:work --stop-when-empty')->evenInMaintenanceMode();
		$schedule->command('queue:work --stop-when-empty --queue=daily')->evenInMaintenanceMode()->daily();
		$schedule->command('queue:work --stop-when-empty --queue=hourly')->evenInMaintenanceMode()->hourly();
		$schedule->command('queue:work --stop-when-empty --queue=emails')->evenInMaintenanceMode()->twiceDaily(11, 20);
	}

	/**
	 * Register the commands for the application.
	 *
	 * @return void
	 */
	protected function commands()
	{
		$this->load(__DIR__.'/Commands');

		require base_path('routes/console.php');
	}
}
