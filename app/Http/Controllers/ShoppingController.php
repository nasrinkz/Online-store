<?php

namespace App\Http\Controllers;

use App\Repositories\Shop\IShop;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    private IShop $shop;

    public function __construct(IShop $shop)
    {
        $this->shop = $shop;
    }

    public function index(Request $request)
    {
        $data = $this->shop->showProducts($request);
        $values = $data[0];
        $brands = $data[1];
        $categories = $data[2];

        if($request->ajax()){
            return view('pages.shop.shop', compact('values','brands','categories'));
        }
        return view('pages.shop.shop', compact('values','brands','categories'));
    }

}
