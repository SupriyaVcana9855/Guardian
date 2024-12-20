<?php

namespace App\Http\Resources;

use App\Models\BackgroundImage;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $background = BackgroundImage::where('category','about')->first();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description_1' => $this->description_1,
            'description_2' => $this->description_2,
            'button_content' => $this->button_content,
            'button_link' => $this->button_link,
            'image' => $this->image,
            'background_image' => $background->background_image,
            'background_color' => $background->background_color,
            
        ];
    }
}
