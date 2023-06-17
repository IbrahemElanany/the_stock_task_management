<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => (int) $this->id,
            'user_id'           => (int) $this->user_id,
            'title'             => (string) $this->title,
            'description'       => (string) $this->description,
            'due_date'          => (string) $this->due_date,
            'status'            => (string) $this->status,
            'attachments'       => AttachmentResource::collection($this->whenLoaded('attachments'))
        ];
    }
}
