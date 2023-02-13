<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function images(){
        return $this->hasMany(ProductImage::class,'product_id');
    }
    public function colorsTable(){
        return $this->hasMany(ProductColor::class,'product_id');
    }
    public function sizesTable(){
        return $this->hasMany(ProductSize::class,'product_id');
    }
    public function wishes()
    {
        return $this->hasMany(Wish::class,'product_id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class,'product_id');
    }
}
