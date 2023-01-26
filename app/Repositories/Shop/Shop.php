<?php

namespace App\Repositories\Shop;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class Shop implements IShop
{

    function showProducts($request)
    {
        $values=Product::whereStatus('1')->when($request->has("title"),function($q)use($request){
            return $q->where("title","like","%".$request->get("title")."%");
        })->when($request->has("sellingPrice"),function($q)use($request){
            return $q->where("sellingPrice","like","%".$request->get("sellingPrice")."%");
        })->when($request->has("category_id") && !empty($request->category_id),function($q)use($request){
            return $q->where("category_id",$request->get("category_id"));
        })->latest()->paginate(3);

//        $colors=Color::whereStatus('1')->orderBy('title')->get();
//        $sizes=Size::whereStatus('1')->orderBy('title')->get();
        $brands=Brand::whereStatus('1')->orderBy('title')->get();
        $categories=Category::whereStatus('1')->orderBy('title')->get();

        return [$values,$brands,$categories];
    }
}
