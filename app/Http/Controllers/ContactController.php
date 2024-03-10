<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\SendContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller {

    public function index() {
        return view('pages.user.contact');
    }

    public function sendMail(ContactRequest $request) {
        Mail::to('gamerisub@gmail.com')->send(new SendContactMail($request));

        return redirect()
            ->route('home')
            ->with('sentMail', 'Your message has been sent successfully!');
    }

}
