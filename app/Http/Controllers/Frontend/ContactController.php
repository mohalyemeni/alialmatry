<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{

    public function showForm()
    {
        return view('frontend.contact_us');
    }


    public function sendMessage(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:190',
            'email' => 'required|email',
            'number' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);


        Mail::to("walyed909@gmail.com")
            ->send(new ContactMessage($validated));

        return back()->with('success', 'تم إرسال رسالتك بنجاح، سنتواصل معك قريباً ✅');
    }
}
