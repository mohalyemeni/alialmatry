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

        // نستخدم paginate بدل limit لسهولة العرض مع روابط الصفحات
        $blogs = Blog::published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->paginate(6, ['*'], 'blogs_page');

        $videos = Video::published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->paginate(6, ['*'], 'videos_page');

        $audios = Audio::published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->paginate(6, ['*'], 'audios_page');

        $fatawas = Fatwa::published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->paginate(6, ['*'], 'fatawas_page');

        $books = Book::published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->paginate(6, ['*'], 'books_page');

        $durars = DurarDiniya::published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->paginate(6, ['*'], 'durars_page');

        return view('frontend.search-results', compact(
            'query',
            'blogs',
            'videos',
            'audios',
            'fatawas',
            'books',
            'durars'
        ));
    }
}