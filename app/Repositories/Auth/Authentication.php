<?php

namespace App\Repositories\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class Authentication implements IAuthentication
{

    function validateRegistration($request)
    {
        $request->validate([
            'FullName' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password'
        ]);
        $data = $request->all();
        $this->create($data);
    }

    public function create(array $data)
    {
        $user = new User();
        $user->FullName =  $data['FullName'];
        $user->email = $data['email'];
        $user->user_group_id = $data['user_group_id'];
        $user->password = Hash::make($data['password']);
        $user->save();
        Auth::login($user);
        return $user;
    }

    public function login($request)
    {
        $request->validate([
            'loginEmail' => 'required|email',
            'loginPassword' => 'required',
        ], [
            'loginEmail.required' => 'Email field is required.',
            'loginPassword.required' => 'Password field is required.',
            'loginEmail.email' => 'Email field must be email address.',
        ]);
//        $credentials = $req->only('username', 'password');
        if (Auth::attempt(['email' => $request->loginEmail, 'password' => $request->loginPassword],$request->remember)) {
            $status=1;
        }else{
            $status=0;
        }
        return $status;
    }

    public function logout() {
        Session::flush();
        Auth::logout();
    }
}
