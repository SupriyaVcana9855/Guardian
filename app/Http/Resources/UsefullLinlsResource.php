<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsefullLinlsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'link_type' => $this->link_type,
            'description_1' => $this->description_1,
            'image' => $this->image,
            'background_image' => $this->background_image,
            'background_color' => $this->background_color,
            'pointers' => json_decode($this->pointers),
        ];
    }
}
