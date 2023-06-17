<?php

namespace App\Traits;

use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskStatusUpdated;

trait EmailTrait
{
    public function sendUpdatedStatusEmail($taskId)
    {
        $task = Task::findOrFail($taskId);
        auth()->user()->notify(new TaskStatusUpdated($task));
    }
}
