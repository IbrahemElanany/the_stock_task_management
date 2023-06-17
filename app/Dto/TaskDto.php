<?php

namespace App\Dto;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\ListTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;

class TaskDto
{

    public function __construct(
        public readonly ?string $title="",
        public readonly ?string $description="",
        public readonly ?string $due_date="",
        public readonly ?string $status="",
    )
    {
        //
    }

    public static function create(CreateTaskRequest $request): TaskDto
    {
        return new self(
            title: $request->title,
            description: $request->description,
            due_date: $request->due_date,
            status: $request->status,
        );
    }

    public static function update(UpdateTaskRequest $request): TaskDto
    {
        return new self(
            title: $request->title,
            description: $request->description,
            due_date: $request->due_date,
            status: $request->status,
        );
    }
}
