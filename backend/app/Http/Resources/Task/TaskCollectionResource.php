<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\BaseJsonCollectionResource;

class TaskCollectionResource extends BaseJsonCollectionResource
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = TaskResource::class;
}
