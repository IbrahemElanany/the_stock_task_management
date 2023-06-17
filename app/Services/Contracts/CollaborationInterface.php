<?php

namespace App\Services\Contracts;

use App\Dto\CollaborationDto;
use App\Models\Collaboration;

interface CollaborationInterface
{
    public function create(CollaborationDto $collaborationDto): Collaboration;
}
