<?php

namespace App\Dto;

use App\Http\Requests\Attachment\CreateAttachmentRequest;

class AttachmentDto
{

    public function __construct(
        public readonly string $task_id,
        public $attachment,
    )
    {
        //
    }

    public static function create(CreateAttachmentRequest $request): AttachmentDto
    {
        return new self(
            task_id: $request->task_id,
            attachment: $request->attachment,
        );
    }
}
