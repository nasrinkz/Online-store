<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    public function products(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function size()
    {
        return $this->belongsTo(Size::class,'size_id');
    }
}
