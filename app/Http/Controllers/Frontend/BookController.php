<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BookController extends Controller
{
    protected function makeExcerpt($text, $limit = 120)
    {
        $raw = (string) $text;
        $decoded = html_entity_decode($raw, ENT_QUOTES | ENT_HTML5);
        $stripped = strip_tags($decoded);
        $collapsed = trim(preg_replace('/\s+/u', ' ', $stripped));
        return Str::limit($collapsed, $limit);
    }

    protected function resolveImage($img)
    {
        $default = asset('frontand/assets/img/normal/counter-image.jpg');

        if (empty($img)) {
            return $default;
        }

        if (Str::startsWith($img, ['http://', 'https://'])) {
            return $img;
        }

        $candidates = [
            $img,
            'storage/' . ltrim($img, '/'),
            'assets/books/images/' . ltrim($img, '/'),
        ];

        foreach ($candidates as $p) {
            if (file_exists(public_path($p))) {
                return asset($p);
            }
        }

        return $default;
    }

    public function index(Request $request)
    {
        $books = Book::where('status', true)
            ->where(function ($q) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', now());
            })
            ->orderByDesc('published_on')
            ->paginate(8);

        return view('frontend.books.index', compact('books'));
    }

    public function show(Request $request, $slug)
    {
        $now = Carbon::now();

        $book = Book::where('slug', $slug)->where('status', true)->firstOrFail();

        $sessionKey = 'book_viewed_' . $book->id;
        if (! $request->session()->has($sessionKey)) {
            try {
                $book->increment('views');
            } catch (\Throwable $e) {
             }
            $request->session()->put($sessionKey, now()->toDateTimeString());
        }

         $img = $this->resolveImage($book->img ?? null);

         $recentBooksQuery = Book::where('status', true)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->where('id', '!=', $book->id)
            ->orderByDesc('published_on')
            ->take(5);

            $recentBooks = $recentBooksQuery->get()->map(function($b) {
            return (object)[
                'id' => $b->id,
                'title' => $b->title,
                'slug' => $b->slug,
                'img' => $this->resolveImage($b->img ?? null),
                'published_on' => $b->published_on ? Carbon::parse($b->published_on)->format('Y-m-d') : null,
                'excerpt' => $this->makeExcerpt($b->excerpt ?? $b->description ?? '', 120),
                'views' => $b->views ?? 0,
            ];
        });


        return view('frontend.books.show', compact('book', 'img', 'recentBooks'));
    }

    public function download($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();

        if (! $book->file || ! file_exists(public_path('assets/books/files/' . $book->file))) {
            return redirect()->back()->with('error', 'الملف غير متوفر للتحميل');
        }

        $path = public_path('assets/books/files/' . $book->file);
        $name = $book->slug . '.' . pathinfo($path, PATHINFO_EXTENSION);

        return response()->download($path, $name);
    }
}