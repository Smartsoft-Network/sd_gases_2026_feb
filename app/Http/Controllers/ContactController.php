<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $message = Message::create($validated);

        try {
            // Send email to admin
            Mail::to(config('mail.from.address'))->send(new ContactMessageMail($message));
            return back()->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            // Log the error if needed
            Log::error('Mail Sending Failed: ' . $e->getMessage());
            return back()->with('error', 'Sorry, there was an error sending your message. Please try again later.');
        }
    }
}
