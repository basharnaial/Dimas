<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
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
            'description' => $this->getLocalizedDescription($locale),
            'description_ar' => $this->description,
            'description_en' => $this->description_en,
            'meta_title' => $locale === 'en' ? ($this->meta_title_en ?? $this->meta_title) : $this->meta_title,
            'meta_description' => $locale === 'en' ? ($this->meta_description_en ?? $this->meta_description) : $this->meta_description,
            'is_active' => $this->is_active,
            'products_count' => $this->whenCounted('products'),
        ];
    }
}
