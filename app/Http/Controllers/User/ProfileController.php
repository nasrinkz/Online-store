<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\User\IUsers;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private IUsers $authenticationRepo;

    public function __construct(IUsers $authenticationRepo)
    {
        $this->authenticationRepo=$authenticationRepo;
    }

    public function show()
    {
        $value=$this->authenticationRepo->show();
        return view('pages.UserAccount.user-dashboard',compact('value'));
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
