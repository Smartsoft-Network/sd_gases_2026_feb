<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ReplyMessageMail;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    public function reply(Request $request, Message $message)
    {
        $validated = $request->validate([
            'reply' => 'required|string',
        ]);

        $message->update([
            'reply' => $validated['reply'],
            'replied_at' => now(),
        ]);

        try {
            // Send reply email to user
            Mail::to($message->email)->send(new ReplyMessageMail($message));
            return back()->with('success', 'Reply sent successfully!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Mail Reply Failed: ' . $e->getMessage());
            return back()->with('error', 'Message replied, but failed to send the email alert. Please check your SMTP settings.');
        }
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully!');
    }
}
