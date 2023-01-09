<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Size\ISizes;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    private ISizes $sizes;

    public function __construct(ISizes $sizes)
    {
        $this->sizes = $sizes;
    }

    public function index(Request $request)
    {
        $data = $this->sizes->showSizes($request);
        $values = $data[0];
        $dataTableInfo = $data[1];
        if($request->ajax()){
            return view('admin.pages.sizes.getSizesData', compact('values','dataTableInfo'));
        }
        return view('admin.pages.sizes.sizes', compact('values','dataTableInfo'));
    }

    public function store(Request $request)
    {
        $this->sizes->validate($request);
        return back()->with(['success' => 'New size successfully added.']);
    }

    public function destroy($id)
    {
        $this->sizes->delete($id);
        return back()->with(['delete' => 'Selected size successfully deleted.']);
    }

    public function editStatus($id, $status)
    {
        $this->sizes->editStatus($id, $status);
        return $id;
    }

    public function edit($id)
    {
        $value = $this->sizes->edit($id);
        return view('admin.pages.sizes.editSize', compact('value'));
    }

    public function update(Request $request, $id)
    {
        $status = $this->sizes->update($request, $id);
        return ($status == 1) ? back()->withSuccess('Size details successfully updated.') : back()->withAlert('Nothing changed!');
    }
}
