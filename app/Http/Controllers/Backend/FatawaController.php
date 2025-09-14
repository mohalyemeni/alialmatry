<?php

namespace App\Http\Controllers\Backend;

use App\Models\Fatwa;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\Backend\FatwaContentRequest;

class FatawaController extends Controller
{
    protected $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    public function index(Request $request)
    {
        if (!auth()->user()->ability('admin', 'manage_fatawa,show_fatawa')) {
            return redirect('admin/index');
        }

        $fatawa = Fatwa::with('category')
            ->when($request->keyword, fn($q) => $q->where('title', 'like', '%'.$request->keyword.'%'))
            ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
            ->when($request->status !== null, fn($q) => $q->where('status', $request->status))
            ->orderBy($request->sort_by ?? 'created_at', $request->order_by ?? 'desc')
            ->paginate($request->limit_by ?? 10);

        $categories = Category::where('status', 1)
            ->where('section', Category::SECTION_FATWA)
            ->get();

        return view('backend.fatawa.index', compact('fatawa', 'categories'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_fatawa')) {
            return redirect('admin/index');
        }

        $categories = Category::where('status', 1)
            ->where('section', Category::SECTION_FATWA)
            ->get();

        return view('backend.fatawa.create', compact('categories'));
    }

    public function store(FatwaContentRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_fatawa')) {
            return redirect('admin/index');
        }

        $fatwa = new Fatwa();
        $fatwa->title = $request->title;
        $fatwa->slug = Str::slug($request->title);
        $fatwa->description = $request->description;
        $fatwa->category_id = $request->category_id;
        $fatwa->status = $request->status;

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = 'fatwa_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/fatawa/images/' . $imageName);
            $this->imageManager
                ->read($image->getRealPath())
                ->scale(width: 800)
                ->save($imagePath, quality: 90);
            $fatwa->img = $imageName;
        }

        if ($request->hasFile('audio_file')) {
            $file = $request->file('audio_file');
            $fileName = 'fatwa_audio_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/fatawa/files'), $fileName);
            $fatwa->audio_file = $fileName;
        }

        $fatwa->save();

        return redirect()->route('admin.fatawa.index')->with([
            'message' => 'تم إضافة الفتوى بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function edit($id)
    {
        if (!auth()->user()->ability('admin', 'update_fatawa')) {
            return redirect('admin/index');
        }

        $fatwa = Fatwa::findOrFail($id);

        $categories = Category::where('status', 1)
            ->where('section', Category::SECTION_FATWA)
            ->get();

        return view('backend.fatawa.edit', compact('fatwa', 'categories'));
    }

    public function update(FatwaContentRequest $request, $id)
    {
        if (!auth()->user()->ability('admin', 'update_fatawa')) {
            return redirect('admin/index');
        }

        $fatwa = Fatwa::findOrFail($id);
        $fatwa->title = $request->title;
        $fatwa->slug = Str::slug($request->title);
        $fatwa->description = $request->description;
        $fatwa->category_id = $request->category_id;
        $fatwa->status = $request->status;

        if ($request->hasFile('img')) {
            $oldImagePath = public_path('assets/fatawa/images/' . $fatwa->img);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            $image = $request->file('img');
            $imageName = 'fatwa_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/fatawa/images/' . $imageName);
            $this->imageManager
                ->read($image->getRealPath())
                ->scale(width: 800)
                ->save($imagePath, quality: 90);

            $fatwa->img = $imageName;
        }

        if ($request->hasFile('audio_file')) {
            $oldFilePath = public_path('assets/fatawa/files/' . $fatwa->audio_file);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }

            $file = $request->file('audio_file');
            $fileName = 'fatwa_audio_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/fatawa/files'), $fileName);
            $fatwa->audio_file = $fileName;
        }

        $fatwa->save();

        return redirect()->route('admin.fatawa.index')->with([
            'message' => 'تم تحديث الفتوى بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_fatawa')) {
            return redirect('admin/index');
        }

        $fatwa = Fatwa::findOrFail($id);

        if ($fatwa->img) {
            $imagePath = public_path('assets/fatawa/images/' . $fatwa->img);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if ($fatwa->audio_file) {
            $filePath = public_path('assets/fatawa/files/' . $fatwa->audio_file);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $fatwa->delete();

        return redirect()->route('admin.fatawa.index')->with('success', 'تم حذف الفتوى بنجاح');
    }

    public function remove_image(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_fatawa')) {
            return response()->json(['status' => false, 'message' => 'ليس لديك صلاحية']);
        }

        $fatwa = Fatwa::findOrFail($request->id);
        $imagePath = public_path('assets/fatawa/images/' . $fatwa->img);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
            $fatwa->img = null;
            $fatwa->save();
        }

        return response()->json(['status' => true, 'message' => 'تم حذف الصورة']);
    }

    public function remove_audio(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_fatawa')) {
            return response()->json(['status' => false, 'message' => 'ليس لديك صلاحية']);
        }

        $fatwa = Fatwa::findOrFail($request->id);
        $filePath = public_path('assets/fatawa/files/' . $fatwa->audio_file);

        if (File::exists($filePath)) {
            File::delete($filePath);
            $fatwa->audio_file = null;
            $fatwa->save();
        }

        return response()->json(['status' => true, 'message' => 'تم حذف ملف الصوت']);
    }

    public function toggleStatus(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'fatwa_id' => 'required|integer|exists:fatawa,id',
            ]);

            $fatwa = Fatwa::findOrFail($request->fatwa_id);
            $fatwa->status = !$fatwa->status;
            $fatwa->save();

            return response()->json([
                'status' => $fatwa->status,
                'fatwa_id' => $fatwa->id,
            ]);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }
}