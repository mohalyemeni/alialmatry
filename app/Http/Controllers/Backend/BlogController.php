<?php

namespace App\Http\Controllers\Backend;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\Backend\BlogRequest;

class BlogController extends Controller
{
    protected $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    public function index(Request $request)
    {
        if (!auth()->user()->ability('admin', 'manage_blogs,show_blogs')) {
            return redirect('admin/index');
        }

        $blogs = Blog::with('category')
            ->when($request->keyword, fn($q) => $q->where('title', 'like', '%'.$request->keyword.'%'))
            ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
            ->when($request->status !== null, fn($q) => $q->where('status', $request->status))
            ->orderBy($request->sort_by ?? 'created_at', $request->order_by ?? 'desc')
            ->paginate($request->limit_by ?? 10);

        $categories = Category::where('status', 1)
            ->where('section', Category::SECTION_ARTICLE)
            ->get();

        return view('backend.blogs.index', compact('blogs', 'categories'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_blog')) {
            return redirect('admin/index');
        }

        $categories = Category::where('status', 1)
            ->where('section', Category::SECTION_ARTICLE)
            ->get();

        return view('backend.blogs.create', compact('categories'));
    }

    public function store(BlogRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_blog')) {
            return redirect('admin/index');
        }

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->description;
        $blog->category_id = $request->category_id;
        $blog->status = $request->status;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->meta_description = $request->meta_description;
        $blog->meta_slug = $request->meta_slug;
        $blog->published_on = $request->published_on;

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = 'blog_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/blogs/images/' . $imageName);
            $this->imageManager
                ->read($image->getRealPath())
                ->scale(width: 800)
                ->save($imagePath, quality: 90);
            $blog->img = $imageName;
        }

        $blog->save();

        return redirect()->route('admin.blogs.index')->with([
            'message' => 'تم إضافة المقال بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function edit($id)
    {
        if (!auth()->user()->ability('admin', 'update_blog')) {
            return redirect('admin/index');
        }

        $blog = Blog::findOrFail($id);

        $categories = Category::where('status', 1)
            ->where('section', Category::SECTION_ARTICLE)
            ->get();

        return view('backend.blogs.edit', compact('blog', 'categories'));
    }

    public function update(BlogRequest $request, $id)
    {
        if (!auth()->user()->ability('admin', 'update_blog')) {
            return redirect('admin/index');
        }

        $blog = Blog::findOrFail($id);
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->description;
        $blog->category_id = $request->category_id;
        $blog->status = $request->status;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->meta_description = $request->meta_description;
        $blog->meta_slug = $request->meta_slug;
        $blog->published_on = $request->published_on;

        if ($request->hasFile('img')) {
            $oldImagePath = public_path('assets/blogs/images/' . $blog->img);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            $image = $request->file('img');
            $imageName = 'blog_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/blogs/images/' . $imageName);
            $this->imageManager
                ->read($image->getRealPath())
                ->scale(width: 800)
                ->save($imagePath, quality: 90);

            $blog->img = $imageName;
        }

        $blog->save();

        return redirect()->route('admin.blogs.index')->with([
            'message' => 'تم تحديث المقال بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_blog')) {
            return redirect('admin/index');
        }

        $blog = Blog::findOrFail($id);

        if ($blog->img) {
            $imagePath = public_path('assets/blogs/images/' . $blog->img);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'تم حذف المقال بنجاح');
    }

    public function remove_image(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_blog')) {
            return response()->json(['status' => false, 'message' => 'ليس لديك صلاحية']);
        }

        $blog = Blog::findOrFail($request->id);
        $imagePath = public_path('assets/blogs/images/' . $blog->img);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
            $blog->img = null;
            $blog->save();
        }

        return response()->json(['status' => true, 'message' => 'تم حذف الصورة']);
    }

    public function toggleStatus(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'blog_id' => 'required|integer|exists:blogs,id',
            ]);

            $blog = Blog::findOrFail($request->blog_id);
            $blog->status = !$blog->status;
            $blog->save();

            return response()->json([
                'status' => $blog->status,
                'blog_id' => $blog->id,
            ]);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }
}
