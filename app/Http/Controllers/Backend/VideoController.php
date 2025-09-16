<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\VideoRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        if (! auth()->user()->ability('admin', 'manage_videos,show_videos')) {
            return redirect('admin/index');
        }
        $query = Video::with(['category', 'creator']);
        if ($request->filled('keyword')) {
            $query->search($request->keyword);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        $videos = $query
            ->orderBy($request->sort_by ?? 'id', $request->order_by ?? 'desc')
            ->paginate($request->limit_by ?? 10);
        $categories = Category::where('section', Category::SECTION_VIDEO)
            ->orderBy('id', 'desc')
            ->get();
        return view('backend.videos.index', compact('videos', 'categories'));
    }

    public function create()
    {
        if (! auth()->user()->ability('admin', 'create_videos')) {
            return redirect('admin/index');
        }
        $categories = Category::where('status', 1)
            ->where('section', Category::SECTION_VIDEO)
            ->get();
        return view('backend.videos.create', compact('categories'));
    }

    public function store(VideoRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_videos')) {
            return redirect('admin/index');
        }

        $data = $request->validated();

        $category = Category::where('id', $data['category_id'] ?? null)
            ->where('section', Category::SECTION_VIDEO)
            ->first();

        if (!$category) {
            return redirect()->back()->withInput()->withErrors([
                'category_id' => 'التصنيف غير صالح للقسم الفيديو.'
            ]);
        }

        $slug = Str::slug($data['title']);
        $originalSlug = $slug; $counter = 1;
        while (Video::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $video = new Video();
        $video->title = $data['title'];
        $video->slug = $slug;
        $video->description = $data['description'] ?? null;
        $video->youtube_id = $data['youtube_id'];

        $thumbnailInput = $request->input('local_thumbnail') ?? $request->input('thumbnail');

        if ($thumbnailInput) {
            if ($this->isLocalThumb($thumbnailInput)) {
                 $video->thumbnail = $thumbnailInput;
            } elseif (Str::startsWith($thumbnailInput, ['http://', 'https://'])) {
                 $video->thumbnail = $this->saveRemoteImage($thumbnailInput, 'upload');
            } else {
                $video->thumbnail = $thumbnailInput;
            }
        }

        $video->category_id = $data['category_id'];
        $video->meta_keywords = $data['meta_keywords'] ?? null;
        $video->meta_description = $data['meta_description'] ?? null;
        $video->published_on = $data['published_on'] ?? null;
        $video->status = isset($data['status']) ? (bool)$data['status'] : true;
        $video->views = $data['views'] ?? 0;
        $video->save();

        return redirect()->route('admin.videos.index')->with([
            'message' => 'تم إضافة الفيديو بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function edit($id)
    {
        if (! auth()->user()->ability('admin', 'update_videos')) {
            return redirect('admin/index');
        }
        $video = Video::findOrFail($id);
        $categories = Category::where('status', 1)
            ->where('section', Category::SECTION_VIDEO)
            ->get();
        return view('backend.videos.edit', compact('video', 'categories'));
    }

    public function update(VideoRequest $request, $id)
    {
        if (! auth()->user()->ability('admin', 'update_videos')) {
            return redirect('admin/index');
        }

        $video = Video::findOrFail($id);
        $data = $request->validated();

        $category = Category::where('id', $data['category_id'] ?? null)
            ->where('section', Category::SECTION_VIDEO)
            ->first();
        if (!$category) {
            return redirect()->back()->withInput()->withErrors([
                'category_id' => 'التصنيف غير صالح للقسم الفيديو.'
            ]);
        }

        $oldTitle = $video->title;
        $video->title = $data['title'];

        if ($data['title'] !== $oldTitle) {
            $slug = Str::slug($data['title']);
            if (Video::where('slug', $slug)->where('id', '!=', $video->id)->exists()) {
                $slug = $slug . '-' . time();
            }
            $video->slug = $slug;
        } elseif (empty($video->slug)) {
            $video->slug = Str::slug($data['title']);
        }

        $video->description = $data['description'] ?? null;
        $video->youtube_id = $data['youtube_id'];

        $thumbnailInput = $request->input('local_thumbnail') ?? $request->input('thumbnail');

        if ($thumbnailInput) {
            if ($this->isLocalThumb($thumbnailInput)) {

                $this->maybeDeleteOldThumb($video, $thumbnailInput);
                $video->thumbnail = $thumbnailInput;

            } elseif (Str::startsWith($thumbnailInput, ['http://','https://'])) {

                $localThumb = $this->saveRemoteImage($thumbnailInput, 'upload');
                if ($localThumb) {
                    $this->maybeDeleteOldThumb($video, $localThumb);
                    $video->thumbnail = $localThumb;
                } else {
                 }

            } else {

                $this->maybeDeleteOldThumb($video, $thumbnailInput);
                $video->thumbnail = $thumbnailInput;
            }
        }

        $video->category_id = $data['category_id'];
        $video->meta_keywords = $data['meta_keywords'] ?? null;
        $video->meta_description = $data['meta_description'] ?? null;
        $video->published_on = $data['published_on'] ?? null;
        $video->status = isset($data['status']) ? (bool)$data['status'] : $video->status;
        $video->save();

        return redirect()->route('admin.videos.index')->with([
            'message' => 'تم تحديث بيانات الفيديو بنجاح',
            'alert-type' => 'success',
        ]);
    }

    private function isLocalThumb(?string $path): bool
    {
        if (!is_string($path) || $path === '') return false;

         $candidates = [
            $path,
            'upload/' . ltrim($path, '/'),
            'videos/thumbnails/' . ltrim($path, '/'),
            'assets/videos/thumbnails/' . ltrim($path, '/'),
            'assets/video_categories/' . ltrim($path, '/'),
        ];

        foreach ($candidates as $p) {
            if (file_exists(public_path($p))) {
                return true;
            }
        }

        return false;
    }

    private function maybeDeleteOldThumb(Video $video, string $newPath): void
    {
        if (
            $video->thumbnail
            && $video->thumbnail !== $newPath
            && ! Str::startsWith($video->thumbnail, 'http')
        ) {
            $oldFull = public_path($video->thumbnail);
            if (file_exists($oldFull) && is_file($oldFull)) {
                @unlink($oldFull);
            }
        }
    }

    public function destroy($id)
    {
        if (! auth()->user()->ability('admin', 'delete_videos')) {
            return redirect('admin/index');
        }
        $video = Video::findOrFail($id);

        if ($video->thumbnail && ! Str::startsWith($video->thumbnail, 'http')) {
            $full = public_path($video->thumbnail);
            if (file_exists($full)) {
                @unlink($full);
            }
        }

        $video->delete();
        return redirect()->route('admin.videos.index')->with([
            'message' => 'تم حذف الفيديو بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function fetchYouTubeData(Request $request)
    {
        $request->validate(['url' => 'required|url']);

        $watchUrl = $request->url;
        $videoID = $this->getYoutubeID($watchUrl);
        if (!$videoID) {
            return response()->json(['success' => false, 'message' => 'رابط يوتيوب غير صالح.']);
        }

        try {
            $info = $this->getYoutubeInfo("https://www.youtube.com/watch?v={$videoID}");
        } catch (\Throwable $e) {
            Log::warning('YouTube oEmbed failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'فشل الاتصال بمصدر البيانات. حاول لاحقاً.']);
        }

        if ($info) {
            $thumbUrl = $info['thumbnail_url'] ?? null;

            return response()->json([
                'success'     => true,
                'title'       => $info['title'] ?? null,
                'description' => $info['title'] ?? null,
                'thumbnail'   => $thumbUrl,
                'local_thumbnail' => null,
                'author_name' => $info['author_name'] ?? null,
                'html'        => $info['html'] ?? null,
                'youtube_id'  => $videoID,
                'watch_url'   => $watchUrl,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'لم يتم العثور على معلومات الفيديو.']);
    }

    private function getYoutubeInfo($url)
    {
        $oembedUrl = "https://www.youtube.com/oembed?url=" . urlencode($url) . "&format=json";
        $response = Http::timeout(6)->get($oembedUrl);
        return $response->successful() ? $response->json() : null;
    }

    private function getYoutubeID(string $url)
    {
        $url = trim($url);
        if ($url === '') {
            return false;
        }
        $parts = @parse_url($url);
        if ($parts === false) {
            return false;
        }

        if (! empty($parts['host']) && str_contains($parts['host'], 'youtu.be')) {
            $path = $parts['path'] ?? '';
            $id = trim($path, '/');
            $id = preg_replace('/[^0-9A-Za-z_-]/', '', $id);
            return $id ?: false;
        }
        if (! empty($parts['host']) && str_contains($parts['host'], 'youtube.com')) {
            if (! empty($parts['query'])) {
                parse_str($parts['query'], $query);
                if (! empty($query['v'])) {
                    return preg_replace('/[^0-9A-Za-z_-]/', '', $query['v']);
                }
            }
            if (! empty($parts['path'])) {
                $segments = explode('/', trim($parts['path'], '/'));
                $candidate = end($segments);
                $candidate = preg_replace('/[^0-9A-Za-z_-]/', '', $candidate);
                if ($candidate !== '') {
                    return $candidate;
                }
            }
        }
        if (preg_match('/([0-9A-Za-z_-]{11})/', $url, $m)) {
            return $m[1];
        }
        return false;
    }

    private function saveRemoteImage(?string $url, string $folder = 'upload')
    {
        if (empty($url)) {
            return null;
        }

        try {
            $response = Http::timeout(10)->get($url);
            if (!$response->successful()) {
                return null;
            }

            $content = $response->body();

             $ext = null;
            $pathInfo = pathinfo(parse_url($url, PHP_URL_PATH) ?? '');
            if (!empty($pathInfo['extension'])) {
                $ext = strtolower($pathInfo['extension']);
                if ($ext === 'jpeg') $ext = 'jpg';
            } else {
                $ct = $response->header('Content-Type');
                if ($ct) {
                    if (str_contains($ct, 'jpeg')) $ext = 'jpg';
                    elseif (str_contains($ct, 'png')) $ext = 'png';
                    elseif (str_contains($ct, 'gif')) $ext = 'gif';
                }
            }
            $ext = $ext ?: 'jpg';

             $hash = sha1($content);
            $filename = $hash . '.' . $ext;

             $folder = trim($folder, '/');
            $fullDir = public_path($folder);
            if (! is_dir($fullDir)) {
                mkdir($fullDir, 0755, true);
            }

            $fullPath = $fullDir . DIRECTORY_SEPARATOR . $filename;
            $relativePath = $folder . '/' . $filename;
            if (! file_exists($fullPath)) {
                file_put_contents($fullPath, $content);
                @chmod($fullPath, 0644);
            }

            return $relativePath;
        } catch (\Throwable $e) {
            Log::warning('saveRemoteImage failed: ' . $e->getMessage());
            return null;
        }
    }

    public function toggleStatus(Request $request)
    {
        if (! $request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'طلب غير صالح.'], 400);
        }
        $request->validate([
            'video_id' => 'required|integer|exists:videos,id',
        ]);
        $video = Video::findOrFail($request->video_id);
        $video->status = ! $video->status;
        $video->save();
        return response()->json([
            'status'     => 'success',
            'message'    => 'تم تحديث الحالة بنجاح.',
            'new_status' => (bool) $video->status,
            'video_id'   => $video->id,
        ]);
    }
}