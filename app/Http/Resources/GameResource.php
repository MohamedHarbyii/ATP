<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
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
            'description' => $this->description,
            'packages_number' => $this->packages_count ?? null,
            'packages'=>PackageResource::collection($this->whenLoaded('packages')),
            'image' => $lastMedia ? $lastMedia->getUrl() : null,
        ];
    }
}
