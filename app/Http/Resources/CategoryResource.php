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
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'slug'             => $this->slug,
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
            //  🎯 whenCounted('products') - قاعدة مهمة جداً:
            'products_count' => $this->whenCounted('products'),
          /**
         * 🎯 whenCounted('products') - قاعدة مهمة جداً:
         * 
         * يظهر products_count فقط إذا عملت withCount('products') في Controller
         * 
         * ✅ مع withCount:
         * Category::withCount('products')->get(); 
         * // products_count سيظهر في JSON
         * 
         * ❌ بدون withCount:
         * Category::all(); 
         * // products_count لن يظهر في JSON
         * 
         * 💡 الفكرة: لا ترسل بيانات غير موجودة!
         */
       
        ];
    }
}
