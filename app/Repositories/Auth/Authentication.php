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
            if (Auth::user()->user_group_id==1){
                $status=1;
            }else{
                $status=2;
            }
        }else{
            $status=0;
        }
        return $status;
    }

    public function show()
    {
        return User::find(ucfirst(Auth()->user()->id));
    }

    public function update($request){
        $request->validate([
            'FullName' => 'required',
            'email' => 'required|email|unique:users,email,'. ucfirst(Auth()->user()->id),
        ]);
        $user = User::find(ucfirst(Auth()->user()->id));
        $request->all();
        $user->FullName = $request->FullName;
        $user->email=$request->email;
        $user->user_group_id = $request->user_group_id;
        $status = $user->isDirty() ? 1 : 0; //0 means nothing changed
        $user->save();
        return $status;
    }

    public function updatePassword($request){
        $request->validate([
            'currentPassword' => [
                'required', function ($attribute,$value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Current Password didn\'t match');
                    }
                },
            ],
            'newPassword' => 'required|string|min:6|different:currentPassword',
            'password_confirmation' => 'required|same:newPassword'
        ]);
        $user = User::find(ucfirst(Auth()->user()->id));
        $user->fill([
        'password' => Hash::make($request->newPassword)
        ])->save();
    }

    public function logout() {
        Session::flush();
        Auth::logout();
    }
}
