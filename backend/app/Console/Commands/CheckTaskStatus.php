<?php

namespace App\Console\Commands;

use App\Jobs\CheckTaskStatusJob;
use Illuminate\Console\Command;

class CheckTaskStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkTaskStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        CheckTaskStatusJob::dispatch();
    }
}
