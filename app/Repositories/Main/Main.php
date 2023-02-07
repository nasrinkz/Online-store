<?php

namespace App\Repositories\Main;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Main implements IMain
{

    public function index()
    {
//        $headerProduct = Product::whereMonth('created_at', Carbon::now()->month)->firstWhere('status','1');
//        if (!$headerProduct){
//            $headerProduct = Product::whereStatus('1')->get()->last();
//        }
        $headerProduct = Product::where(['header'=>'yes','status'=>'1'])->get()->last();

        $brands = Brand::select('id','image','title')->whereStatus('1')->orderByDesc('id')->limit(5)->get();
        $specialProducts = Product::where(['status'=>'1','special'=>'1'])->orderByDesc('id')->limit(10)->get();
        $middleBanner = Banner::where(['status'=>'1','position'=>'middle'])->first();
        $topSales =OrderDetail::leftJoin('products','products.id','=','order_details.product_id')
            ->select('products.id','products.cover','products.title','products.sellingPrice','products.originalPrice','order_details.product_id',
                DB::raw('SUM(order_details.number) as total'))
            ->groupBy('products.id','products.cover','products.title','products.sellingPrice','products.originalPrice','order_details.product_id')
            ->orderBy('total','desc')
            ->limit(6)
            ->get();
        $categories = Category::whereStatus('1')->orderByDesc('id')->limit(4)->get();
        $productCount = [];
        foreach ($categories as $category){
            $count = $category->products()->where(['status'=>'1'])->count();
            $productCount += [$category->id => $count];

        }
        return [$headerProduct,$brands,$specialProducts,$middleBanner,$topSales,$categories,$productCount];
    }
}
