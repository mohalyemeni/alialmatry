<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use App\Models\Audio;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AudioFrontendController extends Controller
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
    if (empty($img)) {
        return null;
    }

    if (\Illuminate\Support\Str::startsWith($img, ['http://', 'https://'])) {
        return $img;
    }

    $candidates = [
        'assets/audio_categories/' . ltrim($img, '/'),
        'assets/audios/images/' . ltrim($img, '/'),
        'storage/' . ltrim($img, '/'),
        $img,
    ];

    foreach ($candidates as $p) {
        if (file_exists(public_path($p))) {
            return asset($p);
        }
    }

    return null;
}

    protected function resolveAudioUrl($file)
    {
        if (empty($file)) {
            return null;
        }

        if (Str::startsWith($file, ['http://', 'https://'])) {
            return $file;
        }

        $paths = [
            'assets/audios/files/' . $file,
            'storage/audios/' . $file,
            'storage/app/public/audios/' . $file,
            $file
        ];

        foreach ($paths as $path) {
            if (file_exists(public_path($path))) {
                return asset($path);
            }
        }

        return null;
    }

    public function index(Request $request)
    {
        $now = Carbon::now();

        $featuredCats = Category::query()
            ->where('section', Category::SECTION_AUDIO)
            ->where('status', true)
            ->where('featured', 1)
            ->whereHas('audios', function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                  });
            })
            ->withCount(['audios' => function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', Carbon::now());
                  });
            }])
            ->orderBy('title')
            ->get();

        $nonFeaturedCats = Category::query()
            ->where('section', Category::SECTION_AUDIO)
            ->where('status', true)
            ->where(function ($q) {
                $q->where('featured', 0)->orWhereNull('featured');
            })
            ->whereHas('audios', function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                  });
            })
            ->withCount(['audios' => function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', Carbon::now());
                  });
            }])
            ->orderBy('title')
            ->get();

        $categories = $featuredCats->concat($nonFeaturedCats);

         $categories = $categories->map(function ($cat) use ($now) {
            $latest = $cat->audios()
                ->where('status', 1)
                ->where(function ($q) use ($now) {
                    $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                })
                ->orderByDesc('published_on')
                ->take(5)
                ->get()
                ->map(function ($a) {
                     $a->img = $this->resolveImage($a->img ?? null);
                    $a->audio_url = $this->resolveAudioUrl($a->audio_file ?? null);
                    $a->excerpt = $this->makeExcerpt($a->excerpt ?? $a->description ?? '', 140);
                    return $a;
                });

            $cat->setRelation('audios', $latest);
            return $cat;
        });

        if ($request->ajax()) {
            $html = view('frontend.audio_partials.index_partial', compact('categories'))->render();
            return response()->json([
                'html'  => $html,
                'title' => 'الصوتيات',
                'url'   => route('frontend.audios.index'),
            ]);
        }

        return view('frontend.audios.index', compact('categories'));
    }

    public function category(Request $request, Category $category)
    {
        if ($category->section != Category::SECTION_AUDIO) {
            abort(404);
        }

        $now = Carbon::now();

        $audios = $category->audios()
            ->where('status', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->orderByDesc('published_on')
            ->paginate(10);

         $audios->getCollection()->transform(function ($a) {
            $a->img = $this->resolveImage($a->img ?? null);
            $a->audio_url = $this->resolveAudioUrl($a->audio_file ?? null);
            $a->excerpt = $this->makeExcerpt($a->excerpt ?? $a->description ?? '', 160);
            return $a;
        });

        if ($request->ajax()) {
            $html = view('frontend.audio_partials.category_partial', compact('category', 'audios'))->render();
            return response()->json([
                'html'  => $html,
                'title' => $category->title,
                'url'   => route('frontend.audios.category', $category->slug),
            ]);
        }

        return view('frontend.audios.category', compact('category', 'audios'));
    }



    public function show(Request $request, Audio $audio)
    {
        if (! $audio->category || $audio->category->section != Category::SECTION_AUDIO) {
            abort(404);
        }

         $sessionKey = 'audio_viewed_' . $audio->id;

         $ua = substr($request->header('User-Agent', ''), 0, 120);
        $visitorHash = sha1($request->ip() . '|' . $ua);
        $cacheKey = "audio_view_{$audio->id}_{$visitorHash}";
        $cacheTtlMinutes = 60;


        if (! $request->session()->has($sessionKey)) {
            if (! Cache::has($cacheKey)) {
                try {
                    $audio->increment('views');
                } catch (\Throwable $e) {
                 }
                 Cache::put($cacheKey, true, now()->addMinutes($cacheTtlMinutes));
            }

            $request->session()->put($sessionKey, now()->toDateTimeString());
        }

         $audio->img = $this->resolveImage($audio->img ?? null);
        $audio->audio_url = $this->resolveAudioUrl($audio->audio_file ?? null);
        $audio->excerpt = $this->makeExcerpt($audio->excerpt ?? $audio->description ?? '', 220);

        $now = Carbon::now();
        $limit = 5;

        $recent = Audio::where('category_id', $audio->category_id)
            ->where('status', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->where('id', '!=', $audio->id)
            ->orderByDesc('published_on')
            ->take($limit)
            ->get();

        if ($recent->count() < $limit) {
            $needed = $limit - $recent->count();
            $additional = Audio::where('status', 1)
                ->where(function ($q) use ($now) {
                    $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                })
                ->where('id', '!=', $audio->id)
                ->orderByDesc('published_on')
                ->take($limit + 8)
                ->get()
                ->reject(function ($item) use ($recent) {
                    return $recent->contains('id', $item->id);
                })
                ->take($needed);

            $recent = $recent->concat($additional)->slice(0, $limit);
        }

        $recentAudios = $recent->map(function ($a) {
            return (object) [
                'id' => $a->id,
                'title' => $a->title,
                'slug' => $a->slug,
                'img' => $this->resolveImage($a->img ?? null),
                'audio_url' => $this->resolveAudioUrl($a->audio_file ?? null),
                'published_on' => $a->published_on ? Carbon::parse($a->published_on)->format('Y-m-d') : null,
                'views' => $a->views ?? 0,
                'category' => $a->category ?? null,
            ];
        })->values();

        if ($request->ajax()) {
            $html = view('frontend.audio_partials.show_partial', compact('audio'))->render();
            return response()->json([
                'html'  => $html,
                'title' => $audio->title,
                'url'   => route('frontend.audios.show', $audio->slug),
            ]);
        }

        return view('frontend.audios.show', compact('audio', 'recentAudios'));
    }

    public function download(Audio $audio)
    {
        $filePath = public_path('assets/audios/files/' . $audio->audio_file);
        if (! file_exists($filePath)) {
            abort(404);
        }
        return response()->download($filePath, $audio->audio_file);
    }
}