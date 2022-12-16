<?php

namespace App\Jobs;

use App\Enum\TaskStatus;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckTaskStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const LIMIT_PROGRESS = 2;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tasks = Task::where('status', '=', TaskStatus::PROGRESS->value)->latest('updated_at')->get();

        foreach ($tasks as $index => $task) {
            if ($index >= self::LIMIT_PROGRESS || $task->expires_at <= Carbon::now()) {
                $task->status = TaskStatus::DONE->value;
                $task->save();
            }
        }
    }
}
