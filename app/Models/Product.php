<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id','name','name_en','slug','sku','hero_image',
        'short_description','short_description_en','description','description_en',
        'specs','option_tables','meta_title','meta_title_en',
        'meta_description','meta_description_en','is_active'
    ];

    protected $casts = [
        'specs' => 'array',
        'option_tables' => 'array',
        'is_active' => 'boolean',
    ];

    // نحن في مودل المنتج
    // يعني المنتج ينتمي إلى قسم معين
    // تذكر اننا نذكر العلاقة بين المنتج والقسم وبكل واحد نضع العكس
    public function category(){
         return $this->belongsTo(Category::class); 
        }


    // images(): المنتج له صور كثيرة، مرتبة حسب 
    // sort_order
    public function images(){ 
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
     }

    public function getRouteKeyName(): string { return 'slug'; }

    // Helper methods for multilingual content
    public function getLocalizedName($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'en' ? ($this->name_en ?? $this->name) : $this->name;
    }

    public function getLocalizedShortDescription($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'en' ? ($this->short_description_en ?? $this->short_description) : $this->short_description;
    }

    public function getLocalizedDescription($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'en' ? ($this->description_en ?? $this->description) : $this->description;
    }

    protected static function booted()
    {
        static::creating(function ($p) {
            $p->slug ??= Str::slug($p->name);
        });
    }
}
