<?php

namespace App\Services\Services;

use App\Dto\TaskDto;
use App\Models\Task;
use App\Services\Contracts\TaskInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TaskService implements TaskInterface
{
    public function index(): Collection
    {
        $tasks = Task::owner()
            ->when(request()->has('search'), function ($query) {
                $query->where(function ($search) {
                    $search->where('title', 'LIKE', '%'.request()->search.'%')
                        ->orWhere('description', 'LIKE', '%'.request()->search.'%');
                });
            })
            ->when(request()->has('status'), function ($query) {
                $query->where('status', request()->status);
            })
            ->get();
        return $tasks;
    }
    public function create(TaskDto $taskDto): Task
    {
        return Task::create([
            'user_id' => auth()->id(),
            'title' => $taskDto->title,
            'description' => $taskDto->description,
            'due_date' => $taskDto->due_date,
            'status' => $taskDto->status
        ]);
    }

    public function find($id): Task|null
    {
        return Task::where('id',$id)->owner()->first();
    }

    public function update($id, TaskDto $taskDto): bool
    {
        return Task::where('id',$id)->owner()->update([
            'title' => $taskDto->title,
            'description' => $taskDto->description,
            'due_date' => $taskDto->due_date,
            'status' => $taskDto->status
        ]);
    }

    public function delete($id): bool
    {
        return Task::where('id',$id)->owner()->delete();
    }
}
