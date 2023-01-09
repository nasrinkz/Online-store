<?php

namespace App\Repositories\Color;

use App\Models\Color;

class Colors implements IColors
{

    function showColors($request)
    {
        $values=Color::when($request->has("title"),function($q)use($request){
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
            'title' => 'required|unique:colors',
            'code' => 'required|unique:colors',
            'status' => 'required',
        ]);
        $data = $request->all();
        $this->create($data);
    }

    public function create($data)
    {
        $row = new Color();
        $row->title = $data['title'];
        $row->code = $data['code'];
        $row->status = $data['status'];
        $row->save();
        return $data;
    }

    public function delete($id)
    {
        Color::whereId($id)->delete();
        return True;
    }

    public function editStatus($id,$status){
        Color::whereId($id)->update([
            'status' => $status
        ]);
        return True;
    }

    public function edit($id)
    {
        $value = Color::findOrFail($id);
        return $value;
    }

    public function update($request,$id)
    {
        $request->validate([
            'title' => 'required|unique:colors,title,'.$id,
            'code' => 'required|unique:colors,code,'.$id,
            'status' => 'required',
        ]);
        $data = Color::find($id);
        $request->all();
        $data->title = $request->title;
        $data->code = $request->code;
        $data->status = $request->status;
        $status = $data->isDirty() ? 1 : 0; //0 means nothing changed
        $data->save();
        return $status;
    }
}
