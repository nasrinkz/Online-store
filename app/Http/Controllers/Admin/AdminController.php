<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\IUsers;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private IUsers $authenticationRepo;

    public function __construct(IUsers $authenticationRepo)
    {
        $this->authenticationRepo=$authenticationRepo;
    }

    public function index()
    {
        $data=$this->authenticationRepo->adminIndex();
        $ordersCount=$data[0];
        $usersCount=$data[1];
        $productsCount=$data[2];
        $brandsCount=$data[3];
        return view('admin.pages.index',compact('ordersCount','usersCount','productsCount','brandsCount'));
    }

    public function show()
    {
        $value=$this->authenticationRepo->show();
        return view('admin.pages.profile',compact('value'));
    }

    public function update(Request $request)
    {
        $status=$this->authenticationRepo->update($request);
        return ($status == 1) ? back()->withSuccess('Your information successfully updated.') : back()->withAlert('Nothing changed!');
    }

    public function updatePassword(Request $request)
    {
        $this->authenticationRepo->updatePassword($request);
        return back()->withSuccess('Your password successfully updated.');
    }
}
