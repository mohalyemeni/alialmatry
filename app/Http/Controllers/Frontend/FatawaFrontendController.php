<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Fatwa;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FatawaFrontendController extends Controller
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
            'assets/fatawa/images/' . ltrim($img, '/'),
        ];

        foreach ($candidates as $p) {
            if (file_exists(public_path($p))) {
                return asset($p);
            }
        }

        return $default;
    }

    protected function resolveFile($file)
    {
        if (empty($file)) {
            return null;
        }

        if (Str::startsWith($file, ['http://', 'https://'])) {
            return $file;
        }

        $candidates = [
            'assets/fatawa/files/' . ltrim($file, '/'),
            'storage/' . ltrim($file, '/'),
            $file,
        ];

        foreach ($candidates as $p) {
            if (file_exists(public_path($p))) {
                return asset($p);
            }
        }

        return file_exists(public_path($file)) ? asset($file) : null;
    }

    public function index(Request $request)
    {
        $now = Carbon::now();

        $featuredCats = Category::query()
            ->where('section', Category::SECTION_FATWA)
            ->where('status', true)
            ->where('featured', 1)
            ->whereHas('fatawas', function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                  });
            })
            ->withCount(['fatawas' => function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', Carbon::now());
                  });
            }])
            ->orderBy('title')
            ->get();

        $nonFeaturedCats = Category::query()
            ->where('section', Category::SECTION_FATWA)
            ->where('status', true)
            ->where(function ($q) {
                $q->where('featured', 0)->orWhereNull('featured');
            })
            ->whereHas('fatawas', function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                  });
            })
            ->withCount(['fatawas' => function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', Carbon::now());
                  });
            }])
            ->orderBy('title')
            ->get();

        $categories = $featuredCats->concat($nonFeaturedCats);

        // Eager-load latest 5 fatawas for each category (respect published/status)
        $categories = $categories->map(function ($cat) use ($now) {
            $latest = $cat->fatawas()
                ->where('status', 1)
                ->where(function ($q) use ($now) {
                    $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                })
                ->orderByDesc('published_on')
                ->take(5)
                ->get()
                ->map(function ($f) {
                    // use setAttribute to avoid Intelephense warnings / readonly properties issues
                    $f->setAttribute('img', $this->resolveImage($f->img ?? null));
                    $f->setAttribute('file_url', $this->resolveFile($f->audio_file ?? $f->file ?? null));
                    $f->setAttribute('excerpt', $this->makeExcerpt($f->excerpt ?? $f->description ?? '', 140));
                    return $f;
                });

            $cat->setRelation('fatawas', $latest);
            return $cat;
        });

        if ($request->ajax()) {
            $html = view('frontend.fatawas.partials.index_partial', compact('categories'))->render();
            return response()->json([
                'html'  => $html,
                'title' => 'الفتاوى',
                'url'   => route('frontend.fatawas.index'),
            ]);
        }

        return view('frontend.fatawas.index', compact('categories'));
    }

    public function category(Request $request, Category $category)
    {
        if ($category->section != Category::SECTION_FATWA) {
            abort(404);
        }

        $now = Carbon::now();

        $fatawas = $category->fatawas()
            ->where('status', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->orderByDesc('published_on')
            ->paginate(10);

        // normalize fields for blade (use setAttribute)
        $fatawas->getCollection()->transform(function ($f) {
            $f->setAttribute('img', $this->resolveImage($f->img ?? null));
            $f->setAttribute('file_url', $this->resolveFile($f->audio_file ?? $f->file ?? null));
            $f->setAttribute('excerpt', $this->makeExcerpt($f->excerpt ?? $f->description ?? '', 160));
            return $f;
        });

        if ($request->ajax()) {
            $html = view('frontend.fatawas.partials.category_partial', compact('category', 'fatawas'))->render();
            return response()->json([
                'html'  => $html,
                'title' => $category->title,
                'url'   => route('frontend.fatawas.category', $category->slug),
            ]);
        }

        return view('frontend.fatawas.category', compact('category', 'fatawas'));
    }

    public function show(Request $request, Fatwa $fatawa)
    {
        if (! $fatawa->category || $fatawa->category->section != Category::SECTION_FATWA) {
            abort(404);
        }

        $sessionKey = 'fatawa_viewed_' . $fatawa->id;
        if (! $request->session()->has($sessionKey)) {
            try {
                $fatawa->increment('views');
            } catch (\Throwable $e) {
                // ignore increment error
            }
            $request->session()->put($sessionKey, now()->toDateTimeString());
        }

        // normalize main fatawa fields (use setAttribute)
        $fatawa->setAttribute('img', $this->resolveImage($fatawa->img ?? null));
        $fatawa->setAttribute('file_url', $this->resolveFile($fatawa->audio_file ?? $fatawa->file ?? null));
        $excerpt = $this->makeExcerpt($fatawa->excerpt ?? $fatawa->description ?? '', 220);

        $now = Carbon::now();
        $limit = 5;

        // recent from same category (exclude current)
        $recent = Fatwa::where('category_id', $fatawa->category_id)
            ->where('status', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->where('id', '!=', $fatawa->id)
            ->orderByDesc('published_on')
            ->take($limit)
            ->get();

        if ($recent->count() < $limit) {
            $needed = $limit - $recent->count();
            $additional = Fatwa::where('status', 1)
                ->where(function ($q) use ($now) {
                    $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                })
                ->where('id', '!=', $fatawa->id)
                ->orderByDesc('published_on')
                ->take($limit + 8)
                ->get()
                ->reject(function ($item) use ($recent) {
                    return $recent->contains('id', $item->id);
                })
                ->take($needed);

            $recent = $recent->concat($additional)->slice(0, $limit);
        }

        $recentFatawas = $recent->map(function ($f) {
            return (object) [
                'id' => $f->id,
                'title' => $f->title,
                'slug' => $f->slug,
                'img' => $this->resolveImage($f->img ?? null),
                'file_url' => $this->resolveFile($f->audio_file ?? $f->file ?? null),
                'published_on' => $f->published_on ? Carbon::parse($f->published_on)->format('Y-m-d') : null,
                'views' => $f->views ?? 0,
                'category' => $f->category ?? null,
            ];
        })->values();

        if ($request->ajax()) {
            $html = view('frontend.fatawas.partials.show_partial', compact('fatawa'))->render();
            return response()->json([
                'html'  => $html,
                'title' => $fatawa->title,
                'url'   => route('frontend.fatawas.show', $fatawa->slug),
            ]);
        }

        return view('frontend.fatawas.show', compact('fatawa', 'excerpt', 'recentFatawas'));
    }

    public function download(Fatwa $fatawa)
    {
        $file = $fatawa->audio_file ?? $fatawa->file ?? null;
        if (! $file) {
            abort(404);
        }
        $filePath = public_path('assets/fatawa/files/' . $file);
        if (! file_exists($filePath)) {
            abort(404);
        }
        return response()->download($filePath, $file);
    }
}