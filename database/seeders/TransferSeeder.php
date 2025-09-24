<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Audio;
use App\Models\Video;
use App\Models\Fatwa;
use App\Models\Blog;
use App\Models\Book;
use App\Models\Pages;
use App\Models\DurarDiniya;
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
        // $this->saveVedios();
        // $this->saveAudios();
        // $this->saveFatwas();
        // $this->saveBlogs();
        $this->saveBooks();
        $this->saveDurarDiniya();

    }

    private function saveVedios(){
        $oldCat = collect(OldCategory::whereSections(2)->get());

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
                'section'         =>2,
            ]);

            $this->saveRemoteImage($url, 'vedio_categories');
            $oldVedios = Post::where('cid', $ocat->cid)->get();
            foreach($oldVedios as $ved){
            $imgUrl = $ved->img;
                $newved = Video::create([

                'title'            => $ved->title,
                'description'      => $ved->content,
                'youtube_id'       => $ved->attatches,
                'thumbnail'        => basename($imgUrl),
                'meta_keywords'     => $ved->meta_keywords,
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

            $this->saveRemoteImage($imgUrl, 'upload');
            }
        }
    }

    // -----------------------------------------------------
    private function saveAudios(){
        $oldCat = collect(OldCategory::whereSections(1)->get());

        foreach($oldCat as $ocat){
            $url = $ocat->img;

            $newcat = Category::create([
                'title'            => $ocat->title,
                'description'      => $ocat->content,
                'img'              => basename($url),
                'meta_keywords'    => $ocat->meta_keywords,
                'meta_description' => $ocat->meta_description,
                'published_on'     => $ocat->published_at,
                'created_by'       => 1,
                'updated_by'       => 1,
                'views'            => $ocat->views,
                'status'           => $ocat->status,
                'created_at'       => $ocat->created_at,
                'updated_at'       => $ocat->modified_by,
                'section'          => 1,
            ]);

            $this->saveRemoteImage($url, 'audio_categories');

            $oldAudios = Post::where('cid', $ocat->cid)->get();

            foreach($oldAudios as $aud){
                $imgUrl = $aud->img;

                $newAudio = Audio::create([
                    'title'            => $aud->title,
                    'description'      => $aud->content,
                    'img'           => basename($imgUrl),
                    'audio_file'       => basename($aud->attatches),
                    'meta_keywords'    => $aud->meta_keywords,
                    'meta_description' => $aud->meta_description,
                    'published_on'     => $aud->published_at,
                    'created_by'       => 1,
                    'updated_by'       => 1,
                    'views'            => $aud->views,
                    'status'           => $aud->status,
                    'created_at'       => $aud->created_at,
                    'updated_at'       => $aud->modified_by,
                    'category_id'      => $newcat->id,
                ]);

                $this->saveRemoteImage($imgUrl, 'audios');

                $this->saveRemoteImage($aud->attatches, 'audios/files');
            }
        }
    }
// =========================================================
    private function saveFatwas()
    {

        $oldCat = collect(OldCategory::whereSections(3)->get());

        foreach ($oldCat as $ocat) {
            $url = $ocat->img;

            $newcat = Category::create([
                'title'            => $ocat->title,
                'description'      => $ocat->content,
                'img'              => basename($url),
                'meta_keywords'    => $ocat->meta_keywords,
                'meta_description' => $ocat->meta_description,
                'published_on'     => $ocat->published_at,
                'created_by'       => 1,
                'updated_by'       => 1,
                'views'            => $ocat->views,
                'status'           => $ocat->status,
                'created_at'       => $ocat->created_at,
                'updated_at'       => $ocat->modified_by,
                'section'          => 3,
            ]);

            $this->saveRemoteImage($url, 'fatwa_categories');

            $oldFatwas = Post::where('cid', $ocat->cid)->get();

            foreach ($oldFatwas as $fatwa) {
                $imgUrl   = $fatwa->img;
                $audioUrl = $fatwa->attatches;
                $newFatwa = Fatwa::create([
                    'title'            => $fatwa->title,
                    'description'      => $fatwa->content,
                    'img'              => basename($imgUrl),
                    'audio_file'            => basename($audioUrl),
                    'meta_keywords'    => $fatwa->meta_keywords,
                    'meta_description' => $fatwa->meta_description,
                    'published_on'     => $fatwa->published_at,
                    'created_by'       => 1,
                    'updated_by'       => 1,
                    'views'            => $fatwa->views,
                    'status'           => $fatwa->status,
                    'created_at'       => $fatwa->created_at,
                    'updated_at'       => $fatwa->modified_by,
                    'category_id'      => $newcat->id,
                ]);

                $this->saveRemoteImage($imgUrl, 'fatawa/images');

                $this->saveRemoteImage($audioUrl, 'fatawa/files');
            }
        }
    }
