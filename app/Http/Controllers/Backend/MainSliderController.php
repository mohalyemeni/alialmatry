<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\MainSliderRequest;
use App\Models\Slider;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MainSliderController extends Controller
{
    protected string $imagePath = 'assets/main_sliders/';

    public function index()
    {
        if (! auth()->user()->ability('admin', 'manage_main_sliders,show_main_sliders')) {
            return redirect('admin/index');
        }

        $mainSliders = Slider::MainSliders()
            ->when(request()->keyword != null, fn($q) => $q->search(request()->keyword))
            ->when(request()->status != null, fn($q) => $q->where('status', request()->status))
            ->orderByRaw(
                request()->sort_by == 'published_on'
                    ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
                    : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc')
            )
            ->paginate(request()->limit_by ?? 100);

        return view('backend.main_sliders.index', compact('mainSliders'));
    }

    public function create()
    {
        if (! auth()->user()->ability('admin', 'create_main_sliders')) {
            return redirect('admin/index');
        }

        return view('backend.main_sliders.create');
    }

    public function store(MainSliderRequest $request)
    {
        if (! auth()->user()->ability('admin', 'create_main_sliders')) {
            return redirect('admin/index');
        }

        $input = $this->prepareInput($request);

        $mainSlider = Slider::create($input);

        $this->handleImageUpload($request, $mainSlider);

        $mainSlider->save();

        return redirect()->route('admin.main_sliders.index')->with([
            'message' => __('panel.created_successfully'),
            'alert-type' => 'success'
        ]);
    }

    public function show($id)
    {
        if (! auth()->user()->ability('admin', 'display_sliders')) {
            return redirect('admin/index');
        }

        $mainSlider = Slider::findOrFail($id);
        return view('backend.main_sliders.show', compact('mainSlider'));
    }

    public function edit($id)
    {
        if (! auth()->user()->ability('admin', 'update_main_sliders')) {
            return redirect('admin/index');
        }

        $mainSlider = Slider::findOrFail($id);
        return view('backend.main_sliders.edit', compact('mainSlider'));
    }

    public function update(MainSliderRequest $request, $id)
    {
        if (! auth()->user()->ability('admin', 'update_main_sliders')) {
            return redirect('admin/index');
        }

        $mainSlider = Slider::findOrFail($id);

        $input = $this->prepareInput($request, $mainSlider);

        $this->handleImageReplacement($request, $mainSlider, $input);

        $mainSlider->update($input);

        return redirect()->route('admin.main_sliders.index')->with([
            'message' => __('panel.updated_successfully'),
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        if (! auth()->user()->ability('admin', 'delete_main_sliders')) {
            return redirect('admin/index');
        }

        $mainSlider = Slider::findOrFail($id);

        if ($mainSlider->img && File::exists(public_path($this->imagePath . $mainSlider->img))) {
            File::delete(public_path($this->imagePath . $mainSlider->img));
        }

        $mainSlider->delete();

        return redirect()->route('admin.main_sliders.index')->with([
            'message' => __('panel.deleted_successfully'),
            'alert-type' => 'success'
        ]);
    }

    public function remove_image(Request $request)
    {
        if (! auth()->user()->ability('admin', 'delete_main_sliders')) {
            return response()->json(['status' => false, 'message' => 'ليس لديك صلاحية'], 403);
        }

        $request->validate([
            'slider_id' => 'required|integer|exists:sliders,id',
        ]);

        $slider = Slider::findOrFail($request->slider_id);

        if ($slider->img && File::exists(public_path($this->imagePath . $slider->img))) {
            File::delete(public_path($this->imagePath . $slider->img));
        }

        $slider->img = null;
        $slider->save();

        return response()->json(['status' => true, 'message' => 'تم حذف الصورة']);
    }

    public function updateMainSliderStatus(Request $request)
    {
        if (! $request->ajax()) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        $data = $request->validate([
            'main_slider_id' => 'required|integer|exists:sliders,id',
            'status' => 'nullable'
        ]);

        $slider = Slider::findOrFail($data['main_slider_id']);
        $newStatus = ($data['status'] === "Active") ? 0 : 1;
        $slider->update(['status' => $newStatus]);

        return response()->json(['status' => $newStatus, 'main_slider_id' => $slider->id]);
    }

    protected function prepareInput(Request $request, Slider $existing = null): array
    {
        $input = [];

        $input['title'] = ['ar' => $request->input('title')];
        $input['subtitle'] = ['ar' => $request->input('subtitle')];
        $input['description'] = ['ar' => $request->input('description')];
        $input['btn_title'] = ['ar' => $request->input('btn_title')];
        $input['url'] = ['ar' => $request->input('url')];

        $input['show_btn_title'] = (bool) $request->input('show_btn_title', true);
        $input['target'] = $request->input('target', '_self');
        $input['section'] = (int) $request->input('section', 1);
        $input['show_info'] = (bool) $request->input('show_info', true);
        $input['status'] = (bool) $request->input('status', true);

        $input['created_by'] = $existing ? $existing->created_by : (auth()->user()->full_name ?? auth()->id());
        $input['updated_by'] = auth()->user()->full_name ?? auth()->id();

        $input['metadata_title'] = ['ar' => $request->input('metadata_title')];
        $input['metadata_description'] = ['ar' => $request->input('metadata_description')];
        $input['metadata_keywords'] = ['ar' => $request->input('metadata_keywords')];

        $published_on_raw = $request->input('published_on', null);
        if ($published_on_raw) {
            $published = null;

            try {
                $published = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $published_on_raw);
            } catch (\Exception $e) {
                try {
                    $normalized = str_replace(['ص', 'م'], ['AM', 'PM'], $published_on_raw);
                    $published = \Carbon\Carbon::createFromFormat('Y/m/d h:i A', $normalized);
                } catch (\Exception $e2) {
                    try {
                        $published = \Carbon\Carbon::parse($published_on_raw);
                    } catch (\Exception $e3) {
                        $published = null;
                    }
                }
            }

            $input['published_on'] = $published ? $published->format('Y-m-d H:i:s') : null;
        } else {
            $input['published_on'] = null;
        }

        return $input;
    }

    public function trans(string $field, string $locale = 'ar')
    {
        $val = $this->{$field} ?? null;
        if (is_array($val)) {
            return $val[$locale] ?? reset($val) ?? null;
        }
        return $val;
    }

    protected function handleImageUpload(Request $request, Slider $slider): void
    {
        if (! $request->hasFile('img') && ! $request->hasFile('image') && ! $request->hasFile('images')) {
            return;
        }

        $imageFile = null;
        if ($request->hasFile('img')) {
            $imageFile = $request->file('img');
        } elseif ($request->hasFile('image')) {
            $imageFile = $request->file('image');
        } else {
            $images = $request->file('images');
            if (is_array($images) && count($images) > 0) {
                $imageFile = $images[0];
            }
        }

        if (! $imageFile) {
            return;
        }

        $manager = new ImageManager(new Driver());

        $base = $slider->slug ?? uniqid('slider_');
        $file_name = $base . '_' . time() . '.' . $imageFile->getClientOriginalExtension();

        $img = $manager->read($imageFile);

        $destination = public_path($this->imagePath);
        if (! File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }
        $img->save($destination . $file_name);

        $slider->img = $file_name;
    }

    protected function handleImageReplacement(Request $request, Slider $slider, array &$input): void
    {
        if (! $request->hasFile('img') && ! $request->hasFile('image') && ! $request->hasFile('images')) {
            return;
        }

        if ($slider->img && File::exists(public_path($this->imagePath . $slider->img))) {
            File::delete(public_path($this->imagePath . $slider->img));
        }

        $imageFile = null;
        if ($request->hasFile('img')) {
            $imageFile = $request->file('img');
        } elseif ($request->hasFile('image')) {
            $imageFile = $request->file('image');
        } else {
            $images = $request->file('images');
            if (is_array($images) && count($images) > 0) {
                $imageFile = $images[0];
            }
        }

        if (! $imageFile) {
            return;
        }

        $manager = new ImageManager(new Driver());
        $file_name = ($slider->slug ?? 'slider') . '_' . time() . '.' . $imageFile->getClientOriginalExtension();
        $img = $manager->read($imageFile);
        $destination = public_path($this->imagePath);
        if (! File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }
        $img->save($destination . $file_name);

        $input['img'] = $file_name;
    }

    public function toggleStatus(Request $request)
    {
        if (! $request->ajax()) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        $data = $request->validate([
            'slider_id' => 'required|integer|exists:sliders,id',
        ]);

        $slider = Slider::findOrFail($data['slider_id']);
        $slider->status = ! $slider->status;
        $slider->save();

        return response()->json([
            'status' => $slider->status,
            'slider_id' => $slider->id,
        ]);
    }
}
