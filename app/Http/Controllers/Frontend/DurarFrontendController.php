<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DurarDiniya;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DurarFrontendController extends Controller
{

    protected function makeExcerpt($text, $limit = 80)
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
            'assets/durar_diniya/images/' . ltrim($img, '/'),
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
        $now = Carbon::now();

        $query = DurarDiniya::where('status', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->orderByDesc('published_on');

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->keyword.'%')
                  ->orWhere('description', 'like', '%'.$request->keyword.'%');
            });
        }

        $durars = $query->paginate(8);

        return view('frontend.durars.index', compact('durars'));
    }


    public function show(Request $request, $slug)
    {
        $now = Carbon::now();

        $durar = DurarDiniya::where('slug', $slug)->orWhere('id', $slug)->firstOrFail();

         $sessionKey = 'durar_viewed_' . $durar->id;
        if (! $request->session()->has($sessionKey)) {
            try {
                $durar->increment('views');
            } catch (\Throwable $e) {
             }
            $request->session()->put($sessionKey, now()->toDateTimeString());
        }

         $img = $this->resolveImage($durar->img ?? null);

         $recentDurars = DurarDiniya::where('status', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->where('id', '!=', $durar->id)
            ->orderByDesc('published_on')
            ->take(4)
            ->get()
            ->map(function ($d) {
                return (object) [
                    'id' => $d->id,
                    'title' => $d->title,
                    'slug' => $d->slug,
                    'excerpt' => $this->makeExcerpt($d->description ?? '', 80),
                    'img' => $this->resolveImage($d->img ?? null),
                    'published_on' => $d->published_on ? Carbon::parse($d->published_on) : null,
                    'views' => $d->views ?? 0,
                ];
            });

        return view('frontend.durars.show', compact('durar', 'img', 'recentDurars'));
    }
}