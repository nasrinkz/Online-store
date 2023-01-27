<?php

namespace App\Http\Controllers;

use App\Repositories\Main\IMain;

class MainController extends Controller
{
    private IMain $main;

    public function __construct(IMain $main)
    {
        $this->main = $main;
    }

    public function index()
    {
        $data = $this->main->index();
        $headerProduct = $data[0];
        $brands = $data[1];
        $specialProducts = $data[2];
        $middleBanner = $data[3];
        $topSales = $data[4];
        $categories = $data[5];
        $productCount = $data[6];
        $categoriesMenu = $data[7];
        return view('pages.index',compact('headerProduct','brands','specialProducts','middleBanner','topSales','categories','productCount','categoriesMenu'));
    }
}
