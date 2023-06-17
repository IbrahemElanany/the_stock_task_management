<?php

namespace App\Http\Controllers\Api;

use App\Dto\TaskDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\ListTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\Facades\TaskFacade;
use App\Traits\EmailTrait;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    use EmailTrait;

    public function index(ListTaskRequest $request): JsonResponse
    {
        $tasks = TaskFacade::index();
        return callbackData("Tasks",TaskResource::collection($tasks));
    }

    public function store(CreateTaskRequest $request): JsonResponse
    {
        $task = TaskFacade::create(TaskDto::create($request));
        return callbackData("Task created successfully",new TaskResource($task));
    }

    public function show($id): JsonResponse
    {
        $task = TaskFacade::find($id)->load('attachments');
        if ($task){
            return callbackData("Task details",new TaskResource($task));
        }
        return callbackData("Task not found", (object)[], notFound());
    }

    public function update($id,UpdateTaskRequest $request): JsonResponse
    {
        $updated = TaskFacade::update($id,TaskDto::update($request));
        if ($updated){
            if (isset($request->status)){
                $this->sendUpdatedStatusEmail($id);
            }
            return callbackData("Task updated successfully",(object)[]);
        }
        return callbackData("Task not found", (object)[], notFound());
    }

    public function destroy($id): JsonResponse
    {
        $deleted = TaskFacade::delete($id);
        if ($deleted){
            return callbackData("Task deleted successfully",(object)[]);
        }
        return callbackData("Task not found", (object)[], notFound());
    }
}
