<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id','name','slug','sku','hero_image',
        'short_description','description','specs',
        'meta_title','meta_description'
    ];

    protected $casts = [
        'specs' => 'array',
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

    protected static function booted()
    {
        static::creating(function ($p) {
            $p->slug ??= Str::slug($p->name);
        });
    }
}
