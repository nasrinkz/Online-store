<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ContactUs\IContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    private IContactUs $contact;

    public function __construct(IContactUs $contact)
    {
        $this->contact = $contact;
    }

    public function index(Request $request)
    {
        $data = $this->contact->showMessages($request);
        $values = $data[0];
        $dataTableInfo = $data[1];
        if($request->ajax()){
            return view('admin.pages.messages.getMessagesData ', compact('values','dataTableInfo'));
        }
        return view('admin.pages.messages.messages', compact('values','dataTableInfo'));
    }

    public function details($id)
    {
        $value = $this->contact->details($id);
        return view('admin.pages.messages.messageDetails', compact('value'));
    }
}
