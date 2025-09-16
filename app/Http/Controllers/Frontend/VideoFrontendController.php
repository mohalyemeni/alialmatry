<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Str;

class VideoFrontendController extends Controller
{
protected function resolveThumbnail($thumb)
{
    if (empty($thumb)) {
        return null;
    }

    $thumb = ltrim($thumb, '/');

    $path = 'assets/video_categories/' . basename($thumb);

    if (file_exists(public_path($path))) {
        return asset($path);
    }

    return null;
}


    public function index(Request $request)
    {
        $now = Carbon::now();

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
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', Carbon::now());
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
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', Carbon::now());
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