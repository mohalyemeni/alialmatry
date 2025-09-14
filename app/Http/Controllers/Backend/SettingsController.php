<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SettingsController extends Controller
{
    // -------------------------
    // === Compatibility wrappers ===
    // -------------------------

    public function siteMainInfos()
    {
        return $this->show_main_informations();
    }

    public function updateSiteMainInfos(Request $request, $id = 1)
    {
        return $this->update_main_informations($request, $id);
    }

    public function siteContacts()
    {
        return $this->show_contact_informations();
    }

    public function updateSiteContacts(Request $request, $id = 2)
    {
        return $this->update_contact_informations($request, $id);
    }

    public function siteSocials()
    {
        return $this->show_social_informations();
    }

    public function updateSiteSocials(Request $request, $id = 3)
    {
        return $this->update_social_informations($request, $id);
    }

    public function show_payment_method_informations()
    {
        return $this->show_payment_methods();
    }

    public function update_payment_method_informations(Request $request)
    {
        return $this->update_payment_methods($request);
    }

    public function show_site_counter_informations()
    {
        return $this->show_site_counters();
    }

    public function update_site_counter_informations(Request $request)
    {
        return $this->update_site_counters($request);
    }

    public function siteStatus()
    {
        return $this->show_status_informations();
    }

    public function updateSiteStatus(Request $request, $id = 4)
    {
        return $this->update_status_informations($request, $id);
    }

    public function siteStyle()
    {
        return $this->show_format_informations();
    }

    public function updateSiteStyle(Request $request, $id = 5)
    {
        return $this->update_format_informations($request, $id);
    }

    public function siteMeta()
    {
        return $this->show_meta_informations();
    }

    public function updateSiteMeta(Request $request, $id = 6)
    {
        return $this->update_meta_informations($request, $id);
    }

    // generic remove-image route wrapper
    public function remove_image(Request $request)
    {
        return $this->remove_site_favicon($request);
    }

    // compatibility named removers
    public function remove_site_logo_large_light(Request $request) { return $this->remove_site_logo_light($request); }
    public function remove_site_logo_small_light(Request $request) { return $this->remove_site_logo_light($request); }
    public function remove_site_logo_large_dark(Request $request)  { return $this->remove_site_logo_dark($request); }
    public function remove_site_logo_small_dark(Request $request)  { return $this->remove_site_logo_dark($request); }

    public function remove_logo($logo_id, $logo_type = null)
    {
        $siteImage = SiteSetting::find($logo_id);
        if (!$siteImage) {
            return response()->json(['success' => false, 'message' => 'Not found'], 404);
        }

        if ($siteImage->value && File::exists(public_path('assets/site_settings/' . $siteImage->value))) {
            unlink(public_path('assets/site_settings/' . $siteImage->value));
        }
        $siteImage->value = null;
        $siteImage->save();
        $this->updateCache();

        return response()->json(['success' => true]);
    }

    /**
     * Remove image from album stored in value (value is array)
     * expects: site_info_id and either file_name or index
     */
    public function remove_site_settings_albums(Request $request)
    {
        $id = $request->input('site_info_id');
        $fileName = $request->input('file_name');
        $index = $request->input('index');

        $setting = SiteSetting::find($id);
        if (!$setting) {
            return response()->json(['success' => false, 'message' => 'Setting not found'], 404);
        }

        $value = $setting->value;
        if (!is_array($value)) {
            return response()->json(['success' => false, 'message' => 'No album data'], 400);
        }

        if ($fileName) {
            $pos = array_search($fileName, $value);
            if ($pos !== false) {
                if (File::exists(public_path('assets/site_settings/' . $fileName))) {
                    unlink(public_path('assets/site_settings/' . $fileName));
                }
                array_splice($value, $pos, 1);
            } else {
                return response()->json(['success' => false, 'message' => 'File not found in album'], 404);
            }
        } elseif ($index !== null && isset($value[$index])) {
            $toRemove = $value[$index];
            if (File::exists(public_path('assets/site_settings/' . $toRemove))) {
                unlink(public_path('assets/site_settings/' . $toRemove));
            }
            array_splice($value, $index, 1);
        } else {
            return response()->json(['success' => false, 'message' => 'No file specified'], 400);
        }

        $setting->value = array_values($value);
        $setting->save();
        $this->updateCache();

        return response()->json(['success' => true, 'value' => $setting->value]);
    }

    // -------------------------
    // === Business methods ===
    // -------------------------

    public function show_main_informations()
    {
        $site_name = SiteSetting::where('key', 'site_name')->first();
        $site_description = SiteSetting::where('key', 'site_description')->first();
        $site_keywords = SiteSetting::where('key', 'site_keywords')->first();
        $site_link = SiteSetting::where('key', 'site_link')->first();

        return view('backend.site_infos.index', compact(
            'site_name', 'site_description', 'site_keywords', 'site_link'
        ));
    }

    public function update_main_informations(Request $request, $id = 1)
    {
        $data = $request->only([
            'site_name', 'site_description', 'site_keywords', 'site_link'
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key, 'section' => $id],
                ['value' => $value, 'status' => true]
            );
        }

        $this->updateCache();

        return redirect()->route('admin.settings.site_infos.show')->with([
            'message' => 'تم تحديث بيانات الموقع بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function show_contact_informations()
    {
        $site_address = SiteSetting::where('key', 'site_address')->first();
        $site_mobile = SiteSetting::where('key', 'site_mobile')->first();
        $site_fax = SiteSetting::where('key', 'site_fax')->first();
        $site_email = SiteSetting::where('key', 'site_email')->first();
        $site_workTime = SiteSetting::where('key', 'site_workTime')->first();
        return view('backend.site_contacts.index', compact(
            'site_address', 'site_mobile', 'site_fax', 'site_email', 'site_workTime'
        ));
    }

    public function update_contact_informations(Request $request, $id = 2)
    {
        $data = $request->only([
            'site_address', 'site_mobile', 'site_fax', 'site_email', 'site_workTime'
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key, 'section' => $id],
                ['value' => $value, 'status' => true]
            );
        }

        $this->updateCache();

        return redirect()->route('admin.settings.site_contacts.show')->with([
            'message' => 'تم تحديث بيانات التواصل بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function show_social_informations()
    {
        $site_facebook = SiteSetting::where('key', 'site_facebook')->first();
        $site_twitter = SiteSetting::where('key', 'site_twitter')->first();
        $site_whatsapp = SiteSetting::where('key', 'site_whatsapp')->first();
        $site_linkedin = SiteSetting::where('key', 'site_linkedin')->first();
        $site_instagram = SiteSetting::where('key', 'site_instagram')->first();
        $site_snapchat = SiteSetting::where('key', 'site_snapchat')->first();
        $site_youtube = SiteSetting::where('key', 'site_youtube')->first();
        return view('backend.site_socials.index', compact(
            'site_facebook', 'site_twitter', 'site_whatsapp',
            'site_linkedin', 'site_instagram', 'site_snapchat', 'site_youtube'
        ));
    }

    public function update_social_informations(Request $request, $id = 3)
    {
        $data = $request->only([
            'site_facebook', 'site_twitter', 'site_whatsapp',
            'site_linkedin', 'site_instagram', 'site_snapchat','site_youtube'
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key, 'section' => $id],
                ['value' => $value, 'status' => true]
            );
        }

        $this->updateCache();

        return redirect()->route('admin.settings.site_socials.show')->with([
            'message' => 'تم تحديث وسائل التواصل الاجتماعي بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function show_payment_methods()
    {
        $payment = SiteSetting::where('key', 'site_payment_methods')->first();
        return view('backend.site_payment_methods.index', compact('payment'));
    }

    public function update_payment_methods(Request $request)
    {
        $value = $request->input('site_payment_methods');
        SiteSetting::updateOrCreate(
            ['key' => 'site_payment_methods'],
            ['value' => $value, 'status' => true, 'section' => 0]
        );

        $this->updateCache();

        return redirect()->route('admin.settings.site_payment_methods.show')->with([
            'message' => 'تم تحديث طرق الدفع بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function show_site_counters()
    {
        $counters = SiteSetting::where('key', 'site_counters')->first();
        return view('backend.site_counters.index', compact('counters'));
    }

    public function update_site_counters(Request $request)
    {
        $value = $request->input('site_counters');
        SiteSetting::updateOrCreate(
            ['key' => 'site_counters'],
            ['value' => $value, 'status' => true, 'section' => 0]
        );

        $this->updateCache();

        return redirect()->route('admin.settings.site_counters.show')->with([
            'message' => 'تم تحديث العدادات بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function show_status_informations()
    {
        $site_status = SiteSetting::where('key', 'site_status')->first();
        return view('backend.site_status.index', compact('site_status'));
    }

    public function update_status_informations(Request $request, $id = 4)
    {
        $validated = $request->validate([
            'site_status' => ['required']
        ]);

        SiteSetting::updateOrCreate(
            ['key' => 'site_status', 'section' => $id],
            ['value' => $validated['site_status'], 'status' => true]
        );

        $this->updateCache();

        return redirect()->route('admin.settings.site_status.show')->with([
            'message' => 'تم تحديث حالة الموقع بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function show_format_informations()
    {
        $site_logo_light = SiteSetting::where('key', 'site_logo_light')->first();
        $site_logo_dark = SiteSetting::where('key', 'site_logo_dark')->first();
        $site_favicon = SiteSetting::where('key', 'site_favicon')->first();
        return view('backend.site_formats.index', compact(
            'site_logo_light', 'site_logo_dark', 'site_favicon'
        ));
    }

    /**
     * Here we use ImageManager with Driver and ->read() as you requested
     */
    public function update_format_informations(Request $request, $id = 5)
    {
        $request->validate([
            'site_logo_light' => ['nullable', 'image', 'max:5120'],
            'site_logo_dark'  => ['nullable', 'image', 'max:5120'],
            'site_favicon'    => ['nullable', 'image', 'max:2048'],
        ]);

        // Use explicit Driver + ImageManager so ->read() is available
        $manager = new ImageManager(new Driver());

        $saveDir = public_path('assets/site_settings');
        if (!File::exists($saveDir)) {
            File::makeDirectory($saveDir, 0755, true);
        }

        $processWithRead = function ($file, $fileName) use ($manager, $saveDir) {
            // use read() as requested (supports UploadedFile / resource / string)
            $img = $manager->read($file);
            // optional: resize or other processing here
            $img->save($saveDir . DIRECTORY_SEPARATOR . $fileName);
        };

        // site_logo_light
        if ($image = $request->file('site_logo_light')) {
            $setting = SiteSetting::where('key', 'site_logo_light')->where('section', $id)->first();
            if ($setting && $setting->value && File::exists($saveDir . DIRECTORY_SEPARATOR . $setting->value)) {
                unlink($saveDir . DIRECTORY_SEPARATOR . $setting->value);
            }
            $file_name = 'logo_light.' . $image->getClientOriginalExtension();
            $processWithRead($image, $file_name);
            SiteSetting::updateOrCreate(
                ['key' => 'site_logo_light', 'section' => $id],
                ['value' => $file_name, 'status' => true]
            );
        }

        // site_logo_dark
        if ($image = $request->file('site_logo_dark')) {
            $setting = SiteSetting::where('key', 'site_logo_dark')->where('section', $id)->first();
            if ($setting && $setting->value && File::exists($saveDir . DIRECTORY_SEPARATOR . $setting->value)) {
                unlink($saveDir . DIRECTORY_SEPARATOR . $setting->value);
            }
            $file_name = 'logo_dark.' . $image->getClientOriginalExtension();
            $processWithRead($image, $file_name);
            SiteSetting::updateOrCreate(
                ['key' => 'site_logo_dark', 'section' => $id],
                ['value' => $file_name, 'status' => true]
            );
        }

        // site_favicon
        if ($image = $request->file('site_favicon')) {
            $setting = SiteSetting::where('key', 'site_favicon')->where('section', $id)->first();
            if ($setting && $setting->value && File::exists($saveDir . DIRECTORY_SEPARATOR . $setting->value)) {
                unlink($saveDir . DIRECTORY_SEPARATOR . $setting->value);
            }
            $file_name = 'favicon.' . $image->getClientOriginalExtension();
            $processWithRead($image, $file_name);
            SiteSetting::updateOrCreate(
                ['key' => 'site_favicon', 'section' => $id],
                ['value' => $file_name, 'status' => true]
            );
        }

        $this->updateCache();

        return redirect()->route('admin.settings.site_style.show')->with([
            'message' => 'تم تحديث الشعارات بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function show_meta_informations()
    {
        $site_name_meta = SiteSetting::where('key', 'site_name_meta')->first();
        $site_description_meta = SiteSetting::where('key', 'site_description_meta')->first();
        $site_link_meta = SiteSetting::where('key', 'site_link_meta')->first();
        $site_keywords_meta = SiteSetting::where('key', 'site_keywords_meta')->first();
        return view('backend.site_metas.index', compact(
            'site_name_meta', 'site_description_meta', 'site_link_meta', 'site_keywords_meta'
        ));
    }

    public function update_meta_informations(Request $request, $id = 6)
    {
        $data = $request->only([
            'site_name_meta', 'site_description_meta', 'site_link_meta', 'site_keywords_meta'
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key, 'section' => $id],
                ['value' => $value, 'status' => true]
            );
        }

        $this->updateCache();

        return redirect()->route('admin.settings.site_meta.show')->with([
            'message' => 'تم تحديث إعدادات محركات البحث بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function remove_site_logo_light(Request $request)
    {
        $siteImage = SiteSetting::findOrFail($request->site_info_id);
        if ($siteImage->value && File::exists(public_path('assets/site_settings/' . $siteImage->value))) {
            unlink(public_path('assets/site_settings/' . $siteImage->value));
        }
        $siteImage->value = null;
        $siteImage->save();
        $this->updateCache();
        return response()->json(['success' => true]);
    }

    public function remove_site_logo_dark(Request $request)
    {
        $siteImage = SiteSetting::findOrFail($request->site_info_id);
        if ($siteImage->value && File::exists(public_path('assets/site_settings/' . $siteImage->value))) {
            unlink(public_path('assets/site_settings/' . $siteImage->value));
        }
        $siteImage->value = null;
        $siteImage->save();
        $this->updateCache();
        return response()->json(['success' => true]);
    }

    public function remove_site_favicon(Request $request)
    {
        $siteImage = SiteSetting::findOrFail($request->site_info_id);
        if ($siteImage->value && File::exists(public_path('assets/site_settings/' . $siteImage->value))) {
            unlink(public_path('assets/site_settings/' . $siteImage->value));
        }
        $siteImage->value = null;
        $siteImage->save();
        $this->updateCache();
        return response()->json(['success' => true]);
    }

    private function updateCache()
    {
        Cache::forget('siteSettings');
        $siteSettings = Cache::remember('siteSettings', 3600, function () {
            return SiteSetting::active()->get()->keyBy('key');
        });
        View::share('siteSettings', $siteSettings);
    }
}
