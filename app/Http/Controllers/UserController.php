<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Auth\IAuthentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private IAuthentication $authenticationRepo;

    public function __construct(IAuthentication $authenticationRepo)
    {
        $this->authenticationRepo=$authenticationRepo;
    }

    public function index()
    {
        return view('pages.account');
    }

    public function store(Request $request)
    {
       $this->authenticationRepo->validateRegistration($request);
       $groupId=ucfirst(Auth()->user()->user_group_id);
       return ($groupId == 1) ? view('admin.pages.index'): redirect()->route('show');
    }

    public function show()
    {
        $value=$this->authenticationRepo->show();
        return view('pages.UserAccount.user-dashboard',compact('value'));
    }

    public function login(Request $request)
    {
        $status=$this->authenticationRepo->login($request);
        return ($status == 1) ? redirect()->route('show') : redirect('account')->withSuccess('Invalid login details!');
    }

    public function logout()
    {
        $this->authenticationRepo->logout();
        return Redirect('account');
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

    public function destroy($id)
    {
        //
    }

    public function create()
    {
        //
    }

    public function edit($id)
    {
        //
    }
}
