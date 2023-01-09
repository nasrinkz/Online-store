<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Color\IColors;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    private IColors $colors;

    public function __construct(IColors $colors)
    {
        $this->colors = $colors;
    }

    public function index(Request $request)
    {
        $data = $this->colors->showColors($request);
        $values = $data[0];
        $dataTableInfo = $data[1];
        if($request->ajax()){
            return view('admin.pages.colors.getColorsData', compact('values','dataTableInfo'));
        }
        return view('admin.pages.colors.colors', compact('values','dataTableInfo'));
    }

    public function store(Request $request)
    {
        $this->colors->validate($request);
        return back()->with(['success' => 'New color successfully added.']);
    }

    public function destroy($id)
    {
        $this->colors->delete($id);
        return back()->with(['delete' => 'Selected color successfully deleted.']);
    }

    public function editStatus($id, $status)
    {
        $this->colors->editStatus($id, $status);
        return $id;
    }

    public function edit($id)
    {
        $value = $this->colors->edit($id);
        return view('admin.pages.colors.editColor', compact('value'));
    }

    public function update(Request $request, $id)
    {
        $status = $this->colors->update($request, $id);
        return ($status == 1) ? back()->withSuccess('Color details successfully updated.') : back()->withAlert('Nothing changed!');
    }
}
