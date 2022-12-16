<?php

namespace App\Enum;

enum TaskStatus: string
{
    case DONE = 'completed';
    case PROGRESS = 'progress';
}
