<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Audio;
use App\Models\Video;
use App\Models\Category;
use App\Models\OldCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class TransferSeeder extends Seeder
{
    public function run(): void
    {
        $this->saveAudios();

    }

    private function saveAudios(){
        $oldCat = collect(OldCategory::whereSections(1)->get());

        foreach($oldCat as $ocat){
            $url = $ocat->img;
            $newcat = Category::create([
                'title'            => $ocat->title,
                'description'      => $ocat->content,
                'img'              => basename($url),
                'meta_keywords'     => $ocat->meta_keywords,
                'meta_description' => $ocat->meta_description,
                'published_on'     => $ocat->published_at,
                'created_by'       => 1,
                'updated_by'       => 1,
                'views'            =>$ocat->views,
                'status'           =>$ocat->status,
                'created_at'       =>$ocat->created_at,
                'updated_at'       =>$ocat->modified_by,
                'section'         =>1,
            ]);

            $this->saveRemoteImage($url, 'blog_categories');
            $oldVedios = Post::where('cid', $ocat->cid)->get();
            foreach($oldVedios as $ved){
            $imgUrl = $ved->img;
                $newved = Video::create([

                'title'            => $ved->title,
                'description'      => $ved->content,
                'youtube_id'       => $ved->attatches,
                'thumbnail'        => basename($imgUrl),
                'meta_keyword'     => $ved->meta_keywords,
                'meta_description' => $ved->meta_description,
                'published_on'     => $ved->published_at,
                'created_by'       => 1,
                'updated_by'       => 1,
                'views'            =>$ved->views,
                'status'           =>$ved->status,
                'created_at'       =>$ved->created_at,
                'updated_at'       =>$ved->modified_by ,
                'category_id'      => $newcat->id,
            ]);
            $this->saveRemoteImage($imgUrl, 'blogs/images');
            }
        }
    }

    private function saveRemoteImage(?string $url, string $folder = 'upload')
    {
         if (empty($url)) {
            return null;
        }

        $contents = file_get_contents($url);   // جلب الملف من الرابط
            $fileName = basename($url);
            $path = public_path("assets/".$folder."/" . $fileName); // مسار التخزين داخل public مباشرة
            // إنشاء المجلد لو مش موجود
            if (!File::exists(dirname($path))) {
                File::makeDirectory(dirname($path), 0755, true);
            }
            // تخزين الملف
            File::put($path, $contents);
    }


}