<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Repositories\User\IUsers;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    private IUsers $users;

    public function __construct(IUsers $users)
    {
        $this->users=$users;
    }

    public function editUserAddress()
    {
        $userId = auth()->user()->id;
        $data=$this->users->editUserAddress($userId);
        $value = $data[0];
        $provinces = $data[1];
        return view('pages.UserAccount.deliver-info', compact('value','provinces'));
    }

    public function updateUserAddress(Request $request, $id)
    {
        $status = $this->users->updateUserAddress($request, $id);
        return ($status == 1) ? back()->withSuccess('Address details successfully updated.') : back()->withAlert('Nothing changed!');
    }
}
