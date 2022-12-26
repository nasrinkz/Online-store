<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\City\ICities;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private ICities $cities;

    public function __construct(ICities $cities)
    {
        $this->cities = $cities;
    }

    public function index(Request $request)
    {
        $data = $this->cities->showCities($request);
        $values = $data[0];
        $dataTableInfo = $data[1];
        $provinces = $data[2];
        if($request->ajax()){
            return view('admin.pages.cities.getCitiesData ', compact('values','dataTableInfo','provinces'));
        }
        return view('admin.pages.cities.cities', compact('values','dataTableInfo','provinces'));
    }

    public function store(Request $request)
    {
        $this->cities->validate($request);
        return back()->with(['success' => 'New city successfully added.']);
    }

    public function editStatus($id, $status)
    {
        $this->cities->editStatus($id, $status);
        return $id;
    }

    public function destroy($id)
    {
        $this->cities->delete($id);
        return back()->with(['delete' => 'Selected city successfully deleted.']);
    }

    public function edit($id)
    {
        $data = $this->cities->edit($id);
        $value = $data[0];
        $provinces = $data[1];
        return view('admin.pages.cities.editCity', compact('value','provinces'));
    }

    public function update(Request $request, $id)
    {
        $status = $this->cities->update($request, $id);
        return ($status == 1) ? back()->withSuccess('City details successfully updated.') : back()->withAlert('Nothing changed!');
    }
}
