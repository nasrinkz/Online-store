<?php

namespace App\Repositories\ContactUs;

use App\Models\Contact;

class ContactUs implements IContactUs
{
    public function showMessages($request)
    {
        $values=Contact::when($request->has("message"),function($q)use($request){
            return $q->where("message","like","%".$request->get("message")."%");
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

        return [$values,$dataTableInfo];
    }

    public function details($id){
        $value = Contact::findOrFail($id);
        Contact::whereId($id)->update([
            'status' => 'read'
        ]);
        return $value;
    }

    public function validate($request)
    {
        $request->validate([
            'fullName' => 'required',
            'message' => 'required',
            'email' => 'nullable|email|required_without:mobile',
            'mobile' => 'nullable|numeric|required_without:email'
        ]);
        $data = $request->all();
        $this->store($data);
    }

    public function store($request)
    {
        $row = new Contact();
        $row->fullName = $request['fullName'];
        $row->number = $request['mobile'];
        $row->email = $request['email'];
        $row->message = $request['message'];
        $row->save();
        return True;
    }
}
