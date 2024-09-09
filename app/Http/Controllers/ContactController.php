<?php

namespace App\Http\Controllers;

use App\Mail\OpinionMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendEmail(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
            'message' => 'required',
        ]);
    
        Mail::raw($validated['message'], function($message) use ($validated) {
            $message->to('pshamugia@gmail.com')
                    ->subject('New message from ' . $validated['email']);
        });
    
        return back()->with('success', 'Your message has been sent successfully!');
    }
    

}
