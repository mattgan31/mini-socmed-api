<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->ulid,
            'parent_id' => $this->parent?->ulid,
            'content' => $this->content,
            'likes' => $this->likes_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserResource(
                $this->whenLoaded('user')
            )
        ];
    }
}
