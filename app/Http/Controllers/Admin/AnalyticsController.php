<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\IdeaTheme;
use App\ActionLog;
use App\LogSearchWord;
use Illuminate\Support\LazyCollection;

class AnalyticsController extends Controller
{
	public function logs(){
		$action_logs_all = ActionLog::all();
		$action_logs = $action_logs_all->whereNotNull('route');

		$log_urls = $action_logs->groupBy('url')->each(function($item){
			$item->count = $item->count();
		})->sortByDesc('count');

		$param = [
			'action_logs' => $action_logs,
			'log_urls' => $log_urls,
		];
		return view('admin.logs', $param);
	}

	public function log_search_words(){
		$log_search_words = LogSearchWord::all();

		$log_grouped = $log_search_words->groupBy('keywords')->each(function($item){
			$item->count = $item->count();
		})->sortByDesc('count');

		$param = [
			'log_search_words' => $log_search_words,
			'log_grouped' => $log_grouped,
		];
		return view('admin.log_search_words', $param);
	}
}
