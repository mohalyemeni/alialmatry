<?php

namespace App\Http\Controllers\Backend;

use App\Models\SheikhPage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\Backend\SheikhPageRequest;

class SheikhPageController extends Controller
{
    protected $imageManager;
    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }
    public function index(Request $request)
    {
        if (!auth()->user()->ability('admin', 'manage_sheikh_pages,show_sheikh_pages')) {
            return redirect('admin/index');
        }
        $pages = SheikhPage::when($request->keyword, fn($q) => $q->where('title', 'like', '%'.$request->keyword.'%'))
            ->when($request->status !== null, fn($q) => $q->where('status', $request->status))
            ->orderBy($request->sort_by ?? 'created_at', $request->order_by ?? 'desc')
            ->paginate($request->limit_by ?? 10);
        return view('backend.sheikh_pages.index', compact('pages'));
    }
    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_sheikh_page')) {
            return redirect('admin/index');
        }
        return view('backend.sheikh_pages.create');
    }
    public function store(SheikhPageRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_sheikh_page')) {
            return redirect('admin/index');
        }
        $page = new SheikhPage();
        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->description = $request->description;
        $page->status = $request->status;
        $page->meta_keywords = $request->meta_keywords;
        $page->meta_description = $request->meta_description;
        $page->meta_slug = $request->meta_slug;
        $page->published_on = $request->published_on;
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = 'sheikh_page_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/sheikh_pages/images/' . $imageName);
            $this->imageManager
                ->read($image->getRealPath())
                ->scale(width: 800)
                ->save($imagePath, quality: 90);
            $page->img = $imageName;
        }
        $page->save();
        return redirect()->route('admin.sheikh_pages.index')->with([
            'message' => 'تم إضافة الصفحة بنجاح',
            'alert-type' => 'success',
        ]);
    }
    public function edit($id)
    {
        if (!auth()->user()->ability('admin', 'update_sheikh_page')) {
            return redirect('admin/index');
        }
        $sheikhPage = SheikhPage::findOrFail($id);
        return view('backend.sheikh_pages.edit', compact('sheikhPage'));
    }
    public function update(SheikhPageRequest $request, $id)
    {
        if (!auth()->user()->ability('admin', 'update_sheikh_page')) {
            return redirect('admin/index');
        }
        $page = SheikhPage::findOrFail($id);
        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->description = $request->description;
        $page->status = $request->status;
        $page->meta_keywords = $request->meta_keywords;
        $page->meta_description = $request->meta_description;
        $page->meta_slug = $request->meta_slug;
        $page->published_on = $request->published_on;
        if ($request->hasFile('img')) {
            $oldImagePath = public_path('assets/sheikh_pages/images/' . $page->img);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
            $image = $request->file('img');
            $imageName = 'sheikh_page_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/sheikh_pages/images/' . $imageName);
            $this->imageManager
                ->read($image->getRealPath())
                ->scale(width: 800)
                ->save($imagePath, quality: 90);
            $page->img = $imageName;
        }
        $page->save();
        return redirect()->route('admin.sheikh_pages.index')->with([
            'message' => 'تم تحديث الصفحة بنجاح',
            'alert-type' => 'success',
        ]);
    }
    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_sheikh_page')) {
            return redirect('admin/index');
        }
        $page = SheikhPage::findOrFail($id);
        if ($page->img) {
            $imagePath = public_path('assets/sheikh_pages/images/' . $page->img);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $page->delete();
        return redirect()->route('admin.sheikh_pages.index')->with('success', 'تم حذف الصفحة بنجاح');
    }
    public function remove_image(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_sheikh_page')) {
            return response()->json(['status' => false, 'message' => 'ليس لديك صلاحية']);
        }
        $page = SheikhPage::findOrFail($request->id);
        $imagePath = public_path('assets/sheikh_pages/images/' . $page->img);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
            $page->img = null;
            $page->save();
        }
        return response()->json(['status' => true, 'message' => 'تم حذف الصورة']);
    }
    public function toggleStatus(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'page_id' => 'required|integer|exists:sheikh_pages,id',
            ]);
            $page = SheikhPage::findOrFail($request->page_id);
            $page->status = !$page->status;
            $page->save();
            return response()->json([
                'status' => $page->status,
                'page_id' => $page->id,
            ]);
        }
        return response()->json(['error' => 'Invalid request'], 400);
    }
}