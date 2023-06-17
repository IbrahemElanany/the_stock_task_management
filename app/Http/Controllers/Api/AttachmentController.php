<?php

namespace App\Http\Controllers\Api;

use App\Dto\AttachmentDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Attachment\CreateAttachmentRequest;
use App\Http\Resources\AttachmentResource;
use App\Http\Resources\CollaborationResource;
use App\Jobs\ResizeImageJob;
use App\Services\Facades\AttachmentFacade;
use App\Services\Facades\CollaborationFacade;
use Illuminate\Http\JsonResponse;

class AttachmentController extends Controller
{

    public function store(CreateAttachmentRequest $request): JsonResponse
    {
        $attachment = AttachmentFacade::create(AttachmentDto::create($request));
        // resize image
        ResizeImageJob::dispatch($attachment->getRawOriginal('attachment'));
        return callbackData("Attachment added successfully",new AttachmentResource($attachment));
    }
}
