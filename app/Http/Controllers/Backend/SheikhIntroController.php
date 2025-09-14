<?php

namespace App\Http\Controllers\Backend;

use App\Models\SheikhIntro;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\Backend\SheikhIntroRequest;

class SheikhIntroController extends Controller
{
    protected $imageManager;
    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    public function index(Request $request)
    {
        if (!auth()->user()->ability('admin', 'manage_sheikh_intro,show_sheikh_intro')) {
            return redirect('admin/index');
        }

        $intros = SheikhIntro::when($request->keyword, fn($q) => $q->where('title', 'like', '%'.$request->keyword.'%'))
            ->when($request->status !== null, fn($q) => $q->where('status', $request->status))
            ->orderBy($request->sort_by ?? 'created_at', $request->order_by ?? 'desc')
            ->paginate($request->limit_by ?? 10);

        return view('backend.sheikh_intro.index', compact('intros'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_sheikh_intro')) {
            return redirect('admin/index');
        }
        return view('backend.sheikh_intro.create');
    }

    public function store(SheikhIntroRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_sheikh_intro')) {
            return redirect('admin/index');
        }

        $intro = new SheikhIntro();
        $intro->title = $request->title;
        $intro->slug = Str::slug($request->title);
        $intro->description = $request->description;
        $intro->status = $request->status;
        $intro->meta_keywords = $request->meta_keywords;
        $intro->meta_description = $request->meta_description;
        $intro->meta_slug = $request->meta_slug;
        $intro->published_on = $request->published_on;

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = 'sheikh_intro_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/sheikh_intro/images/' . $imageName);
            $this->imageManager
                ->read($image->getRealPath())
                ->scale(width: 800)
                ->save($imagePath, quality: 90);
            $intro->img = $imageName;
        }

        $intro->save();

        return redirect()->route('admin.sheikh_intro.index')->with([
            'message' => 'تم إضافة النبذة بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function edit($id)
    {
        if (!auth()->user()->ability('admin', 'update_sheikh_intro')) {
            return redirect('admin/index');
        }

        $intro = SheikhIntro::findOrFail($id);
        return view('backend.sheikh_intro.edit', compact('intro'));
    }

    public function update(SheikhIntroRequest $request, $id)
    {
        if (!auth()->user()->ability('admin', 'update_sheikh_intro')) {
            return redirect('admin/index');
        }

        $intro = SheikhIntro::findOrFail($id);
        $intro->title = $request->title;
        $intro->slug = Str::slug($request->title);
        $intro->description = $request->description;
        $intro->status = $request->status;
        $intro->meta_keywords = $request->meta_keywords;
        $intro->meta_description = $request->meta_description;
        $intro->meta_slug = $request->meta_slug;
        $intro->published_on = $request->published_on;

        if ($request->hasFile('img')) {
            $oldImagePath = public_path('assets/sheikh_intro/images/' . $intro->img);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
            $image = $request->file('img');
            $imageName = 'sheikh_intro_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/sheikh_intro/images/' . $imageName);
            $this->imageManager
                ->read($image->getRealPath())
                ->scale(width: 800)
                ->save($imagePath, quality: 90);
            $intro->img = $imageName;
        }

        $intro->save();

        return redirect()->route('admin.sheikh_intro.index')->with([
            'message' => 'تم تحديث النبذة بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_sheikh_intro')) {
            return redirect('admin/index');
        }

        $intro = SheikhIntro::findOrFail($id);
        if ($intro->img) {
            $imagePath = public_path('assets/sheikh_intro/images/' . $intro->img);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $intro->delete();

        return redirect()->route('admin.sheikh_intro.index')->with('success', 'تم حذف النبذة بنجاح');
    }

    public function remove_image(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_sheikh_intro')) {
            return response()->json(['status' => false, 'message' => 'ليس لديك صلاحية']);
        }

        $intro = SheikhIntro::findOrFail($request->id);
        $imagePath = public_path('assets/sheikh_intro/images/' . $intro->img);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
            $intro->img = null;
            $intro->save();
        }

        return response()->json(['status' => true, 'message' => 'تم حذف الصورة']);
    }

    public function toggleStatus(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'intro_id' => 'required|integer|exists:sheikh_intro,id',
            ]);

            $intro = SheikhIntro::findOrFail($request->intro_id);
            $intro->status = !$intro->status;
            $intro->save();

            return response()->json([
                'status' => $intro->status,
                'intro_id' => $intro->id,
            ]);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }
}
