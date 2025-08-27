<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'is_active', 'sort_order',
        'meta_title', 'meta_description'
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
