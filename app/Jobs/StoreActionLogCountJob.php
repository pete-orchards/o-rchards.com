<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\ActionLog;
use Carbon\Carbon;
use Log;

class StoreActionLogCountJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
	public $date;
	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct(Carbon $date)
	{
		$this->date = $date;
	}

	public function __invoke()
	{
		$this->handle();
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->store($this->date);
	}

	public function store($date)
	{
		$daily_logs = ActionLog::whereDate('created_at', $date)->where('status', '200')->get();

		for($i = 0; $i < 24; $i++){
			$target = $date->copy();
			$from = $target->copy()->addHour($i);
			$to = $from->copy()->addHour(1);
			$hourly_logs = $daily_logs->whereBetween('created_at', [$from, $to]);
			$count = $hourly_logs->count();

			DB::table('action_log_counts')->insert([
				'date' => $target,
				'hour' => $i,
				'count' => $count,
				'created_at' => now(),
				'updated_at' => now(),
			]);
		}
	}
}
