<?php

namespace App\Services\Contracts;

use App\Dto\AttachmentDto;
use App\Models\Attachment;

interface AttachmentInterface
{
    public function create(AttachmentDto $attachmentDto): Attachment;
}
