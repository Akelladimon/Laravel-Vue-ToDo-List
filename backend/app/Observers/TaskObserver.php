<?php

namespace App\Observers;

use App\Jobs\CheckTaskStatusJob;
use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the Token "created" event.
     *
     * @param  \App\Models\Task $task
     * @return void
     */
    public function created(Task $task)
    {
        CheckTaskStatusJob::dispatch();
    }

}
