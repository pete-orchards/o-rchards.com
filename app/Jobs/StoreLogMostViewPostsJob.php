<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Post;
use App\Tane;
use App\Nae;
use App\Mi;
use App\ActionLog;
use App\LogMostViewPost;
use App\LogMostViewTane;
use App\LogMostViewNae;
use App\LogMostViewMi;
use Log;
use Carbon\Carbon;

class StoreLogMostViewPostsJob implements ShouldQueue
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
		$daily_logs = ActionLog::where([
			['status', '200'],
		])->whereDate('created_at', $this->date)->get();

		if(empty($daily_logs)){
			return false;
		}

		$this->log_tane($daily_logs->filter(function ($value, $key){
			//タネへのアクセス以外除外
			if($value->route != 'tane.show'){
				return false;
			}
			$tane_id = str_replace('tane/', '', $value->url);
			$tane = Tane::find($tane_id);
			//投稿が削除済みの場合除外
			$post = $tane->post()->withTrashed()->first();
			if($post->trashed()){
				return false;
			}

			return true;
		}));

		$this->log_nae($daily_logs->filter(function ($value, $key){
			if($value->route != 'nae.show'){
				return false;
			}
			$nae_id = str_replace('nae/', '', $value->url);
			$nae = Nae::find($nae_id);
			$post = $nae->post()->withTrashed()->first();
			if($post->trashed()){
				return false;
			}

			return true;
		}));

		$this->log_mi($daily_logs->filter(function ($value, $key){
			if($value->route != 'mi.show'){
				return false;
			}
			$mi_id = str_replace('mi/', '', $value->url);
			$mi = Mi::find($mi_id);
			$post = $mi->post()->withTrashed()->first();
			if($post->trashed()){
				return false;
			}

			return true;
		}));

		$this->log_post($daily_logs->filter(function ($value, $key){
			if($value->route == 'tane.show'){
				$tane_id = str_replace('tane/', '', $value->url);
				$tane = Tane::find($tane_id);
				$post = $tane->post()->withTrashed()->first();
				if($post->trashed()){
					return false;
				}
			}elseif($value->route == 'nae.show'){
				$nae_id = str_replace('nae/', '', $value->url);
				$nae = Nae::find($nae_id);
				$post = $nae->post()->withTrashed()->first();
				if($post->trashed()){
					return false;
				}
			}elseif($value->route == 'mi.show'){
				$mi_id = str_replace('mi/', '', $value->url);
				$mi = Mi::find($mi_id);
				$post = $mi->post()->withTrashed()->first();
				if($post->trashed()){
					return false;
				}
			}else{
				return false;
			}

			return true;
		}));
	}

	public function log_tane($logs)
	{
		if(empty($logs)){
			return false;
		}

		$counted_logs = $logs->groupBy('url')->each(function($item){
			$item->count = $item->count();
		})->sortByDesc('count')->take(10);

		$index = 1;
		foreach($counted_logs as $key => $val){
			$tane_id = str_replace('tane/', '', $key);
			$tane = Tane::find($tane_id);
			$post_id = $tane->post->id;
			$log_tane = new LogMostViewTane([
				'logged_at' => $this->date,
				'num' => $index,
				'post_id' => $post_id,
			]);
			$log_tane->save();
			$index++;
		}
	}

	public function log_nae($logs)
	{
		if(empty($logs)){
			return false;
		}

		$counted_logs = $logs->groupBy('url')->each(function($item){
			$item->count = $item->count();
		})->sortByDesc('count')->take(10);

		$index = 1;
		foreach($counted_logs as $key => $val){
			$nae_id = str_replace('nae/', '', $key);
			$nae = Nae::find($nae_id);
			$post_id = $nae->post->id;
			$log_nae = new LogMostViewNae([
				'logged_at' => $this->date,
				'num' => $index,
				'post_id' => $post_id,
			]);
			$log_nae->save();
			$index++;
		}
	}

	public function log_mi($logs)
	{
		if(empty($logs)){
			return false;
		}

		$counted_logs = $logs->groupBy('url')->each(function($item){
			$item->count = $item->count();
		})->sortByDesc('count')->take(10);

		$index = 1;
		foreach($counted_logs as $key => $val){
			$mi_id = str_replace('mi/', '', $key);
			$mi = Mi::find($mi_id);
			$post_id = $mi->post->id;
			$log_mi = new LogMostViewMi([
				'logged_at' => $this->date,
				'num' => $index,
				'post_id' => $post_id,
			]);
			$log_mi->save();
			$index++;
		}
	}

	public function log_post($logs)
	{
		if(empty($logs)){
			return false;
		}

		$counted_logs = $logs->groupBy('url')->each(function($item){
			$item->count = $item->count();
		})->sortByDesc('count')->take(10);

		$index = 1;
		foreach($counted_logs as $key => $val){
			if($val->first->route->route == 'tane.show'){
				$tane_id = str_replace('tane/', '', $key);
				$tane = Tane::find($tane_id);
				$post_id = $tane->post->id;
				$log_tane = new LogMostViewPost([
					'logged_at' => $this->date,
					'num' => $index,
					'post_id' => $post_id,
				]);
				$log_tane->save();
			}elseif($val->first->route->route == 'nae.show'){
				$nae_id = str_replace('nae/', '', $key);
				$nae = Nae::find($nae_id);
				$post_id = $nae->post->id;
				$log_nae = new LogMostViewPost([
					'logged_at' => $this->date,
					'num' => $index,
					'post_id' => $post_id,
				]);
				$log_nae->save();
			}elseif($val->first->route->route == 'mi.show'){
				$mi_id = str_replace('mi/', '', $key);
				$mi = Mi::find($mi_id);
				$post_id = $mi->post->id;
				$log_mi = new LogMostViewPost([
					'logged_at' => $this->date,
					'num' => $index,
					'post_id' => $post_id,
				]);
				$log_mi->save();
			}
			$index++;
		}
	}}
