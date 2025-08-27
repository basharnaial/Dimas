<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductImageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'sku' => $this->sku,
            'hero_image' => $this->hero_image,
            'hero_image_url' => $this->hero_image ? Storage::url($this->hero_image) : null,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'specs' => $this->specs ?? (object)[],
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'images' => ProductImageResource::collection($this->whenLoaded('images')),
        ];
    }
}
