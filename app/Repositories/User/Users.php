<?php

namespace App\Repositories\User;

use App\Models\City;
use App\Models\Province;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Hash;

class Users implements IUsers
{
    function validation($request)
    {
        $request->validate([
            'FullName' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password',
            'user_group_id' => 'required',
            'status' => 'required',
        ],[
            'user_group_id.required' => 'The role field is required.',
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
        $user->status = $data['status'];
        $user->password = Hash::make($data['password']);
        $user->save();
        return $user;
    }

    function showUsers($request)
    {
        $values=User::when($request->has("FullName"),function($q)use($request){
            return $q->where("FullName","like","%".$request->get("FullName")."%");
        })->when($request->has("email"),function($q)use($request){
            return $q->where("email","like","%".$request->get("email")."%");
        })->latest()->paginate(10);

        //for showing data table info
        (isset($_GET['page'])) ? $page=$_GET['page'] : $page=1;
        if($values->total()>0){
            if($page==1){
                $start_num=1;
            }else{
                $start_num=(($page-1)*10)+1;
            }
            if($page*10>=$values->total()){
                $end_num=$values->total();
            }else {
                $end_num = $page * 10;
            }
            $dataTableInfo='Showing '.$start_num.' to '.$end_num. ' of '.$values->total().' entries';
        }
        else $dataTableInfo="";

        $roles=UserGroup::whereStatus('1')->get();

        return [$values,$dataTableInfo,$roles];
    }

    public function editStatus($id,$status)
    {
        User::whereId($id)->update([
            'status' => $status
        ]);
        return True;
    }

    public function delete($id)
    {
        User::find($id)->delete();
        $data = UserAddress::find($id);
        if ($data){
            $data->delete();
        }
        return True;
    }

    public function edit($id)
    {
        $value = User::findOrFail($id);
        $roles=UserGroup::whereStatus('1')->get();
        return [$value,$roles];
    }

    public function update($request,$id)
    {
        $request->validate([
            'FullName' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'user_group_id' => 'required',
            'status' => 'required',
        ],[
            'user_group_id.required' => 'The role field is required.',
        ]);
        $data = User::find($id);
        $request->all();
        $data->FullName = $request->FullName;
        $data->email = $request->email;
        $data->user_group_id = $request->user_group_id;
        $data->status = $request->status;
        $status = $data->isDirty() ? 1 : 0; //0 means nothing changed
        $data->save();
        return $status;
    }

    public function fetchCity($id)
    {
        $cities = City::where(['status'=>'1','province_id'=>$id])->get()->sortBy('title');
        return $cities;
    }

    public function editUserAddress($id){
        $value = UserAddress::firstOrCreate(['user_id' => $id]);
        $provinces = Province::whereStatus('1')->get()->sortBy('title');
        return [$value,$provinces];
    }

    public function updateUserAddress($request,$id){
        $request->validate([
            'zipCode' => 'required',
            'address' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
        ],[
            'province_id.required' => 'The province field is required.',
            'city_id.required' => 'The city field is required.',
        ]);
        $data = UserAddress::find($id);
        $request->all();
        $data->zipCode = $request->zipCode;
        $data->address = $request->address;
        $data->province_id = $request->province_id;
        $data->city_id = $request->city_id;
        $status = $data->isDirty() ? 1 : 0; //0 means nothing changed
        $data->save();
        return $status;
    }

    function login($request)
    {
        // TODO: Implement login() method.
    }

    function show()
    {
        // TODO: Implement show() method.
    }

    function updatePassword($request)
    {
        // TODO: Implement updatePassword() method.
    }

    function logout()
    {
        // TODO: Implement logout() method.
    }
}
