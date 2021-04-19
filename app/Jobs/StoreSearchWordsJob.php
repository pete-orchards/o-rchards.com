<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\LogSearchWord;
use Log;

class StoreSearchWordsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $log_search_word;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(LogSearchWord $log_search_word)
    {
        $this->log_search_word = $log_search_word;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info($this->log_search_word);
        $this->log_search_word->save();
    }
}
