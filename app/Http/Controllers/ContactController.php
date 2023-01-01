<?php

namespace App\Http\Controllers;

use App\Repositories\ContactUs\IContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private IContactUs $contact;

    public function __construct(IContactUs $contact)
    {
        $this->contact = $contact;
    }

    public function index()
    {
        return view('pages.contact-us');
    }

    public function store(Request $request){
        $this->contact->validate($request);
        return back()->with(['success' => 'Thanks for your message! We will get back to you soon!']);
    }

}
