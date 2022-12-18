<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Auth\IAuthentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private IAuthentication $registrationRepo;

    public function __construct(IAuthentication $registrationRepo)
    {
        $this->registrationRepo=$registrationRepo;
    }

    public function index()
    {
        return view('pages.account');
    }

    public function store(Request $request)
    {
       $this->registrationRepo->validateRegistration($request);
       $groupId=ucfirst(Auth()->user()->user_group_id);
       return ($groupId == 1) ? view('admin.pages.index'): redirect()->route('UserDashboard');
    }

    public function dashboard()
    {
        return view('pages.UserAccount.user-dashboard');
    }

    public function login(Request $request)
    {
        $status=$this->registrationRepo->login($request);
        return ($status == 1) ? redirect('UserDashboard'): redirect('account')->withSuccess('Invalid login details!');
    }

    public function logout()
    {
        $this->registrationRepo->logout();
        return Redirect('account');
    }

    public function create()
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
