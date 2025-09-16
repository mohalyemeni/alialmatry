<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Page;
use App\Models\User;
use App\Notifications\NewCommentForAdminNotify;
use App\Notifications\NewCommentForPostOwnerNotify;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;
 class IndexController extends Controller
{
    public function index()
    {

        return view('frontend.index');
    }


}