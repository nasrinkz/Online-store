<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\IUsers;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private IUsers $users;

    public function __construct(IUsers $users)
    {
        $this->users=$users;
    }

    public function index(Request $request)
    {
        $data=$this->users->showUsers($request);
        $values = $data[0];
        $dataTableInfo = $data[1];
        $roles = $data[2];
        if($request->ajax()){
            return view('admin.pages.users.getUsersData', compact('values','dataTableInfo','roles'));
        }
        return view('admin.pages.users.users', compact('values','dataTableInfo','roles'));
    }

    public function store(Request $request)
    {
        $this->users->validation($request);
        return back()->with(['success' => 'New user successfully added.']);
    }

    public function editStatus($id, $status)
    {
        $this->users->editStatus($id, $status);
        return $id;
    }

    public function destroy($id)
    {
        $this->users->delete($id);
        return back()->with(['delete' => 'Selected user successfully deleted.']);
    }

    public function edit($id)
    {
        $data = $this->users->edit($id);
        $value = $data[0];
        $roles = $data[1];
        return view('admin.pages.users.editUser', compact('value','roles'));
    }

    public function update(Request $request, $id)
    {
        $status = $this->users->update($request, $id);
        return ($status == 1) ? back()->withSuccess('User details successfully updated.') : back()->withAlert('Nothing changed!');
    }

    public function fetchCity($id)
    {
        $cities=$this->users->fetchCity($id);
        return response()->json($cities);
    }

    public function editUserAddress($userId)
    {
        $data=$this->users->editUserAddress($userId);
        $value = $data[0];
        $provinces = $data[1];
        return view('admin.pages.users.editAddress', compact('value','provinces'));
    }

    public function updateUserAddress(Request $request, $id)
    {
        $status = $this->users->updateUserAddress($request, $id);
        return ($status == 1) ? back()->withSuccess('Address details successfully updated.') : back()->withAlert('Nothing changed!');
    }
}
