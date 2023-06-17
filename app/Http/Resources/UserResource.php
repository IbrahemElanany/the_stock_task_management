<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'              => (string) $this->name,
            'email'             => (string) $this->email,
            'tasks'             => TaskResource::collection($this->tasks),
            'collaborations'    => CollaborationResource::collection($this->collaborations),
            'created_at'        => date('Y-M-d h:i:s A', strtotime($this->created_at))
        ];
    }
}
