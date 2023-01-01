<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\Recipient;
use App\Notifications\ContactFormMessage;
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

    public function store(ContactFormRequest $message, Recipient $recipient)
    {
//        $this->contact->validate($request);
        $recipient->notify(new ContactFormMessage($message));

        return back()->with(['success' => 'Thanks for your message! We will get back to you soon!']);
    }

//    public function mailContactForm(ContactFormRequest $message, Recipient $recipient)
//    {
//        $recipient->notify(new ContactFormMessage($message));
//
//        return redirect()->back()->with('message', 'Thanks for your message! We will get back to you soon!');
//    }

}
