<?php
namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Video;
use App\Models\Audio;
use App\Models\Fatwa;
use App\Models\Book;
use App\Models\DurarDiniya;

class SearchController extends Controller
{
  public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return redirect()->back();
        }

       $blogs = Blog::published()->where(function($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%");
        })->limit(6)->get();

        // البحث في الفيديوهات
        $videos = Video::published()->where(function($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%");
        })->limit(6)->get();

        // البحث في المقاطع الصوتية
        $audios = Audio::published()->where(function($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%");
        })->limit(6)->get();

        // البحث في الفتاوى - تصحيح: البحث في حقل 'description' بدلاً من 'question' و 'answer' غير الموجودين
        $fatawas = Fatwa::published()->where(function($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%");
        })->limit(6)->get();

        // البحث في الكتب - تصحيح: إزالة البحث في حقل 'author' غير الموجود
        $books = Book::published()->where(function($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%");
        })->limit(6)->get();

        // البحث في الدرر
        $durars = DurarDiniya::published()->where(function($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%");
        })->limit(6)->get();

        return view('frontend.search-results', compact('query', 'blogs', 'videos', 'audios', 'fatawas', 'books', 'durars'));
    }
}