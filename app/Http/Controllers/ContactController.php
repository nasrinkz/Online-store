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
        return back()->with(['success' => 'Your message successfully send.']);
    }

}
