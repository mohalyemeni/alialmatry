<?php

namespace App\Http\Controllers\Frontend;


use App\Models\SheikhIntro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SheikhIntroController extends Controller
{
 public function index(Request $request)
    {

        $sheikhIntro = SheikhIntro::where('status', true)->latest('published_on')->first();


        if ($sheikhIntro) {
            $sessionKey = 'sheikh_intro_viewed_' . $sheikhIntro->id;
            if (! $request->session()->has($sessionKey)) {
                $sheikhIntro->increment('views');
                $request->session()->put($sessionKey, now()->toDateTimeString());
            }
        }

        return view('frontend.sheikh_intro.index', compact('sheikhIntro'));
    }
}