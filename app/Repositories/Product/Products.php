<?php

namespace App\Repositories\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Support\Facades\File;

class Products implements IProducts
{

    function showProducts($request)
    {
        $values=Product::when($request->has("title"),function($q)use($request){
            return $q->where("title","like","%".$request->get("title")."%");
        })->when($request->has("sellingPrice"),function($q)use($request){
            return $q->where("sellingPrice","like","%".$request->get("sellingPrice")."%");
        })->when($request->has("category_id") && !empty($request->category_id),function($q)use($request){
            return $q->where("category_id",$request->get("category_id"));
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

        $colors=Color::whereStatus('1')->orderBy('title')->get();
        $sizes=Size::whereStatus('1')->orderBy('title')->get();
        $brands=Brand::whereStatus('1')->orderBy('title')->get();
        $categories=Category::whereStatus('1')->orderBy('title')->get();

        return [$values,$dataTableInfo,$colors,$sizes,$brands,$categories];
    }

    function validate($request)
    {
        $request->validate([
            'title' => 'required|unique:products',
            'description' => 'required',
            'shortDescription' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'originalPrice' => 'required',
            'sellingPrice' => 'required',
            'status' => 'required',
            'special' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'image' => 'required',
        ],[
            'brand_id.required' => 'The brand field is required.',
            'category_id.required' => 'The category field is required.',
            'color_id.required' => 'The color field is required.',
            'size_id.required' => 'The size field is required.',
        ]);
        $data = $request->all();
        $this->create($data);
    }

    function create(array $data)
    {
        $colors = $data['color_id'];
        $data['color_id'] = implode(',', $colors);
        $sizes = $data['size_id'];
        $data['size_id'] = implode(',', $sizes);

        $coverName = time().'.'.$data['cover']->extension();
        $data['cover']->move(public_path('images\products\cover'), $coverName);
        $row = new Product();
        $row->title = $data['title'];
        $row->cover = 'images\products\cover\\'.$coverName;
        $row->description = $data['description'];
        $row->shortDescription = $data['shortDescription'];
        $row->brand_id = $data['brand_id'];
        $row->category_id = $data['category_id'];
        $row->originalPrice = $data['originalPrice'];
        $row->sellingPrice = $data['sellingPrice'];
        $row->status = $data['status'];
        $row->special = $data['special'];
        $row->colors = $data['color_id'];
        $row->sizes = $data['size_id'];
        $row->header = $data['header'];
        $row->save();
        $product_id = $row->id;

        $files=$data['image'];
        foreach($files as $file){
            $imageName=time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images\products\images'), $imageName);
            $row = new ProductImage();
            $row->product_id = $product_id;
            $row->image = 'images\products\images\\'.$imageName;
            $row->save();
        }

        foreach (explode(',', $data['color_id']) as $color){
            $row = new ProductColor();
            $row->color_id = $color;
            $row->product_id = $product_id;
            $row->number = $data['colorNumber'.$color];
            $row->save();
        }

        foreach (explode(',', $data['size_id']) as $size){
            $row = new ProductSize();
            $row->size_id = $size;
            $row->product_id = $product_id;
            $row->number = $data['sizeNumber'.$size];
            $row->save();
        }
        return $data;
    }

    function editStatus($id, $status)
    {
        Product::whereId($id)->update([
            'status' => $status
        ]);
        return True;
    }

    function delete($id)
    {
        $data=Product::findOrFail($id);
        $image_path = public_path().'/'.$data->cover;
        unlink($image_path);
        $data->delete();

        $images=ProductImage::where("product_id",$id)->get();
        foreach($images as $image) {
            $image_path = public_path().'/'.$image->image;
            unlink($image_path);
        }
        ProductImage::where("product_id",$id)->delete();

        ProductSize::where("product_id",$id)->delete();

        ProductColor::where("product_id",$id)->delete();

        return True;
    }

    function edit($id)
    {
        $value = Product::findOrFail($id);
        $colors=Color::whereStatus('1')->orderBy('title')->get();
        $sizes=Size::whereStatus('1')->orderBy('title')->get();
        $brands=Brand::whereStatus('1')->orderBy('title')->get();
        $categories=Category::whereStatus('1')->orderBy('title')->get();

        $colorsID = explode("," , $value->colors);
        $sizesID = explode("," , $value->sizes);

        return [$value,$colors,$sizes,$brands,$categories,$colorsID,$sizesID];
    }

    function update($request, $id)
    {
        $request->validate([
            'title' => 'required|unique:products,title,'.$id,
            'description' => 'required',
            'shortDescription' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'originalPrice' => 'required',
            'sellingPrice' => 'required',
            'status' => 'required',
            'special' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
        ],[
            'brand_id.required' => 'The brand field is required.',
            'category_id.required' => 'The category field is required.',
            'color_id.required' => 'The color field is required.',
            'size_id.required' => 'The size field is required.',
        ]);

        $data = Product::find($id);
        $request->all();

        $colors = $request->color_id;
        $request->color_id = implode(',', $colors);
        $sizes = $request->size_id;
        $request->size_id = implode(',', $sizes);

        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->special = $request->special;
        $data->shortDescription = $request->shortDescription;
        $data->brand_id = $request->brand_id;
        $data->category_id = $request->category_id;
        $data->originalPrice = $request->originalPrice;
        $data->sellingPrice = $request->sellingPrice;
        $data->status = $request->status;
        $data->colors = $request->color_id;
        $data->sizes = $request->size_id;
        $data->header = $request->header;
        $data->save();

        ProductSize::where("product_id",$id)->delete();
        ProductColor::where("product_id",$id)->delete();

        foreach (explode(',',$request->color_id) as $color){
            $name='colorNumber'.$color;
            $row = new ProductColor();
            $row->color_id = $color;
            $row->product_id = $id;
            $row->number = $request->$name;
            $row->save();
        }

        foreach (explode(',', $request->size_id) as $size){
            $name='sizeNumber'.$size;
            $row = new ProductSize();
            $row->size_id = $size;
            $row->product_id = $id;
            $row->number = $request->$name;
            $row->save();
        }

        return 1;
    }

    function updateGallery($request, $id)
    {
        $data = Product::find($id);
        $request->all();
        if ($image = $request->file('cover')) {
            $image_path = public_path().'/'.$data->cover;
            unlink($image_path);
            $imageName = time().'.'.$image->extension();
            $request->file('cover')->move(public_path('images\products\cover'), $imageName);
            $imagePath = 'images\products\cover\\'.$imageName;
        }else {
            $imagePath = $data->cover;
        }
        $data->cover = $imagePath;
        $data->save();

        $image=ProductImage::where('product_id',$id)->count();
        if ($image<1){
            $request->validate([
                'image' => 'required',]);
        }
        $files=$request->image;
        if ($request->file('image')) {
            foreach ($files as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images\products\images'), $imageName);
                $row = new ProductImage();
                $row->product_id = $id;
                $row->image = 'images\products\images\\' . $imageName;
                $row->save();
            }
        }
        return 1;
    }

    function deleteImage($id){
        $image=ProductImage::findOrFail($id);
        $image_path = public_path().'/'.$image->image;
        unlink($image_path);
        $image->delete();
        return true;
    }
}
