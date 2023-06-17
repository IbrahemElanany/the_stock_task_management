<?php

namespace App\Services\Contracts;

use App\Dto\TaskDto;
use App\Models\Task;
use Illuminate\Support\Collection;

interface TaskInterface
{
    public function index(): Collection;

    public function create(TaskDto $taskDto): Task;

    public function update($id, TaskDto $taskDto): bool;
}
