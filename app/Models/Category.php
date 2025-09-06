<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name', 'name_en', 'slug', 'description', 'description_en', 'is_active', 'sort_order',
        'meta_title', 'meta_title_en', 'meta_description', 'meta_description_en'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Helper methods for multilingual content
    public function getLocalizedName($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'en' ? ($this->name_en ?? $this->name) : $this->name;
    }

    public function getLocalizedDescription($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'en' ? ($this->description_en ?? $this->description) : $this->description;
    }

    protected static function booted()
    {
        static::creating(function ($cat) {
            $cat->slug ??= Str::slug($cat->name);
        });
        
        static::updating(function ($cat) {
            // Only update slug if it's not explicitly set in the update
            if ($cat->isDirty('name') && !$cat->isDirty('slug')) {
                $cat->slug = Str::slug($cat->name);
            }
        });
    }
}
