<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;
    public function products(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class,'color_id');
    }
}
