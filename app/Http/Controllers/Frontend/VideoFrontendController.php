<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class VideoFrontendController extends Controller
{
    protected function resolveThumbnail($thumb)
    {
        if (empty($thumb)) {
            return null;
        }

        // إذا كان الرابط يحتوي على http أو https، نرجعه كما هو
        if (Str::startsWith($thumb, ['http://', 'https://'])) {
            return $thumb;
        }

        $thumb = ltrim($thumb, '/');

        // نتحقق من وجود الملف في المسار العام
        if (file_exists(public_path($thumb))) {
            return asset($thumb);
        }

        // إذا كان الملف موجود في مجلد assets/video_categories
        $pathInAssets = 'assets/video_categories/' . basename($thumb);
        if (file_exists(public_path($pathInAssets))) {
            return asset($pathInAssets);
        }

        // إذا كان الملف موجود في التخزين
        if (Storage::disk('public')->exists($thumb)) {
            return Storage::disk('public')->url($thumb);
        }

        return null;
    }


    public function index(Request $request)
    {
        $now = Carbon::now();

        try {
            $featuredCats = Category::query()
                ->where('section', Category::SECTION_VIDEO)
                ->where('status', true)
                ->where('featured', 1)
                ->whereHas('videos', function ($q) use ($now) {
                    $q->where('status', 1)
                    ->where(function ($q2) use ($now) {
                        $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                    });
                })
                ->withCount(['videos' => function ($q) use ($now) {
                    $q->where('status', 1)
                    ->where(function ($q2) use ($now) {
                        $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                    });
                }])
                ->orderByDesc('id')
                ->get();

            $nonFeaturedCats = Category::query()
                ->where('section', Category::SECTION_VIDEO)
                ->where('status', true)
                ->where(function ($q) {
                    $q->where('featured', 0)->orWhereNull('featured');
                })
                ->whereHas('videos', function ($q) use ($now) {
                    $q->where('status', 1)
                    ->where(function ($q2) use ($now) {
                        $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                    });
                })
                ->withCount(['videos' => function ($q) use ($now) {
                    $q->where('status', 1)
                    ->where(function ($q2) use ($now) {
                        $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                    });
                }])
                ->orderByDesc('id')
                ->get();

            $categories = $featuredCats->concat($nonFeaturedCats);

            if ($request->ajax()) {
                $html = view('frontend.videos.partials.index_partial', compact('categories'))->render();
                return response()->json([
                    'html'  => $html,
                    'title' => 'المرئيات',
                    'url'   => route('frontend.videos.index'),
                ]);
            }

            return view('frontend.videos.index', compact('categories'));
        } catch (\Exception $e) {

            \Log::error('Error in VideoFrontendController@index: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json(['error' => 'حدث خطأ ما'], 500);
            }

            return redirect()->route('frontend.index')->with('error', 'حدث خطأ ما، يرجى المحاولة لاحقاً');
        }
    }

    public function category(Request $request, Category $category)
    {
        if ($category->section != Category::SECTION_VIDEO) {
            abort(404);
        }

        $now = Carbon::now();

        $videos = $category->videos()
            ->where('status', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->orderByDesc('published_on')
            ->paginate(8);

        $videos->getCollection()->transform(function ($v) {
            $thumb = $v->thumbnail ?? null;
            $v->thumbnail = $this->resolveThumbnail($thumb);
            return $v;
        });

        if ($request->ajax()) {
            $html = view('frontend.videos.partials.category_partial', compact('category', 'videos'))->render();
            return response()->json([
                'html'  => $html,
                'title' => $category->title,
                'url'   => route('frontend.videos.category', $category->slug),
            ]);
        }

        return view('frontend.videos.category', compact('category', 'videos'));
    }

    public function show(Request $request, Video $video)
    {

        if (! $video->category || $video->category->section != Category::SECTION_VIDEO) {
            abort(404);
        }

        $sessionKey = 'video_viewed_' . $video->id;
        if (! $request->session()->has($sessionKey)) {
            try {
                $video->increment('views');
            } catch (\Throwable $e) {
            }
            $request->session()->put($sessionKey, now()->toDateTimeString());
        }

        $now = Carbon::now();
        $limit = 5;

         $recent = Video::with('category')->where('category_id', $video->category_id)
            ->where('status', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->where('id', '!=', $video->id)
            ->orderByDesc('published_on')
            ->take($limit)
            ->get();

        if ($recent->count() < $limit) {
            $needed = $limit - $recent->count();
            $additional = Video::with('category')->where('status', 1)
                ->where(function ($q) use ($now) {
                    $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                })
                ->where('id', '!=', $video->id)
                ->orderByDesc('published_on')
                ->take($limit + 5)
                ->get()
                ->reject(function ($item) use ($recent) {
                    return $recent->contains('id', $item->id);
                })
                ->take($needed);

            $recent = $recent->concat($additional)->slice(0, $limit);
        }

        $recentVideos = $recent->map(function ($v) {
            $thumb = $v->thumbnail ?? null;
            $thumbnailSrc = $this->resolveThumbnail($thumb);

            $catInfo = null;
            if (!empty($v->category)) {
                $catInfo = (object) [
                    'title' => $v->category->title ?? ($v->category->name ?? null),
                    'slug'  => $v->category->slug ?? $v->category->id ?? null,
                ];
            }

            return (object) [
                'id' => $v->id,
                'title' => $v->title,
                'slug' => $v->slug,
                'youtube_id' => $v->youtube_id,
                'thumbnail' => $thumbnailSrc,
                'published_on' => $v->published_on ? Carbon::parse($v->published_on)->format('Y-m-d') : null,
                'views' => $v->views ?? 0,
                'category' => $catInfo,
            ];
        });

        if (isset($video->thumbnail)) {
            $video->thumbnail = $this->resolveThumbnail($video->thumbnail);
        }

        return view('frontend.videos.show', compact('video', 'recentVideos'));
    }
}