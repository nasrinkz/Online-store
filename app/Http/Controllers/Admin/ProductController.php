<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Product\IProducts;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private IProducts $products;

    public function __construct(IProducts $products)
    {
        $this->products = $products;
    }

    public function index(Request $request)
    {
        $data = $this->products->showProducts($request);
        $values = $data[0];
        $dataTableInfo = $data[1];
        $colors = $data[2];
        $sizes = $data[3];
        $brands = $data[4];
        $categories = $data[5];

        if($request->ajax()){
            return view('admin.pages.products.getProductsData', compact('values','dataTableInfo','colors','sizes','brands','categories'));
        }
        return view('admin.pages.products.products', compact('values','dataTableInfo','colors','sizes','brands','categories'));
    }

    public function store(Request $request)
    {
        $this->products->validate($request);
        return back()->with(['success' => 'New products successfully added.']);
    }

    public function destroy($id)
    {
        $this->products->delete($id);
        return back()->with(['delete' => 'Selected products successfully deleted.']);
    }

    public function editStatus($id, $status)
    {
        $this->products->editStatus($id, $status);
        return $id;
    }

    public function edit($id)
    {
        $data = $this->products->edit($id);
        $value = $data[0];
        $colors = $data[1];
        $sizes = $data[2];
        $brands = $data[3];
        $categories = $data[4];
        $colorsID = $data[5];
        $sizesID = $data[6];
        return view('admin.pages.products.editProduct', compact('value','colors','sizes','brands','categories','colorsID','sizesID'));
    }

    public function update(Request $request, $id)
    {
        $status = $this->products->update($request, $id);
        return ($status == 1) ? back()->withSuccess('Product details successfully updated.') : back()->withAlert('Nothing changed!');
    }

    public function updateGallery(Request $request, $id)
    {
        $status = $this->products->updateGallery($request, $id);
        return ($status == 1) ? back()->withSuccess('Product gallery successfully updated.') : back()->withAlert('Nothing changed!');
    }

    public function deleteImage($id){
       $this->products->deleteImage($id);
       return back()->withSuccess('Selected image successfully deleted.');
    }
}
