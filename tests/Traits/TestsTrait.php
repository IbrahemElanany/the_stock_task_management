<?php

namespace Tests\Traits;

use App\Models\Task;
use App\Models\User;

trait TestsTrait
{
    function getUser()
    {
        return User::whereHas('tasks')->first();
    }
    function getUserToken($user)
    {
        $token = $user->createToken($user->name)->plainTextToken;
        return $token;
    }

    function fakeTaskStoreData()
    {
        return ['title' => 'Title', 'description' => 'Description', 'due_date' => now()->addDay()->format('Y-m-d'), 'status' => 'incomplete'];
    }

    function wrongFakeTaskStoreData()
    {
        return ['title' => 'Title', 'description' => 'Description', 'due_date' => now()->addDay(), 'status' => 'incomplete'];
    }

    function getOneOfMyTasks($user)
    {
        return Task::where('user_id', $user->id)->first();
    }

    function getTaskNotMine($user)
    {
        return Task::where('user_id', '<>', $user->id)->first();
    }
}
