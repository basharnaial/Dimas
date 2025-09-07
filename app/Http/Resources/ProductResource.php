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
        $locale = $request->get('locale', app()->getLocale());
        
        return [
            'id' => $this->id,
            'name' => $this->getLocalizedName($locale),
            'name_ar' => $this->name,
            'name_en' => $this->name_en,
            'slug' => $this->slug,
            'sku' => $this->sku,
            'hero_image' => $this->hero_image,
            'hero_image_url' => $this->hero_image ? Storage::url($this->hero_image) : null,
            'short_description' => $this->getLocalizedShortDescription($locale),
            'short_description_ar' => $this->short_description,
            'short_description_en' => $this->short_description_en,
            'description' => $this->getLocalizedDescription($locale),
            'description_ar' => $this->description,
            'description_en' => $this->description_en,
            'specs' => $this->specs ?? (object)[],
            'option_tables' => $this->option_tables ?? [],
            'meta_title' => $locale === 'en' ? ($this->meta_title_en ?? $this->meta_title) : $this->meta_title,
            'meta_description' => $locale === 'en' ? ($this->meta_description_en ?? $this->meta_description) : $this->meta_description,
            'is_active' => $this->is_active,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'images' => ProductImageResource::collection($this->whenLoaded('images')),
        ];
    }
}
