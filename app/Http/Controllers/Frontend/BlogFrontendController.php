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
     * Resolve an image path for a blog item.
     * Tries multiple common locations and falls back to a default placeholder.
     */
    protected function resolveImage($img)
    {
        $default = asset('frontand/assets/img/normal/counter-image.jpg');

        if (empty($img)) {
            return $default;
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

        // fallback
        return $default;
    }

    /**
     * Index: list article categories (prefer featured categories first).
     */
    public function index(Request $request)
    {
        $now = Carbon::now();

        // featured categories that have published blogs
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

        // non-featured categories that have published blogs
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

        // merge featured first
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

    /**
     * Show blogs in a category (paginated).
     */
    public function category(Request $request, Category $category)
    {
        if ($category->section !== Category::SECTION_ARTICLE) {
            abort(404);
        }

        $now = Carbon::now();

        $blogs = $category->blogs()
            ->where('status', true)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->orderByDesc('published_on')
            ->paginate(10);

        // normalize image urls and excerpt for display
        $blogs->getCollection()->transform(function ($b) {
            $b->img = $this->resolveImage($b->img ?? null);
            $b->excerpt = $this->makeExcerpt($b->excerpt ?? $b->description ?? '', 180);
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

        return view('frontend.blogs.category', compact('category', 'blogs'));
    }

    /**
     * Show single blog, increment views once per session and with short cache protection, then prepare recent posts.
     */
    public function show(Request $request, Blog $blog)
    {
        if (! $blog->category || $blog->category->section !== Category::SECTION_ARTICLE) {
            abort(404);
        }

        // Session key (prevents multiple increments within same session)
        $sessionKey = 'blog_viewed_' . $blog->id;

        // Cache key per visitor (IP + partial User-Agent) to prevent repeated increments across sessions
        $ua = substr($request->header('User-Agent', ''), 0, 120);
        $visitorHash = sha1($request->ip() . '|' . $ua);
        $cacheKey = "blog_view_{$blog->id}_{$visitorHash}";
        $cacheTtlMinutes = 60; // نافذة الحماية بالـدقائق (قابلة للتعديل)

        // Logic:
        // - If neither session nor cache exists: increment, set both.
        // - If session missing but cache exists: set session (don't increment).
        // - If session exists: do nothing.
        if (! $request->session()->has($sessionKey)) {
            if (! Cache::has($cacheKey)) {
                try {
                    $blog->increment('views');
                } catch (\Throwable $e) {
                    // ignore increment errors
                }
                // set cache entry to block further increments from same visitor for a while
                Cache::put($cacheKey, true, now()->addMinutes($cacheTtlMinutes));
            }
            // always set session key so within same session we won't increment again
            $request->session()->put($sessionKey, now()->toDateTimeString());
        }

        // ensure main blog image/excerpt are ready for view
        $blog->img = $this->resolveImage($blog->img ?? null);
        $blog->excerpt = $this->makeExcerpt($blog->excerpt ?? $blog->description ?? '', 220);

        $now = Carbon::now();
        $limit = 5;

        // recent from same category (exclude current) - eager load category
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

        // fill globally if needed (exclude current and already collected) - eager load category
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

        // map recent posts for view consumption — keep published_on as Carbon so blade can format it
        $recentBlogs = $recent->map(function ($b) {
            return (object) [
                'id' => $b->id,
                'title' => $b->title,
                'slug' => $b->slug,
                'img' => $this->resolveImage($b->img ?? null),
                'excerpt' => $this->makeExcerpt($b->excerpt ?? $b->description ?? '', 140),
                'published_on' => $b->published_on ? Carbon::parse($b->published_on) : null, // Carbon instance
                'category' => $b->category ?? null, // keep the relation (model) for blade usage
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