<?php

namespace App\Http\Controllers\Backend;

use App\Models\DurarDiniya;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\Backend\DurarDiniyaRequest;

class DurarDiniyaController extends Controller
{
    protected $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    public function index(Request $request)
    {
        if (!auth()->user()->ability('admin', 'manage_durar_diniya,show_durar_diniya')) {
            return redirect('admin/index');
        }

        $durars = DurarDiniya::query()
            ->when($request->keyword, fn($q) => $q->where('title', 'like', '%'.$request->keyword.'%'))
            ->when($request->status !== null, fn($q) => $q->where('status', $request->status))
            ->orderBy($request->sort_by ?? 'created_at', $request->order_by ?? 'desc')
            ->paginate($request->limit_by ?? 10);

        return view('backend.durar_diniya.index', compact('durars'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_durar_diniya')) {
            return redirect('admin/index');
        }

        return view('backend.durar_diniya.create');
    }

    public function store(DurarDiniyaRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_durar_diniya')) {
            return redirect('admin/index');
        }

        $item = new DurarDiniya();
        $item->title = $request->title;
        $item->slug = Str::slug($request->title);
        $item->description = $request->description;
        $item->status = $request->status;
        $item->meta_keywords = $request->meta_keywords;
        $item->meta_description = $request->meta_description;
        $item->meta_slug = $request->meta_slug;
        $item->published_on = $request->published_on;

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = 'durar_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/durar_diniya/images/' . $imageName);
            $this->imageManager
                ->read($image->getRealPath())
                ->scale(width: 800)
                ->save($imagePath, quality: 90);
            $item->img = $imageName;
        }

        $item->save();

        return redirect()->route('admin.durar_diniya.index')->with([
            'message' => 'تم إضافة الدرة الدينية بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function edit($id)
    {
        if (!auth()->user()->ability('admin', 'update_durar_diniya')) {
            return redirect('admin/index');
        }

        $item = DurarDiniya::findOrFail($id);

        return view('backend.durar_diniya.edit', compact('item'));
    }

    public function update(DurarDiniyaRequest $request, $id)
    {
        if (!auth()->user()->ability('admin', 'update_durar_diniya')) {
            return redirect('admin/index');
        }

        $item = DurarDiniya::findOrFail($id);
        $item->title = $request->title;
        $item->slug = Str::slug($request->title);
        $item->description = $request->description;
        $item->status = $request->status;
        $item->meta_keywords = $request->meta_keywords;
        $item->meta_description = $request->meta_description;
        $item->meta_slug = $request->meta_slug;
        $item->published_on = $request->published_on;

        if ($request->hasFile('img')) {
            $oldImagePath = public_path('assets/durar_diniya/images/' . $item->img);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            $image = $request->file('img');
            $imageName = 'durar_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/durar_diniya/images/' . $imageName);
            $this->imageManager
                ->read($image->getRealPath())
                ->scale(width: 800)
                ->save($imagePath, quality: 90);

            $item->img = $imageName;
        }

        $item->save();

        return redirect()->route('admin.durar_diniya.index')->with([
            'message' => 'تم تحديث الدرة الدينية بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_durar_diniya')) {
            return redirect('admin/index');
        }

        $item = DurarDiniya::findOrFail($id);

        if ($item->img) {
            $imagePath = public_path('assets/durar_diniya/images/' . $item->img);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $item->delete();

        return redirect()->route('admin.durar_diniya.index')->with('success', 'تم حذف الدرة بنجاح');
    }

    public function remove_image(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_durar_diniya')) {
            return response()->json(['status' => false, 'message' => 'ليس لديك صلاحية']);
        }

        $item = DurarDiniya::findOrFail($request->id);
        $imagePath = public_path('assets/durar_diniya/images/' . $item->img);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
            $item->img = null;
            $item->save();
        }

        return response()->json(['status' => true, 'message' => 'تم حذف الصورة']);
    }

    public function toggleStatus(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'durar_id' => 'required|integer|exists:durar_diniya,id',
            ]);

            $item = DurarDiniya::findOrFail($request->durar_id);
            $item->status = !$item->status;
            $item->save();

            return response()->json([
                'status' => $item->status,
                'durar_diniya_id' => $item->id,
            ]);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }
}