<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id','path','sort_order'];
   // الصورة تنتمي إلى منتج معين
    public function product(){ 
        return $this->belongsTo(Product::class); 
    }
}
