<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\SheikhIntro;
use App\Models\Video;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Book;
use App\Models\DurarDiniya;
use App\Models\Fatwa;
use App\Models\Audio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    protected function makeExcerpt($text, $limit = 120)
    {
        $raw = (string) $text;
        $decoded = html_entity_decode($raw, ENT_QUOTES | ENT_HTML5);
        $stripped = strip_tags($decoded);
        $collapsed = trim(preg_replace('/\s+/u', ' ', $stripped));
        return Str::limit($collapsed, $limit);
    }

    public function index(Request $request)
    {
        $locale = 'ar';
        $now = Carbon::now();

        // ----------------------------
        // sliders
        // ----------------------------
        $sliders = Slider::mainSliders()
            ->where('status', true)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->orderByDesc('published_on')
            ->take(6)
            ->get()
            ->map(function ($s) use ($locale) {
                $get = function ($val) use ($locale) {
                    if (is_array($val)) {
                        return $val[$locale] ?? ($val['ar'] ?? reset($val) ?? null);
                    }
                    return $val;
                };
                return (object) [
                    'id' => $s->id,
                    'title' => $get($s->title),
                    'description' => $get($s->description),
                    'btn_title' => $get($s->btn_title),
                    'url' => $get($s->url),
                    'img' => ($s->img && file_exists(public_path('assets/main_sliders/' . $s->img)))
                        ? asset('assets/main_sliders/' . $s->img)
                        : null,
                    'target' => $s->target ?? '_self',
                    'show_btn_title' => (bool) ($s->show_btn_title ?? true),
                ];
            });

        // ----------------------------
        // sheikh intro
        // ----------------------------
        $introModel = SheikhIntro::where('status', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->orderByDesc('published_on')
            ->first();

        $intro = null;
        if ($introModel) {
            $intro = (object) [
                'id' => $introModel->id,
                'title' => $introModel->title,
                'description' => $introModel->description,
                'excerpt' => $this->makeExcerpt($introModel->description, 250),
                'img' => ($introModel->img && file_exists(public_path('assets/sheikh_intro/images/' . $introModel->img)))
                    ? asset('assets/sheikh_intro/images/' . $introModel->img)
                    : null,
                'slug' => $introModel->slug ?? $introModel->id,
            ];
        }

// ----------------------------
// videos (existing logic)
// ----------------------------
$videoCategory = Category::where('section', Category::SECTION_VIDEO)
    ->where('status', 1)
    ->orderByDesc('id')
    ->first();
$targetVideos = 5;
$videosCollection = collect();
$takenVideoIds = [];
$videoFeaturedCats = Category::where('section', Category::SECTION_VIDEO)
    ->where('status', 1)
    ->where('featured', 1)
    ->whereHas('videos', function ($q) use ($now) {
        $q->where('status', 1)
          ->where(function ($q2) use ($now) {
              $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
          });
    })
    ->orderByDesc('id')
    ->get();
foreach ($videoFeaturedCats as $vc) {
    if ($videosCollection->count() >= $targetVideos) break;
    $v = $vc->videos()
        ->where('status', 1)
        ->where(function ($q) use ($now) {
            $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
        })
        ->orderByDesc('published_on')
        ->first();
    if ($v) {
        $takenVideoIds[] = $v->id;
        $videosCollection->push($v);
    }
}
if ($videosCollection->count() < $targetVideos) {
    $videoNonFeaturedCats = Category::where('section', Category::SECTION_VIDEO)
        ->where('status', 1)
        ->where(function ($q) {
            $q->where('featured', 0)->orWhereNull('featured');
        })
        ->whereHas('videos', function ($q) use ($now) {
            $q->where('status', 1)
              ->where(function ($q2) use ($now) {
                  $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
              });
        })
        ->orderByDesc('id')
        ->get();
    foreach ($videoNonFeaturedCats as $vc) {
        if ($videosCollection->count() >= $targetVideos) break;
        $v = $vc->videos()
            ->where('status', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->orderByDesc('published_on')
            ->first();
        if ($v && !in_array($v->id, $takenVideoIds)) {
            $takenVideoIds[] = $v->id;
            $videosCollection->push($v);
        }
    }
}
if ($videosCollection->count() < $targetVideos) {
    $need = $targetVideos - $videosCollection->count();
    $additional = Video::where('status', 1)
        ->where(function ($q) use ($now) {
            $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
        })
        ->when(!empty($takenVideoIds), function ($q) use ($takenVideoIds) {
            $q->whereNotIn('id', $takenVideoIds);
        })
        ->orderByDesc('published_on')
        ->take($need)
        ->get();
    foreach ($additional as $a) {
        $takenVideoIds[] = $a->id;
        $videosCollection->push($a);
    }
}
$videos = $videosCollection->map(function ($v) {
    $thumb = $v->thumbnail;
    if ($thumb && !Str::startsWith($thumb, ['http://', 'https://'])) {
         $thumbCandidate = null;
        $candidates = [
             'upload/' . ltrim($thumb, '/'),
            'upload/' . basename($thumb),
             ltrim($thumb, '/'),
            'storage/' . ltrim($thumb, '/'),
            'videos/thumbnails/' . ltrim($thumb, '/'),
            'assets/videos/thumbnails/' . ltrim($thumb, '/'),
            'assets/video_categories/' . ltrim($thumb, '/'),
        ];

        foreach ($candidates as $p) {
            if ($p && file_exists(public_path($p))) {
                $thumbCandidate = asset($p);
                break;
            }
        }

         $thumb = $thumbCandidate ?: (file_exists(public_path($thumb)) ? asset($thumb) : $thumb);
    }

    $thumb = $thumb ?: asset('frontand/assets/img/normal/counter-image.jpg');

    return (object) [
        'id' => $v->id,
        'title' => $v->title,
        'slug' => $v->slug,
        'youtube_id' => $v->youtube_id,
        'thumbnail' => $thumb,
        'watch_url' => 'https://www.youtube.com/watch?v=' . $v->youtube_id,
        'published_on' => $v->published_on,
        'views' => $v->views ?? 0,
        'category' => $v->category ?? null,
        'description' => $v->description ?? null,
    ];
})->values();
$videosMain = $videos->first() ?? null;
$videosSmall = $videos->slice(1, 4)->values();

        // ----------------------------
        // audios (existing logic)
        // ----------------------------
        $targetAudios = 6;
        $audiosCollection = collect();
        $takenAudioIds = [];
        $audioFeaturedCats = Category::where('section', Category::SECTION_AUDIO)
            ->where('status', 1)
            ->where('featured', 1)
            ->whereHas('audios', function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                  });
            })
            ->orderByDesc('id')
            ->get();
        foreach ($audioFeaturedCats as $ac) {
            if ($audiosCollection->count() >= $targetAudios) break;
            $a = $ac->audios()
                ->where('status', 1)
                ->where(function ($q) use ($now) {
                    $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                })
                ->orderByDesc('published_on')
                ->first();
            if ($a) {
                $takenAudioIds[] = $a->id;
                $audiosCollection->push($a);
            }
        }
        if ($audiosCollection->count() < $targetAudios) {
            $audioNonFeaturedCats = Category::where('section', Category::SECTION_AUDIO)
                ->where('status', 1)
                ->where(function ($q) {
                    $q->where('featured', 0)->orWhereNull('featured');
                })
                ->whereHas('audios', function ($q) use ($now) {
                    $q->where('status', 1)
                      ->where(function ($q2) use ($now) {
                          $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                      });
                })
                ->orderByDesc('id')
                ->get();

            foreach ($audioNonFeaturedCats as $ac) {
                if ($audiosCollection->count() >= $targetAudios) break;
                $a = $ac->audios()
                    ->where('status', 1)
                    ->where(function ($q) use ($now) {
                        $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                    })
                    ->orderByDesc('published_on')
                    ->first();
                if ($a && !in_array($a->id, $takenAudioIds)) {
                    $takenAudioIds[] = $a->id;
                    $audiosCollection->push($a);
                }
            }
        }
        if ($audiosCollection->count() < $targetAudios) {
            $need = $targetAudios - $audiosCollection->count();
            $additionalAudios = Audio::where('status', 1)
                ->where(function ($q) use ($now) {
                    $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                })
                ->when(!empty($takenAudioIds), function ($q) use ($takenAudioIds) {
                    $q->whereNotIn('id', $takenAudioIds);
                })
                ->orderByDesc('published_on')
                ->take($need)
                ->get();
            foreach ($additionalAudios as $ad) {
                $takenAudioIds[] = $ad->id;
                $audiosCollection->push($ad);
            }
        }
        $audios = $audiosCollection->map(function ($a) {
            $img = ($a->img && file_exists(public_path('assets/audios/images/' . $a->img)))
                ? asset('assets/audios/images/' . $a->img)
                : ((!empty($a->img) && Str::startsWith($a->img, ['http://','https://'])) ? $a->img : asset('frontand/assets/img/normal/counter-image.jpg'));
            $audioFile = $a->audio_file ?? null;
            if ($audioFile && file_exists(public_path('assets/audios/files/' . $audioFile))) {
                $audioUrl = asset('assets/audios/files/' . $audioFile);
            } elseif ($audioFile && Str::startsWith($audioFile, ['http://','https://'])) {
                $audioUrl = $audioFile;
            } else {
                $audioUrl = $audioFile ? asset($audioFile) : null;
            }
            return (object) [
                'id' => $a->id,
                'title' => $a->title,
                'slug' => $a->slug,
                'excerpt' => $a->excerpt ?? $a->description ?? null,
                'img' => $img,
                'audio_url' => $audioUrl,
                'published_on' => $a->published_on ? Carbon::parse($a->published_on)->format('Y-m-d') : null,
                'category' => $a->category ?? null,
            ];
        })->values();

        $audiosCount = Audio::where('status', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->count();

        // ----------------------------
        // audio categories (existing logic)
        // ----------------------------
        $targetTabs = 4;
        $audioCatsFeatured = Category::where('section', Category::SECTION_AUDIO)
            ->where('status', 1)
            ->where('featured', 1)
            ->whereHas('audios', function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                  });
            })
            ->orderByDesc('id')
            ->get();
        $audioCatsNonFeatured = Category::where('section', Category::SECTION_AUDIO)
            ->where('status', 1)
            ->where(function ($q) {
                $q->where('featured', 0)->orWhereNull('featured');
            })
            ->whereHas('audios', function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                  });
            })
            ->orderByDesc('id')->get();
        $audioCategories = $audioCatsFeatured->concat($audioCatsNonFeatured)->take($targetTabs);
        $audioCategories = $audioCategories->map(function ($cat) use ($now) {
            $latest = $cat->audios()
                ->where('status', 1)
                ->where(function ($q) use ($now) {
                    $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                })
                ->orderByDesc('published_on')
                ->take(5)
                ->get();
            $cat->setRelation('audios', $latest);
            return $cat;
        })->values();

        // ----------------------------
        // blogs/books/durars (existing logic)
        // ----------------------------
        $targetBlogs = 3;
        $blogsCollection = collect();
        $blogCatsFeatured = Category::where('section', Category::SECTION_ARTICLE)
            ->where('status', 1)
            ->where('featured', 1)
            ->whereHas('blogs', function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                  });
            })
            ->orderByDesc('id')
            ->get();
        $blogCatsNonFeatured = Category::where('section', Category::SECTION_ARTICLE)
            ->where('status', 1)
            ->where(function ($q) {
                $q->where('featured', 0)->orWhereNull('featured');
            })
            ->whereHas('blogs', function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                  });
            })
            ->orderByDesc('id')
            ->get();
        $blogCategories = $blogCatsFeatured->concat($blogCatsNonFeatured);
        $catCountBlogs = $blogCategories->count();
        if ($catCountBlogs === 0) {
            $globalBlogs = Blog::where('status', 1)
                ->where(function ($q) use ($now) {
                    $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                })
                ->orderByDesc('published_on')
                ->take($targetBlogs)
                ->get();
            foreach ($globalBlogs as $b) {
                $blogsCollection->push((object) [
                    'id' => $b->id,
                    'title' => $b->title,
                    'slug' => $b->slug,
                    'excerpt' => $this->makeExcerpt($b->excerpt ?? $b->description ?? '', 200),
                    'img' => ($b->img && file_exists(public_path('assets/blogs/images/' . $b->img)))
                        ? asset('assets/blogs/images/' . $b->img)
                        : asset('frontand/assets/img/normal/counter-image.jpg'),
                    'published_on' => $b->published_on ? Carbon::parse($b->published_on)->format('Y-m-d') : null,
                    'category_title' => optional($b->category)->title,
                ]);
            }
        } elseif ($catCountBlogs >= $targetBlogs) {
            $selected = $blogCategories->take($targetBlogs);
            foreach ($selected as $cat) {
                $item = $cat->blogs()
                    ->where('status', 1)
                    ->where(function ($q) use ($now) {
                        $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                    })
                    ->orderByDesc('published_on')
                    ->first();
                if ($item) {
                    $blogsCollection->push((object) [
                        'id' => $item->id,
                        'title' => $item->title,
                        'slug' => $item->slug,
                        'excerpt' => $this->makeExcerpt($item->excerpt ?? $item->description ?? '', 200),
                        'img' => ($item->img && file_exists(public_path('assets/blogs/images/' . $item->img)))
                            ? asset('assets/blogs/images/' . $item->img)
                            : asset('frontand/assets/img/normal/counter-image.jpg'),
                        'published_on' => $item->published_on ? Carbon::parse($item->published_on)->format('Y-m-d') : null,
                        'category_title' => $cat->title,
                    ]);
                }
            }
        } else {
            $base = intdiv($targetBlogs, $catCountBlogs);
            $remainder = $targetBlogs - ($base * $catCountBlogs);
            foreach ($blogCategories as $cat) {
                $take = $base + ($remainder > 0 ? 1 : 0);
                if ($remainder > 0) $remainder--;
                $items = $cat->blogs()
                    ->where('status', 1)
                    ->where(function ($q) use ($now) {
                        $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                    })
                    ->orderByDesc('published_on')
                    ->take($take)
                    ->get();
                foreach ($items as $item) {
                    $blogsCollection->push((object) [
                        'id' => $item->id,
                        'title' => $item->title,
                        'slug' => $item->slug,
                        'excerpt' => $this->makeExcerpt($item->excerpt ?? $item->description ?? '', 200),
                        'img' => ($item->img && file_exists(public_path('assets/blogs/images/' . $item->img)))
                            ? asset('assets/blogs/images/' . $item->img)
                            : asset('frontand/assets/img/normal/counter-image.jpg'),
                        'published_on' => $item->published_on ? Carbon::parse($item->published_on)->format('Y-m-d') : null,
                        'category_title' => $cat->title,
                    ]);
                }
            }
            if ($blogsCollection->count() < $targetBlogs) {
                $alreadyIds = $blogsCollection->pluck('id')->all();
                $more = Blog::where('status', 1)
                    ->where(function ($q) use ($now) {
                        $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                    })
                    ->whereNotIn('id', $alreadyIds)
                    ->orderByDesc('published_on')
                    ->take($targetBlogs - $blogsCollection->count())
                    ->get();
                foreach ($more as $m) {
                    $blogsCollection->push((object) [
                        'id' => $m->id,
                        'title' => $m->title,
                        'slug' => $m->slug,
                        'excerpt' => $this->makeExcerpt($m->excerpt ?? $m->description ?? '', 200),
                        'img' => ($m->img && file_exists(public_path('assets/blogs/images/' . $m->img)))
                            ? asset('assets/blogs/images/' . $m->img)
                            : asset('frontand/assets/img/normal/counter-image.jpg'),
                        'published_on' => $m->published_on ? Carbon::parse($m->published_on)->format('Y-m-d') : null,
                        'category_title' => optional($m->category)->title,
                    ]);
                }
            }
        }
        $blogs = $blogsCollection->unique('id')
            ->sortByDesc(function ($it) {
                return $it->published_on ?? null;
            })
            ->values();

        $books = Book::where('status', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->orderByDesc('published_on')
            ->take(3)
            ->get()
            ->map(function ($bk) {
                $img = ($bk->img && file_exists(public_path('assets/books/images/' . $bk->img)))
                    ? asset('assets/books/images/' . $bk->img)
                    : asset('frontand/assets/img/normal/counter-image.jpg');
                $fileUrl = $bk->file && file_exists(public_path('assets/books/files/' . $bk->file))
                    ? asset('assets/books/files/' . $bk->file)
                    : null;
                return (object) [
                    'id' => $bk->id,
                    'title' => $bk->title,
                    'slug' => $bk->slug,
                    'description' => $bk->description,
                    'excerpt' => $this->makeExcerpt($bk->excerpt ?? $bk->description ?? '', 200),
                    'img' => $img,
                    'file_url' => $fileUrl,
                    'published_on' => $bk->published_on ? Carbon::parse($bk->published_on)->format('Y-m-d') : null,
                ];
            })->values();

        $durars = DurarDiniya::where('status', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->orderByDesc('published_on')
            ->take(6)
            ->get()
            ->map(function ($d) {
                $img = ($d->img && file_exists(public_path('assets/durar_diniya/images/' . $d->img)))
                    ? asset('assets/durar_diniya/images/' . $d->img)
                    : asset('frontand/assets/img/normal/counter-image.jpg');
                return (object) [
                    'id' => $d->id,
                    'title' => $d->title,
                    'slug' => $d->slug,
                    'excerpt' => $this->makeExcerpt($d->description, 120),
                    'img' => $img,
                    'published_on' => $d->published_on ? Carbon::parse($d->published_on)->format('Y-m-d') : null,
                ];
            });

        // ----------------------------
        // fatawa categories & fatawas (THIS SECTION ADJUSTED)
        // ----------------------------
        $fatawaCatsFeatured = Category::where('section', Category::SECTION_FATWA)
            ->where('status', 1)
            ->where('featured', 1)
            ->whereHas('fatawas', function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                  });
            })
            ->orderByDesc('id')
            ->get();

        $fatawaCatsNonFeatured = Category::where('section', Category::SECTION_FATWA)
            ->where('status', 1)
            ->where(function ($q) {
                $q->where('featured', 0)->orWhereNull('featured');
            })
            ->whereHas('fatawas', function ($q) use ($now) {
                $q->where('status', 1)
                  ->where(function ($q2) use ($now) {
                      $q2->whereNull('published_on')->orWhere('published_on', '<=', $now);
                  });
            })
            ->orderByDesc('id')->get();

         $categories = $fatawaCatsFeatured->concat($fatawaCatsNonFeatured);

         $selectedCategorySlug = $request->input('category', null);
        $fatawasCollection = collect();

        if ($selectedCategorySlug) {
             $selectedCat = $categories->firstWhere('slug', $selectedCategorySlug)
                ?? Category::where('section', Category::SECTION_FATWA)
                    ->where('slug', $selectedCategorySlug)
                    ->where('status', 1)
                    ->first();

            if ($selectedCat) {
                 $items = $selectedCat->fatawas()
                    ->where('status', 1)
                    ->where(function ($q) use ($now) {
                        $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                    })
                    ->orderByDesc('published_on')
                    ->get();

                foreach ($items as $item) {
                    $fatawasCollection->push((object) [
                        'id' => $item->id,
                        'title' => $item->title,
                        'slug' => $item->slug,
                        'excerpt' => $this->makeExcerpt($item->excerpt ?? $item->description ?? '', 160),
                        'img' => ($item->img && file_exists(public_path('assets/fatawa/images/' . $item->img)))
                            ? asset('assets/fatawa/images/' . $item->img)
                            : asset('frontand/assets/img/normal/counter-image.jpg'),
                        'published_on' => $item->published_on ? Carbon::parse($item->published_on)->format('Y-m-d') : null,
                        'category_title' => $selectedCat->title ?? ($selectedCat->name ?? null),
                    ]);
                }
            } else {
                 $fatawasCollection = collect();
            }
        } else {
             $categoriesForSample = $categories;
            $catCount = $categoriesForSample->count();
            $targetTotal = 6;

            if ($catCount === 0) {
                $global = Fatwa::where('status', 1)
                    ->where(function ($q) use ($now) {
                        $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                    })
                    ->orderByDesc('published_on')
                    ->take($targetTotal)
                    ->get();
                foreach ($global as $f) {
                    $fatawasCollection->push((object) [
                        'id' => $f->id,
                        'title' => $f->title,
                        'slug' => $f->slug,
                        'excerpt' => $this->makeExcerpt($f->excerpt ?? $f->description ?? '', 160),
                        'img' => ($f->img && file_exists(public_path('assets/fatawa/images/' . $f->img)))
                            ? asset('assets/fatawa/images/' . $f->img)
                            : asset('frontand/assets/img/normal/counter-image.jpg'),
                        'published_on' => $f->published_on ? Carbon::parse($f->published_on)->format('Y-m-d') : null,
                        'category_title' => optional($f->category)->title,
                    ]);
                }
            } elseif ($catCount >= $targetTotal) {
                $selectedCats = $categoriesForSample->take($targetTotal);
                foreach ($selectedCats as $cat) {
                    $item = $cat->fatawas()
                        ->where('status', 1)
                        ->where(function ($q) use ($now) {
                            $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                        })
                        ->orderByDesc('published_on')
                        ->first();
                    if ($item) {
                        $fatawasCollection->push((object) [
                            'id' => $item->id,
                            'title' => $item->title,
                            'slug' => $item->slug,
                            'excerpt' => $this->makeExcerpt($item->excerpt ?? $item->description ?? '', 160),
                            'img' => ($item->img && file_exists(public_path('assets/fatawa/images/' . $item->img)))
                                ? asset('assets/fatawa/images/' . $item->img)
                                : asset('frontand/assets/img/normal/counter-image.jpg'),
                            'published_on' => $item->published_on ? Carbon::parse($item->published_on)->format('Y-m-d') : null,
                            'category_title' => $cat->title,
                        ]);
                    }
                }
            } else {
                $base = intdiv($targetTotal, $catCount);
                $remainder = $targetTotal - ($base * $catCount);
                foreach ($categoriesForSample as $cat) {
                    $take = $base + ($remainder > 0 ? 1 : 0);
                    if ($remainder > 0) $remainder--;
                    $items = $cat->fatawas()
                        ->where('status', 1)
                        ->where(function ($q) use ($now) {
                            $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                        })
                        ->orderByDesc('published_on')
                        ->take($take)
                        ->get();
                    foreach ($items as $item) {
                        $fatawasCollection->push((object) [
                            'id' => $item->id,
                            'title' => $item->title,
                            'slug' => $item->slug,
                            'excerpt' => $this->makeExcerpt($item->excerpt ?? $item->description ?? '', 160),
                            'img' => ($item->img && file_exists(public_path('assets/fatawa/images/' . $item->img)))
                                ? asset('assets/fatawa/images/' . $item->img)
                                : asset('frontand/assets/img/normal/counter-image.jpg'),
                            'published_on' => $item->published_on ? Carbon::parse($item->published_on)->format('Y-m-d') : null,
                            'category_title' => $cat->title,
                        ]);
                    }
                }
                if ($fatawasCollection->count() < $targetTotal) {
                    $alreadyIds = $fatawasCollection->pluck('id')->all();
                    $more = Fatwa::where('status', 1)
                        ->where(function ($q) use ($now) {
                            $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                        })
                        ->whereNotIn('id', $alreadyIds)
                        ->orderByDesc('published_on')
                        ->take($targetTotal - $fatawasCollection->count())
                        ->get();
                    foreach ($more as $m) {
                        $fatawasCollection->push((object) [
                            'id' => $m->id,
                            'title' => $m->title,
                            'slug' => $m->slug,
                            'excerpt' => $this->makeExcerpt($m->excerpt ?? $m->description ?? '', 160),
                            'img' => ($m->img && file_exists(public_path('assets/fatawa/images/' . $m->img)))
                                ? asset('assets/fatawa/images/' . $m->img)
                                : asset('frontand/assets/img/normal/counter-image.jpg'),
                            'published_on' => $m->published_on ? Carbon::parse($m->published_on)->format('Y-m-d') : null,
                            'category_title' => optional($m->category)->title,
                        ]);
                    }
                }
            }
        }

         $fatawas = $fatawasCollection
            ->unique('id')
            ->sortByDesc(function ($it) {
                return ($it->published_on) ?? null;
            })
            ->values();

        $fatawasCount = $fatawas->count();
        if (!$selectedCategorySlug) {
             $fatawasCount = Fatwa::where('status', 1)
                ->where(function ($q) use ($now) {
                    $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                })
                ->count();
        }

         $fatawaCategories = $categories;

         return view('frontend.index', compact(
            'sliders',
            'intro',
            'videos',
            'videosMain',
            'videosSmall',
            'videoCategory',
            'books',
            'durars',
            'blogs',
            'fatawas',
            'fatawasCount',
            'audios',
            'audiosCount',
            'audioCategories',
            'fatawaCategories',
             'categories',
            'selectedCategorySlug'
        ));
    }

    public function durarsIndex(Request $request)
    {
        $now = Carbon::now();
        $perPage = (int) ($request->input('limit_by', 12));
        $query = DurarDiniya::where('status', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->orderByDesc('published_on');
        $durars = $query->paginate($perPage);
        $durars->getCollection()->transform(function ($d) {
            $img = ($d->img && file_exists(public_path('assets/durar_diniya/images/' . $d->img)))
                ? asset('assets/durar_diniya/images/' . $d->img)
                : asset('frontand/assets/img/normal/counter-image.jpg');
            return (object) [
                'id' => $d->id,
                'title' => $d->title,
                'slug' => $d->slug,
                'excerpt' => $this->makeExcerpt($d->description, 250),
                'img' => $img,
                'published_on' => $d->published_on ? Carbon::parse($d->published_on)->format('Y-m-d') : null,
            ];
        });
        return view('frontend.durars.index', compact('durars'));
    }

    public function durarShow($slug)
    {
        $now = Carbon::now();
        $durar = DurarDiniya::where('slug', $slug)->orWhere('id', $slug)->firstOrFail();
        try {
            $durar->increment('views');
        } catch (\Throwable $e) {
        }
        if (!empty($durar->img) && file_exists(public_path('assets/durar_diniya/images/' . $durar->img))) {
            $img = asset('assets/durar_diniya/images/' . $durar->img);
        } elseif (!empty($durar->img) && Str::startsWith($durar->img, ['http://', 'https://'])) {
            $img = $durar->img;
        } else {
            $img = asset('frontand/assets/img/normal/counter-image.jpg');
        }
        $limit = 5;
        $recent = DurarDiniya::where('status', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
            })
            ->where('id', '!=', $durar->id)
            ->orderByDesc('published_on')
            ->take($limit)
            ->get();
        if ($recent->count() < $limit) {
            $needed = $limit - $recent->count();
            $additional = DurarDiniya::where('status', 1)
                ->where(function ($q) use ($now) {
                    $q->whereNull('published_on')->orWhere('published_on', '<=', $now);
                })
                ->orderByDesc('published_on')
                ->take($limit + 5)
                ->get()
                ->reject(function ($item) use ($recent, $durar) {
                    if ($item->id == $durar->id) return true;
                    return $recent->contains('id', $item->id);
                })
                ->take($needed);
            $recent = $recent->concat($additional)->slice(0, $limit);
        }
        $recentDurars = $recent->map(function ($d) {
            return (object) [
                'id' => $d->id,
                'title' => $d->title,
                'slug' => $d->slug,
                'excerpt' => $this->makeExcerpt($d->description, 80),
                'img' => ($d->img && file_exists(public_path('assets/durar_diniya/images/' . $d->img)))
                    ? asset('assets/durar_diniya/images/' . $d->img)
                    : asset('frontand/assets/img/normal/counter-image.jpg'),
                'published_on' => $d->published_on ? Carbon::parse($d->published_on)->format('Y-m-d') : null,
            ];
        });
        return view('frontend.durars.show', compact('durar', 'img', 'recentDurars'));
    }

    public function sheikhIntroShow($slug)
    {
        $introModel = SheikhIntro::where('slug', $slug)->orWhere('id', $slug)->firstOrFail();
        try {
            $introModel->increment('views');
        } catch (\Throwable $e) {
        }
        return view('frontend.sheikh_intro.show', compact('introModel'));
    }
}