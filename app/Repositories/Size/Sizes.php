<?php

namespace App\Repositories\Size;

use App\Models\Size;

class Sizes implements ISizes
{

    function showSizes($request)
    {
        $values=Size::latest()->paginate(10);
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
            'title' => 'required|unique:sizes',
            'symbol' => 'required|unique:sizes|max:5',
            'status' => 'required',
        ]);
        $data = $request->all();
        $this->create($data);
    }

    function create($data)
    {
        $row = new Size();
        $row->title = $data['title'];
        $row->symbol = $data['symbol'];
        $row->status = $data['status'];
        $row->save();
        return $data;
    }

    function delete($id)
    {
        $data = Size::findOrFail($id);
        $data->delete();
        return True;
    }

    function editStatus($id, $status)
    {
        Size::whereId($id)->update([
            'status' => $status
        ]);
        return True;
    }

    function edit($id)
    {
        $value = Size::findOrFail($id);
        return $value;
    }

    function update($request, $id)
    {
        $request->validate([
            'title' => 'required|unique:sizes,title,'.$id,
            'symbol' => 'required|max:5|unique:sizes,symbol,'.$id,
        ]);
        $request->all();

        $data = Size::findOrFail($id);
        $data->title = $request->title;
        $data->symbol = $request->symbol;
        $data->status = $request->status;
        $status = $data->isDirty() ? 1 : 0; //0 means nothing changed
        $data->save();

        return $status;
    }
}
