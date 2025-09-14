<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema; // <<--- مهم: نتحقق من وجود الجدول

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // تحقق من وجود الجدول قبل محاولة قراءته (يمنع الأخطاء أثناء migrate/seed)
        try {
            if (Schema::hasTable('site_settings')) {
                $siteSettings = Cache::remember('siteSettings', 3600, function () {
                    return SiteSetting::active()->get()->keyBy('key');
                });

                View::share('siteSettings', $siteSettings);
            } else {
                // جدول غير موجود — شارك مصفوفة فارغة حتى لا ينهار العرض
                View::share('siteSettings', collect());
            }
        } catch (\Throwable $e) {
            // في حالات نادرة قد يرمى استثناء (مثلاً DB غير متصل) — نمنع انهيار التطبيق
            \Log::warning('AppServiceProvider boot: failed to load siteSettings: '.$e->getMessage());
            View::share('siteSettings', collect());
        }
    }
}