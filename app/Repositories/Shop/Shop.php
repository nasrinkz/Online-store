<?php

namespace App\Repositories\Shop;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class Shop implements IShop
{

    function showProducts($request)
    {
        $sort = 'DESC';
        if ($request->sort=='date'){
            $sortBy = 'created_at';
        }elseif ($request->sort=='cheap'){
            $sortBy = 'sellingPrice';
            $sort = 'ASC';
        }else{
            $sortBy = 'sellingPrice';
        }
        $values=Product::whereStatus('1')->when($request->has("search"),function($q)use($request){
            return $q->where("title","like",'%'.$request->get("search").'%');
        })->when($request->has("title"),function($q)use($request){
            return $q->where("title","like",'%'.$request->get("title").'%');
        })->when($request->has("brand")& !empty($request->brand),function($q)use($request){
            return $q->where("brand_id","like",$request->get("brand"));
        })->when($request->has("category") && !empty($request->category),function($q)use($request){
            return $q->where("category_id",$request->get("category"));
        })->when($request->has("special"),function($q)use($request){
            return $q->where("special",1);
        })->orderBy($sortBy,$sort)->paginate(9);

        $brands=Brand::whereStatus('1')->orderBy('title')->get();
        $categories=Category::whereStatus('1')->orderBy('title')->get();

        return [$values,$brands,$categories];
    }

    function details($id){
        $value = Product::findOrFail($id);
        $products = Product::whereStatus('1')->where("category_id",$value->category_id)->orderByDesc('id')->limit(6)->get();
        return [$value,$products];
    }

}
