<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CategoryRequest; // يفترض أنه موجود، سأضع مثالًا أدناه
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VideoCategoryController extends Controller
{
    protected $section = 1;
    protected ImageManager $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_categories, show_categories')) {
            return redirect('admin/index');
        }

        $page_categories = Category::with('creator')
            ->where('section', $this->section)
            ->when(request()->keyword, function ($query) {
                $keyword = request()->keyword;
                $query->where('title', 'like', "%{$keyword}%");
            })
            ->when(request()->status !== null, function ($query) {
                $query->where('status', request()->status);
            })
            // فلترة المميّز لو مرّت في الريكوست
            ->when(request()->featured !== null, function ($query) {
                $query->where('featured', request()->featured);
            })
            ->orderBy(request()->sort_by ?? 'created_at', request()->order_by ?? 'desc')
            ->paginate(request()->limit_by ?? 5);

        return view('backend.video_categories.index', compact('page_categories'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_categories')) {
            return redirect('admin/index');
        }
        return view('backend.video_categories.create');
    }

    public function store(CategoryRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_categories')) {
            return redirect('admin/index');
        }

        $input = $request->validated();

        if ($request->hasFile('img')) {
            $uploaded = $request->file('img');
            $fileName = 'video_category_' . time() . '.' . $uploaded->getClientOriginalExtension();
            $path = public_path('assets/video_categories/' . $fileName);
            $image = $this->imageManager->read($uploaded->getRealPath());
            $image->scale(width: 800);
            $image->save($path, quality: 90);
            $input['img'] = $fileName;
        }

        $input['section'] = $this->section;
        $input['created_by'] = auth()->id();
        $input['published_on'] = isset($input['published_on']) ? Carbon::parse($input['published_on'])->format('Y-m-d H:i:s') : now();
        // ✅ حفظ قيمة الميزة (featured)
        $input['featured'] = $request->boolean('featured');

        Category::create($input);

        return redirect()->route('admin.video_categories.index')->with([
            'message' => 'تم إنشاء التصنيف بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function edit($id)
    {
        if (!auth()->user()->ability('admin', 'update_categories')) {
            return redirect('admin/index');
        }

        $category = Category::where('id', $id)
            ->where('section', $this->section)
            ->firstOrFail();

        return view('backend.video_categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        if (!auth()->user()->ability('admin', 'update_categories')) {
            return redirect('admin/index');
        }

        $category = Category::where('id', $id)
            ->where('section', $this->section)
            ->firstOrFail();

        $input = $request->validated();

        if ($request->hasFile('img')) {
            if ($category->img && File::exists(public_path('assets/video_categories/' . $category->img))) {
                File::delete(public_path('assets/video_categories/' . $category->img));
            }
            $uploaded = $request->file('img');
            $fileName = 'video_category_' . time() . '.' . $uploaded->getClientOriginalExtension();
            $path = public_path('assets/video_categories/' . $fileName);
            $image = $this->imageManager->read($uploaded->getRealPath());
            $image->scale(width: 800);
            $image->save($path, quality: 90);
            $input['img'] = $fileName;
        } else {
            unset($input['img']);
        }

        $input['section'] = $this->section;
        $input['updated_by'] = auth()->id();
        $input['published_on'] = isset($input['published_on']) ? Carbon::parse($input['published_on'])->format('Y-m-d H:i:s') : $category->published_on;
        // ✅ تحديث قيمة الميزة
        $input['featured'] = $request->boolean('featured');

        $category->update($input);

        return redirect()->route('admin.video_categories.index')->with([
            'message' => 'تم تحديث التصنيف بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_categories')) {
            return redirect('admin/index');
        }

        $category = Category::where('id', $id)
            ->where('section', $this->section)
            ->firstOrFail();

        if ($category->img && File::exists(public_path('assets/video_categories/' . $category->img))) {
            File::delete(public_path('assets/video_categories/' . $category->img));
        }

        $category->delete();

        return redirect()->route('admin.video_categories.index')->with([
            'message' => 'تم حذف التصنيف بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function toggleStatus(Request $request)
    {
        if ($request->ajax()) {
            $category = Category::where('id', $request->category_id)
                ->where('section', $this->section)
                ->firstOrFail();
            $category->status = !$category->status;
            $category->save();
            return response()->json([
                'status' => $category->status,
                'category_id' => $category->id,
            ]);
        }
    }

    // ✅ توجل الميّز (AJAX)
    public function toggleFeatured(Request $request)
    {
        // صلاحية سريعة: منعه لو ليس لديه الحق
        if (! auth()->user() || ! auth()->user()->ability('admin', 'update_categories')) {
            return response()->json(['error' => 'غير مصرح'], 403);
        }

        $request->validate(['category_id' => 'required|integer|exists:categories,id']);

        try {
            $category = Category::where('id', $request->category_id)
                ->where('section', $this->section)
                ->firstOrFail();

            $category->featured = !$category->featured;
            $category->save();

            return response()->json([
                'featured' => (int) $category->featured,
                'category_id' => $category->id,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'التصنيف غير موجود أو ليس ضمن هذا القسم'], 404);
        } catch (\Throwable $e) {
            \Log::error('VideoCategory toggleFeatured error: '.$e->getMessage());
            return response()->json(['error' => 'خطأ في الخادم'], 500);
        }
    }

    public function remove_image(Request $request)
    {
        $user = auth()->user();
        if (! $user->ability(['admin'], ['delete_video_categories'], ['validate_all' => false])) {
            abort(403);
        }
        $category = Category::find($request->key);
        if (!$category) {
            return response()->json(['error' => 'Not found'], 404);
        }
        if ($category->img && File::exists(public_path('assets/video_categories/' . $category->img))) {
            File::delete(public_path('assets/video_categories/' . $category->img));
            $category->img = null;
            $category->save();
        }
        return response()->json(['success' => true]);
    }
}