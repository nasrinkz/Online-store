<?php

namespace App\Repositories\Shop;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Wish;
use Illuminate\Support\Facades\Auth;

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
        Wish::where('product_id',$productId)->delete();
        return True;
    }

    function wishList()
    {
        $values = Wish::where('user_id',auth()->user()->id)->orderBy('id','DESC')->paginate(8);
        return $values;
    }

    function addCart($request){
        $request->validate([
            'size_id' => 'required',
            'color_id' => 'required',
            'number' => 'required',
        ]);
        $data = $request->all();

        $row = new Cart();
        $row->size_id = $data['size_id'];
        $row->color_id = $data['color_id'];
        $row->number = $data['number'];
        $row->product_id = $data['product_id'];
        $row->userIP = $data['userIP'];
        if (Auth::check()){
            $row->user_id = auth()->user()->id;
        }
        $row->save();
        return True;
    }

    function cartList(){
        if(Auth::check()){
            $values = Cart::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        }else{
            $values = Cart::where(['user_id'=>null,'userIP'=>\Request::getClientIp(true)])->orderBy('id','DESC')->get();
        }
        return $values;
    }

    function removeFromCart($id){
        Cart::findOrFail($id)->delete();
        return True;
    }

    function checkCoupon($request){
        $request->validate([
            'coupon' => 'required',
        ]);
        $data = $request->all();

        $value = Coupon::where('status','1')->where('startDate' ,'<', date('Y-m-d H:i:s'))->where('expireDate','>',date('Y-m-d H:i:s'))->where('code',$data['coupon'])->first();
        if ($value){
            return [1,$value->discount];
        }else{
            return [2,0];
        }
    }

}
