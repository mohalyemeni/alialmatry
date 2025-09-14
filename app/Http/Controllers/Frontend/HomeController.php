<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {

        $sliders = Slider::mainSliders()
            ->active()
            ->where(function($q){
                $q->whereNull('published_on')
                  ->orWhere('published_on', '<=', now());
            })
            ->orderBy('section', 'asc')
            ->limit(6)
            ->get()
            ->map(function($s) {

                $getVal = function($val){
                    if (is_array($val)) {
                        return $val['ar'] ?? reset($val) ?? null;
                    }
                    return $val;
                };

                return [
                    'id' => $s->id,
                    'title' => $getVal($s->title),
                    'subtitle' => $getVal($s->subtitle),
                    'description' => $getVal($s->description),
                    'btn_title' => $getVal($s->btn_title),
                    'url' => $getVal($s->url),
                    'img' => $s->img,
                    'slug' => $s->slug,
                ];
            });

        return view('frontend.home', compact('sliders'));
    }
}