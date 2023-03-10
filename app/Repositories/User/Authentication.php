<?php

namespace App\Repositories\User;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class Authentication implements IUsers
{

    function validation($request)
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
        Cart::where(['userIP'=>\Request::getClientIp(true),'user_id'=>null])->update([
            'user_id' => Auth::user()->id
        ]);
        return $user;
    }

    public function login($request)
    {
        $request->validate([
            'loginEmail' => 'required|email',
            'loginPassword' => 'required',
        ], [
            'loginEmail.required' => 'The email field is required.',
            'loginPassword.required' => 'The password field is required.',
            'loginEmail.email' => 'The email field must be email address.',
        ]);
//        $credentials = $req->only('username', 'password');
        if (Auth::attempt(['email' => $request->loginEmail, 'password' => $request->loginPassword],$request->remember)) {
            Cart::where(['userIP'=>\Request::getClientIp(true),'user_id'=>null])->update([
                'user_id' => Auth::user()->id
            ]);
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

    public function update($request,$id=null){
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

    public function adminIndex()
    {
        $ordersCount = Order::whereStatus('1')->count();
        $usersCount = User::whereStatus('1')->count();
        $productsCount = Product::whereStatus('1')->count();
        $brandsCount = Brand::whereStatus('1')->count();
        return [$ordersCount,$usersCount,$productsCount,$brandsCount];
    }
}
