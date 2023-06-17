<?php

namespace App\Dto;

use App\Http\Requests\Collaboration\CreateCollaborationRequest;

class CollaborationDto
{

    public function __construct(
        public readonly string $task_id,
        public readonly string $user_id,
    )
    {
        //
    }

    public static function create(CreateCollaborationRequest $request): CollaborationDto
    {
        return new self(
            task_id: $request->task_id,
            user_id: $request->user_id,
        );
    }
}
