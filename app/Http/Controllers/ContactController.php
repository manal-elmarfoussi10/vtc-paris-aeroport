<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function send(Request $request)
    {
        // TODO: validate
        ContactMessage::create($request->only('name','email','phone','subject','message'));
        return back()->with('success', 'Message envoyé.');
    }
}