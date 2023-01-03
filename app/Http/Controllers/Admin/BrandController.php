<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Repositories\Brand\IBrands;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    private IBrands $brands;

    public function __construct(IBrands $brands)
    {
        $this->brands = $brands;
    }

    public function index(Request $request)
    {
        $data = $this->brands->showBrands($request);
        $values = $data[0];
        $dataTableInfo = $data[1];
        if($request->ajax()){
            return view('admin.pages.brands.getBrandsData', compact('values','dataTableInfo'));
        }
        return view('admin.pages.brands.brands', compact('values','dataTableInfo'));
    }

    public function store(Request $request)
    {
        $this->brands->validate($request);
        return back()->with(['success' => 'New brand successfully added.']);
    }

    public function destroy($id)
    {
        $this->brands->delete($id);
        return back()->with(['delete' => 'Selected brand successfully deleted.']);
    }

    public function editStatus($id, $status)
    {
        $this->brands->editStatus($id, $status);
        return $id;
    }

    public function edit($id)
    {
        $value = $this->brands->edit($id);
        return view('admin.pages.brands.editBrand', compact('value'));
    }

    public function update(Request $request, $id)
    {
        $status = $this->brands->update($request, $id);
        return ($status == 1) ? back()->withSuccess('Brand details successfully updated.') : back()->withAlert('Nothing changed!');
    }
}
