<?php

namespace App\Services\Services;

use App\Dto\AttachmentDto;
use App\Models\Attachment;
use App\Services\Contracts\AttachmentInterface;

class AttachmentService implements AttachmentInterface
{
    public function create(AttachmentDto $attachmentDto): Attachment
    {
        return Attachment::create([
            'task_id' => $attachmentDto->task_id,
            'attachment' => $attachmentDto->attachment
        ]);
    }
}
