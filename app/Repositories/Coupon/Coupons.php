<?php

namespace App\Repositories\Coupon;
use App\Models\Coupon;

class Coupons implements ICoupons
{

    function showCoupons($request)
    {
        $values=Coupon::when($request->has("title"),function($q)use($request){
            return $q->where("title","like","%".$request->get("title")."%");
        })->when($request->has("code"),function($q)use($request){
        return $q->where("code","like","%".$request->get("code")."%");
        })->latest()->paginate(10);

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

        return [$values,$dataTableInfo];
    }

    function validate($request)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'title' => 'required',
            'status' => 'required',
        ]);
        $data = $request->all();
        $this->create($data);
    }

    function create(array $data)
    {
        if ($data['startDate']){
            $startDate=$data['startDate'];
        }else{
            $startDate=date('Y-m-d H:i:s');
        }

        $row = new Coupon();
        $row->title = $data['title'];
        $row->code = $data['code'];
        $row->status = $data['status'];
        $row->startDate = $startDate;
        $row->expireDate = $data['expireDate'];
        $row->save();
        return $data;
    }

    function delete($id)
    {
        Coupon::whereId($id)->delete();
        return True;
    }

    function editStatus($id, $status)
    {
        Coupon::whereId($id)->update([
            'status' => $status
        ]);
        return True;
    }

    function edit($id)
    {
        $value = Coupon::findOrFail($id);
        return $value;
    }

    function update($request, $id)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code,'.$id,
            'title' => 'required',
            'status' => 'required',
        ]);
        $request->all();
        if ($request->startDate){
            $startDate=$request->startDate;
        }else{
            $startDate=date('Y-m-d H:i:s');
        }
        $data = Coupon::findOrFail($id);
        $data->title = $request->title;
        $data->code = $request->code;
        $data->startDate = $startDate;
        $data->expireDate = $request->expireDate;
        $data->status = $request->status;
        $status = $data->isDirty() ? 1 : 0; //0 means nothing changed
        $data->save();
        return $status;
    }
}
