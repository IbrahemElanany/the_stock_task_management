<?php

namespace App\Http\Controllers\Api;

use App\Dto\CollaborationDto;
use App\Dto\TaskDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Collaboration\CreateCollaborationRequest;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\ListTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\CollaborationResource;
use App\Http\Resources\TaskResource;
use App\Services\Facades\CollaborationFacade;
use App\Services\Facades\TaskFacade;
use App\Traits\EmailTrait;
use Illuminate\Http\JsonResponse;

class CollaborationController extends Controller
{

    public function store(CreateCollaborationRequest $request): JsonResponse
    {
        $collaborator = CollaborationFacade::create(CollaborationDto::create($request));
        return callbackData("Collaborator added successfully",new CollaborationResource($collaborator));
    }
}
