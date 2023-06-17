<?php

namespace App\Services\Services;

use App\Dto\CollaborationDto;
use App\Models\Collaboration;
use App\Services\Contracts\CollaborationInterface;

class CollaborationService implements CollaborationInterface
{
    public function create(CollaborationDto $collaborationDto): Collaboration
    {
        return Collaboration::create([
            'user_id' => $collaborationDto->user_id,
            'task_id' => $collaborationDto->task_id
        ]);
    }
}
