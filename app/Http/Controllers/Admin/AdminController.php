<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Auth\IAuthentication;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private IAuthentication $authenticationRepo;

    public function __construct(IAuthentication $authenticationRepo)
    {
        $this->authenticationRepo=$authenticationRepo;
    }

    public function index()
    {
        return view('admin.pages.index');
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
