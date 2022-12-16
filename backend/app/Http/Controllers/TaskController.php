<?php

namespace App\Http\Controllers;

use App\Enum\TaskStatus;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\Task\TaskCollectionResource;
use App\Http\Resources\Task\TaskResource;
use App\Jobs\CheckTaskStatusJob;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TaskCollectionResource
     */
    public function index()
    {
        $tasks = Task::all()->sortByDesc('expires_at');

        return new TaskCollectionResource($tasks);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTaskRequest $request
     * @return TaskResource
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create([
            'name' => $request->name,
            'status' => TaskStatus::PROGRESS->value,
            'expires_at' => Carbon::now()->addMinutes(5),
        ]);

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTaskRequest $request
     * @param  \App\Models\Task $task
     *
     * @return TaskResource
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->status = $request->status;
        if ($request->status === TaskStatus::PROGRESS->value) {
            $task->expires_at = Carbon::now()->addMinutes(5);
        }
        $task->save();

        CheckTaskStatusJob::dispatch();

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Task $task)
    {
        if (empty($task)) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Announcement not found.'
            ]);
        }

        $task->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Announcement deleted.'
        ]);

    }
}
