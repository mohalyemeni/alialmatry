<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BlogFrontendController extends Controller
{
    /**
     * Create a short excerpt from HTML/text safely.
     */
    protected function makeExcerpt($text, $limit = 120)
    {
        $raw = (string) $text;
        $decoded = html_entity_decode($raw, ENT_QUOTES | ENT_HTML5);
        $stripped = strip_tags($decoded);
        $collapsed = trim(preg_replace('/\s+/u', ' ', $stripped));
        return Str::limit($collapsed, $limit);
    }

    /**
     * Resolve image path (public/storage/assets) or return null.
     */
    protected function resolveImage($img)
    {
        if (empty($img)) {
            return null; // لا صورة افتراضية هنا
        }

        // absolute url
        if (Str::startsWith($img, ['http://', 'https://'])) {
            return $img;
        }

        // candidate public paths to check
        $candidates = [
            $img,
            'storage/' . ltrim($img, '/'),
            'assets/blogs/images/' . ltrim($img, '/'),
        ];

        foreach ($candidates as $p) {
            if (file_exists(public_path($p))) {
                return asset($p);
            }
        }

        // لم يتم إيجاد الصورة
        return null;
    }

    public function index(Request $request)
    {
        $now = Carbon::now();

        $featuredCats = Category::query()
            ->where('section', Category::SECTION_ARTICLE)
            ->where('status', true)
            ->where('featured', 1)
            ->whereHas('blogs', function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                  });
            })
            ->withCount(['blogs' => function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', Carbon::now());
                  });
            }])
            ->orderBy('title')
            ->get();

        $nonFeaturedCats = Category::query()
            ->where('section', Category::SECTION_ARTICLE)
            ->where('status', true)
            ->where(function ($q) {
                $q->where('featured', 0)->orWhereNull('featured');
            })
            ->whereHas('blogs', function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                  });
            })
            ->withCount(['blogs' => function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', Carbon::now());
                  });
            }])
            ->orderBy('title')
            ->get();

        $categories = $featuredCats->concat($nonFeaturedCats);

        if ($request->ajax()) {
            $html = view('frontend.blogs.partials.index_partial', compact('categories'))->render();
            return response()->json([
                'html'  => $html,
                'title' => 'المقالات',
                'url'   => route('frontend.blogs.index'),
            ]);
        }

        return view('frontend.blogs.index', compact('categories'));
    }

    public function category(Request $request, Category $category)
    {
        if ($category->section != Category::SECTION_ARTICLE) {
            abort(404);
        }

        $now = Carbon::now();

        $blogs = $category->blogs()
            ->where('status', true)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->orderByDesc('published_on')
            ->paginate(5);

         $blogs->getCollection()->transform(function ($b) {
            $b->img = $this->resolveImage($b->img ?? null);
            $b->excerpt = $this->makeExcerpt($b->excerpt ?? $b->description ?? '', 180);
            return $b;
        });


        $recentBlogs = $category->blogs()
            ->where('status', true)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->orderByDesc('published_on')
            ->take(4)
            ->get()
            ->map(function ($b) {
                $b->img = $this->resolveImage($b->img ?? null);
                $b->excerpt = $this->makeExcerpt($b->excerpt ?? $b->description ?? '', 120);
                return $b;
            });

        if ($request->ajax()) {
            $html = view('frontend.blogs.partials.category_partial', compact('category', 'blogs'))->render();
            return response()->json([
                'html'  => $html,
                'title' => $category->title,
                'url'   => route('frontend.blogs.category', $category->slug),
            ]);
        }

        return view('frontend.blogs.category', compact('category', 'blogs', 'recentBlogs'));
    }

    public function show(Request $request, Blog $blog)
    {
        if (! $blog->category || $blog->category->section != Category::SECTION_ARTICLE) {
            abort(404);
        }

        $sessionKey = 'blog_viewed_' . $blog->id;

        $ua = substr($request->header('User-Agent', ''), 0, 120);
        $visitorHash = sha1($request->ip() . '|' . $ua);
        $cacheKey = "blog_view_{$blog->id}_{$visitorHash}";
        $cacheTtlMinutes = 60;

        if (! $request->session()->has($sessionKey)) {
            if (! Cache::has($cacheKey)) {
                try {
                    $blog->increment('views');
                } catch (\Throwable $e) {
                    // تجاهل مشاكل الزيادة
                }
                Cache::put($cacheKey, true, now()->addMinutes($cacheTtlMinutes));
            }
            $request->session()->put($sessionKey, now()->toDateTimeString());
        }

        $blog->img = $this->resolveImage($blog->img ?? null);
        $blog->excerpt = $this->makeExcerpt($blog->excerpt ?? $blog->description ?? '', 220);

        $now = Carbon::now();
        $limit = 5;

        $recent = Blog::with('category')
            ->where('category_id', $blog->category_id)
            ->where('status', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->where('id', '!=', $blog->id)
            ->orderByDesc('published_on')
            ->take($limit)
            ->get();

        if ($recent->count() < $limit) {
            $needed = $limit - $recent->count();
            $additional = Blog::with('category')
                ->where('status', 1)
                ->where(function ($q) use ($now) {
                    $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                })
                ->where('id', '!=', $blog->id)
                ->orderByDesc('published_on')
                ->take($limit + 8)
                ->get()
                ->reject(function ($item) use ($recent) {
                    return $recent->contains('id', $item->id);
                })
                ->take($needed);

            $recent = $recent->concat($additional)->slice(0, $limit);
        }

        $recentBlogs = $recent->map(function ($b) {
            return (object) [
                'id' => $b->id,
                'title' => $b->title,
                'slug' => $b->slug,
                'img' => $this->resolveImage($b->img ?? null),
                'excerpt' => $this->makeExcerpt($b->excerpt ?? $b->description ?? '', 140),
                'published_on' => $b->published_on ? Carbon::parse($b->published_on) : null,
                'category' => $b->category ?? null,
                'views' => $b->views ?? 0,
            ];
        })->values();

        if ($request->ajax()) {
            $html = view('frontend.blogs.partials.show_partial', compact('blog'))->render();
            return response()->json([
                'html'  => $html,
                'title' => $blog->title,
                'url'   => route('frontend.blogs.show', $blog->slug),
            ]);
        }

        return view('frontend.blogs.show', compact('blog', 'recentBlogs'));
    }
}