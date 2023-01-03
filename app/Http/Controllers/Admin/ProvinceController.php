<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Province\IProvinces;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    private IProvinces $provinces;

    public function __construct(IProvinces $provinces)
    {
        $this->provinces = $provinces;
    }

    public function index(Request $request)
    {
        $data = $this->provinces->showProvinces($request);
        $values = $data[0];
        $dataTableInfo = $data[1];
        if($request->ajax()){
            return view('admin.pages.provinces.getProvincesData', compact('values','dataTableInfo'));
        }
        return view('admin.pages.provinces.provinces', compact('values','dataTableInfo'));
    }

    public function store(Request $request)
    {
        $this->provinces->validate($request);
        return back()->with(['success' => 'New province successfully added.']);
    }

    public function destroy($id)
    {
        $this->provinces->delete($id);
        return back()->with(['delete' => 'Selected province successfully deleted.']);
    }

    public function editStatus($id, $status)
    {
        $this->provinces->editStatus($id, $status);
        return $id;
    }

    public function edit($id)
    {
        $value = $this->provinces->edit($id);
        return view('admin.pages.provinces.editProvince', compact('value'));
    }

    public function update(Request $request, $id)
    {
        $status = $this->provinces->update($request, $id);
        return ($status == 1) ? back()->withSuccess('Province details successfully updated.') : back()->withAlert('Nothing changed!');
    }

}
