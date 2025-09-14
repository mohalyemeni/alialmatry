<?php

namespace App\Http\Controllers\Backend;

use App\Models\Audio;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\Backend\AudioRequest;

class AudioController extends Controller
{
    protected $imageManager;
    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }


    public function index(Request $request)
    {
        if (!auth()->user()->ability('admin', 'manage_audios,show_audios')) {
            return redirect('admin/index');
        }
        $audios = Audio::with('category')
            ->when($request->keyword, fn($q) => $q->where('title', 'like', '%'.$request->keyword.'%'))
            ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
            ->when($request->status !== null, fn($q) => $q->where('status', $request->status))
            ->orderBy($request->sort_by ?? 'created_at', $request->order_by ?? 'desc')
            ->paginate($request->limit_by ?? 10);
        $categories = Category::where('status', 1)
            ->where('section', Category::SECTION_AUDIO)
            ->get();
        return view('backend.audio.index', compact('audios', 'categories'));
    }


    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_audios')) {
            return redirect('admin/index');
        }
       $categories = Category::where('status', 1)
            ->where('section', Category::SECTION_AUDIO)
            ->get();

        return view('backend.audio.create', compact('categories'));
    }
    public function store(AudioRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_audios')) {
            return redirect('admin/index');
        }
        $audio = new Audio();
        $audio->title = $request->title;
        $audio->slug = Str::slug($request->title);
        $audio->description = $request->description;
        $audio->category_id = $request->category_id;
        $audio->status = $request->status;
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = 'audio_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/audios/images/' . $imageName);
            $this->imageManager
                ->read($image->getRealPath())
                ->scale(width: 800)
                ->save($imagePath, quality: 90);
            $audio->img = $imageName;
        }
        if ($request->hasFile('audio_file')) {
            $file = $request->file('audio_file');
            $fileName = 'audio_file_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/audios/files'), $fileName);
            $audio->audio_file = $fileName;
        }
        $audio->save();
          return redirect()->route('admin.audios.index')->with([
            'message' => 'تم اضافة دليل الصوت بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function edit($id)
    {
        if (!auth()->user()->ability('admin', 'update_audios')) {
            return redirect('admin/index');
        }
        $audio = Audio::findOrFail($id);

        $categories = Category::where('status', 1)
            ->where('section', Category::SECTION_AUDIO)
            ->get();
        return view('backend.audio.edit', compact('audio', 'categories'));
    }

    public function update(AudioRequest $request, $id)
    {
        if (!auth()->user()->ability('admin', 'update_audios')) {
            return redirect('admin/index');
        }
        $audio = Audio::findOrFail($id);
        $audio->title = $request->title;
        $audio->slug = Str::slug($request->title);
        $audio->description = $request->description;
        $audio->category_id = $request->category_id;
        $audio->status = $request->status;
        if ($request->hasFile('img')) {
            $oldImagePath = public_path('assets/audios/images/' . $audio->img);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
            $image = $request->file('img');
            $imageName = 'audio_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/audios/images/' . $imageName);
            $this->imageManager
                ->read($image->getRealPath())
                ->scale(width: 800)
                ->save($imagePath, quality: 90);
            $audio->img = $imageName;
        }
        if ($request->hasFile('audio_file')) {
            $oldFilePath = public_path('assets/audios/files/' . $audio->audio_file);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
            $file = $request->file('audio_file');
            $fileName = 'audio_file_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/audios/files'), $fileName);
            $audio->audio_file = $fileName;
        }
        $audio->save();
         return redirect()->route('admin.audios.index')->with([
            'message' => 'تم تحديث دليل الصوت بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_audios')) {
            return redirect('admin/index');
        }
        $audio = Audio::findOrFail($id);
        if ($audio->img) {
            $imagePath = public_path('assets/audios/images/' . $audio->img);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        if ($audio->audio_file) {
            $filePath = public_path('assets/audios/files/' . $audio->audio_file);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
        $audio->delete();
        return redirect()->route('admin.audios.index')->with('success', 'تم حذف الصوت بنجاح');
    }


    public function remove_image(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_audios')) {
            return response()->json(['status' => false, 'message' => 'ليس لديك صلاحية']);
        }
        $audio = Audio::findOrFail($request->id);
        $imagePath = public_path('assets/audios/images/' . $audio->img);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
            $audio->img = null;
            $audio->save();
        }
        return response()->json(['status' => true, 'message' => 'تم حذف الصورة']);
    }
        public function remove_audio(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_audios')) {
            return response()->json(['status' => false, 'message' => 'ليس لديك صلاحية']);
        }
        $audio = Audio::findOrFail($request->id);
        $filePath = public_path('assets/audios/files/' . $audio->audio_file);
        if (File::exists($filePath)) {
            File::delete($filePath);
            $audio->audio_file = null;
            $audio->save();
        }
        return response()->json(['status' => true, 'message' => 'تم حذف ملف الصوت']);
    }
    public function toggleStatus(Request $request)
{
    if ($request->ajax()) {
        $request->validate([
            'audio_id' => 'required|integer|exists:audios,id',
        ]);
        $audio = Audio::findOrFail($request->audio_id);
        $audio->status = !$audio->status;
        $audio->save();
        return response()->json([
            'status' => $audio->status,
            'audio_id' => $audio->id,
        ]);
    }
    return response()->json(['error' => 'Invalid request'], 400);
}
}