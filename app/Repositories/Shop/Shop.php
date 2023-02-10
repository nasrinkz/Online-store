<?php

namespace App\Repositories\Shop;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wish;

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

    function categories(){
        $categories = Category::whereStatus('1')->orderBy('title')->paginate(12);
        $productCount = [];
        foreach ($categories as $category){
            $count = $category->products()->where(['status'=>'1'])->count();
            $productCount += [$category->id => $count];
        }
        return [$categories,$productCount];
    }

    function sales($request)
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
        $values=Product::whereStatus('1')->whereRaw('sellingPrice != originalPrice')->when($request->has("search"),function($q)use($request){
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

    function addWish($productId){
        $row = new Wish();
        $row->product_id = $productId;
        $row->user_id = auth()->user()->id;
        $row->save();
        return True;
    }

    function removeWish($productId){
        $data = Wish::where('product_id',$productId)->delete();
        return True;
    }

}
