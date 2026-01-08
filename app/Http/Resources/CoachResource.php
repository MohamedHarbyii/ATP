<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoachResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lastMedia = $this->media->last();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'image' => $lastMedia ? $lastMedia->getUrl() : null,

            'game' => GameResource::collection($this->whenLoaded('games')),

        ];
    }
}
