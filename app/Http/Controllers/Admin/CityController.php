<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $values=Province::when($request->has("title"),function($q)use($request){
            return $q->where("title","like","%".$request->get("title")."%");
        })->paginate(10);
        //for showing data table info
        (isset($_GET['page'])) ? $page=$_GET['page'] : $page=1;
        if($values->total()>0){
            if($page==1){
                $start_num=1;
            }else{
                $start_num=(($page-1)*10)+1;
            }
            if($page*10>=$values->total()){
                $end_num=$values->total();
            }else {
                $end_num = $page * 10;
            }
            $dataTableInfo='Showing '.$start_num.' to '.$end_num. ' of '.$values->total().' entries';
        }
        else $dataTableInfo="";


        if($request->ajax()){
            return view('admin.pages.cities.getCitiesData ',['values'=>$values,'dataTableInfo'=>$dataTableInfo]);
        }


        return view('admin.pages.cities.cities ',['values'=>$values,'dataTableInfo'=>$dataTableInfo]);

    }

}
