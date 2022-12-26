<?php

namespace App\Repositories\City;

use App\Models\City;
use App\Models\Province;

class Cities implements ICities
{

    function showCities($request)
    {
        $values=City::when($request->has("title"),function($q)use($request){
            return $q->where("title","like","%".$request->get("title")."%");
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

        $provinces=Province::whereStatus(1)->orderBy('title')->get();

        return [$values,$dataTableInfo,$provinces];
    }

    function validate($request)
    {
        $request->validate([
            'title' => 'required|unique:cities',
            'province_id' => 'required',
            'status' => 'required',
        ],[
        'province_id.required' => 'The Province field is required.',
        ]);
        $data = $request->all();
        $this->create($data);
    }

    function create(array $data)
    {
        $row = new City();
        $row->title = $data['title'];
        $row->province_id = $data['province_id'];
        $row->status = $data['status'];
        $row->save();
        return $data;
    }

    function delete($id)
    {
        City::whereId($id)->delete();
        return True;
    }

    function editStatus($id, $status)
    {
        City::whereId($id)->update([
            'status' => $status
        ]);
        return True;
    }

    function edit($id)
    {
        $value = City::findOrFail($id);
        $provinces=Province::whereStatus(1)->orderBy('title')->get();

        return [$value,$provinces];
    }

    function update($request, $id)
    {
        $request->validate([
            'title' => 'required|unique:cities,title,'.$id,
            'province_id' => 'required',
            'status' => 'required',
        ]);
        $data = City::find($id);
        $request->all();
        $data->title = $request->title;
        $data->province_id = $request->province_id;
        $data->status = $request->status;
        $status = $data->isDirty() ? 1 : 0; //0 means nothing changed
        $data->save();
        return $status;
    }
}
