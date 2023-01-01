<?php

namespace App\Repositories\Province;
use App\Models\Province;

class Provinces implements IProvinces
{
    public function showProvinces($request)
    {
        $values=Province::when($request->has("title"),function($q)use($request){
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

        return [$values,$dataTableInfo];
    }

    public function validate($request)
    {
        $request->validate([
            'title' => 'required|unique:provinces',
            'status' => 'required',
        ]);
        $data = $request->all();
        $this->create($data);
    }

    public function create(array $data)
    {
        $row = new Province();
        $row->title = $data['title'];
        $row->status = $data['status'];
        $row->save();
        return $data;
    }

    public function delete($id)
    {
        Province::whereId($id)->delete();
        return True;
    }

    public function editStatus($id,$status){
        Province::whereId($id)->update([
            'status' => $status
        ]);
        return True;
    }

    public function edit($id)
    {
        $value = Province::findOrFail($id);
        return $value;
    }

    public function update($request,$id)
    {
        $request->validate([
            'title' => 'required|unique:provinces,title,'.$id,
            'status' => 'required',
        ]);
        $data = Province::find($id);
        $request->all();
        $data->title = $request->title;
        $data->status = $request->status;
        $status = $data->isDirty() ? 1 : 0; //0 means nothing changed
        $data->save();
        return $status;
    }
}
