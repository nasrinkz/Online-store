<?php

namespace App\Http\Controllers;

use App\Repositories\User\IUsers;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    private IUsers $authenticationRepo;

    public function __construct(IUsers $authenticationRepo)
    {
        $this->authenticationRepo=$authenticationRepo;
    }

    public function index()
    {
        return view('pages.account');
    }

    public function store(Request $request)
    {
       $this->authenticationRepo->validation($request);
       $groupId=ucfirst(Auth()->user()->user_group_id);
       return ($groupId == 1) ? redirect()->route('AdminDashboard'): redirect()->route('UserDashboard');
    }

    public function show()
    {
        $value=$this->authenticationRepo->show();
        return view('pages.UserAccount.user-dashboard',compact('value'));
    }

    public function login(Request $request)
    {
        $status=$this->authenticationRepo->login($request);
        if ($status==1){
            return redirect()->route('AdminDashboard');
        }elseif ($status==2){
            return redirect()->route('UserDashboard');
        }else{
            return redirect('account')->withSuccess('Invalid login details!');
        }
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

}
