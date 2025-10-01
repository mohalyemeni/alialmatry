<?php

namespace App\Http\Controllers;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function welcomeEmail()
    {
        $data = [
            'name' => 'وليد',
            'message' => 'هذا اختبار إرسال إيميل شخصي '
        ];

        Mail::to('walyed909@gmail.com')->send(new TestMail($data));

        return "تم إرسال البريد (تحقق من Inbox أو Spam)";
    }
}