// =========================================================
    private function saveBlogs(){
        $oldCat = collect(OldCategory::whereSections(4)->get());

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
                'section'         =>4,
            ]);

            $this->saveRemoteImage($url, 'blog_categories');
            $oldBlog = Post::where('cid', $ocat->cid)->get();
            foreach($oldBlog as $blog){
            $imgUrl = $blog->img;
                $newblog = Blog::create([

                'title'            => $blog->title,
                'description'      => $blog->content,
                'img'        => basename($imgUrl),
                'meta_keywords'     => $blog->meta_keywords,
                'meta_description' => $blog->meta_description,
                'published_on'     => $blog->published_at,
                'created_by'       => 1,
                'updated_by'       => 1,
                'views'            =>$blog->views,
                'status'           =>$blog->status,
                'created_at'       =>$blog->created_at,
                'updated_at'       =>$blog->modified_by ,
                'category_id'      => $newcat->id,
            ]);

            $this->saveRemoteImage($imgUrl, 'blogs/images');
            }
        }
    }
// =========================================================
private function saveBooks()
{

    $oldBooks = Post::where('cid', 0)->get();

    foreach ($oldBooks as $book) {
        $imgUrl   = $book->img;
        $fileUrl  = $book->attatches;

        $newBook = Book::create([
            'title'            => $book->title,
            'description'      => $book->content,
            'img'               => basename($imgUrl),
            'file'        =>  basename($fileUrl),
            'meta_keywords'    => $book->meta_keywords,
            'meta_description' => $book->meta_description,
            'published_on'     => $book->published_at,
            'created_by'       => 1,
            'updated_by'       => 1,
            'views'            => $book->views,
            'status'           => $book->status,
            'created_at'       => $book->created_at,
             'updated_at'       => $book->updated_at,
        ]);


            $this->saveRemoteImage($imgUrl, 'books/images');

            $this->saveRemoteImage($fileUrl, 'books/files');

    }
}
// =========================================================
private function saveDurarDiniya()
{
    $oldDurar = Pages::where('page_type', 3)->get();

    foreach ($oldDurar as $durar) {
        $imgUrl  = $durar->img;

        $newBook = DurarDiniya::create([
            'title'            => $durar->title,
            'description'      => $durar->content,
            'img'              =>  basename($imgUrl),
             'meta_keywords'    => $durar->meta_keywords,
            'meta_description' => $durar->meta_description,
            'published_on'     => $durar->published_at,
            'created_by'       => 1,
            'updated_by'       => 1,
            'views'            => $durar->views,
            'status'           => $durar->status,
            'created_at'       => $durar->created_at,
            'updated_at'       => $durar->updated_at,
        ]);



            $this->saveRemoteImage($imgUrl, 'durar_diniya/images');


    }
}




private function saveRemoteImage(?string $url, string $folder = 'upload')
{
    if (empty($url)) {
        return null;
    }

    try {
        // محاولة جلب الملف باستخدام Http Client
        $response = Http::timeout(30)          // وقت الانتظار 30 ثانية
                        ->withoutVerifying()   // تجاهل مشاكل SSL
                        ->get($url);

        // لو فشل الطلب نرجع null
        if ($response->failed()) {
            return null;
        }

        $contents = $response->body();
        $fileName = basename($url);
        $path = public_path("assets/" . $folder . "/" . $fileName);

        // إنشاء المجلد إذا مش موجود
        if (!File::exists(dirname($path))) {
            File::makeDirectory(dirname($path), 0755, true);
        }

        // تخزين الملف
        File::put($path, $contents);

        return "assets/" . $folder . "/" . $fileName;

    } catch (\Exception $e) {
        // في حالة أي خطأ نرجع null
        return null;
    }
}

}
