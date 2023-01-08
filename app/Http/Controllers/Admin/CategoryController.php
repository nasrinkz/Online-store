<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Category\ICategories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private ICategories $categories;

    public function __construct(ICategories $categories)
    {
        $this->categories = $categories;
    }

    public function index(Request $request)
    {
        $data = $this->categories->showCategories($request);
        $values = $data[0];
        $dataTableInfo = $data[1];
        if($request->ajax()){
            return view('admin.pages.categories.getCategoriesData', compact('values','dataTableInfo'));
        }
        return view('admin.pages.categories.categories', compact('values','dataTableInfo'));
    }

    public function store(Request $request)
    {
        $this->categories->validate($request);
        return back()->with(['success' => 'New category successfully added.']);
    }

    public function destroy($id)
    {
        $this->categories->delete($id);
        return back()->with(['delete' => 'Selected category successfully deleted.']);
    }

    public function editStatus($id, $status)
    {
        $this->categories->editStatus($id, $status);
        return $id;
    }

    public function edit($id)
    {
        $value = $this->categories->edit($id);
        return view('admin.pages.categories.editCategory', compact('value'));
    }

    public function update(Request $request, $id)
    {
        $status = $this->categories->update($request, $id);
        return ($status == 1) ? back()->withSuccess('Category details successfully updated.') : back()->withAlert('Nothing changed!');
    }
}
