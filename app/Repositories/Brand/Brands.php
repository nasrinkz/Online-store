<?php

namespace App\Repositories\Brand;

use App\Models\Brand;

class Brands implements IBrands
{

    function showBrands($request)
    {
        $values=Brand::when($request->has("title"),function($q)use($request){
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

    function validate($request)
    {
        $request->validate([
            'title' => 'required|unique:brands',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'status' => 'required',
        ]);
        $data = $request->all();
        $this->create($data);
    }

    function create($data)
    {
        $imageName = time().'.'.$data['image']->extension();
        $data['image']->move(public_path('images\brands'), $imageName);

        $row = new Brand();
        $row->title = $data['title'];
        $row->image = 'images\brands\\'.$imageName;
        $row->description = $data['description'];
        $row->status = $data['status'];
        $row->save();
        return $data;
    }

    function delete($id)
    {
        $data = Brand::findOrFail($id);
        $image_path = public_path().'/'.$data->image;
        unlink($image_path);
        $data->delete();
        return True;
    }

    function editStatus($id, $status)
    {
        Brand::whereId($id)->update([
            'status' => $status
        ]);
        return True;
    }

    function edit($id)
    {
        $value = Brand::findOrFail($id);
        return $value;
    }

    function update($request, $id)
    {
        $request->validate([
            'title' => 'required|unique:brands,title,'.$id,
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $request->all();
        $data = Brand::findOrFail($id);

        if ($image = $request->file('image')) {
            $image_path = public_path().'/'.$data->image;
            unlink($image_path);
            $imageName = time().'.'.$image->extension();
            $request->file('image')->move(public_path('images\brands'), $imageName);
            $imagePath = 'images\brands\\'.$imageName;
        }else{
            $imagePath = $data->image;
        }
        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->image = $imagePath;
        $status = $data->isDirty() ? 1 : 0; //0 means nothing changed
        $data->save();

        return $status;
    }
}
