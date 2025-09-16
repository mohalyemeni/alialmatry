<?php

use App\Http\Controllers\Frontend\DurarFrontendController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\MainSliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Frontend\SheikhIntroController as FrontIntroController;
use App\Http\Controllers\Frontend\BookController as FrontBookController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Frontend\BlogFrontendController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\AudioController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Backend\FatawaController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\SheikhPageController;
use App\Http\Controllers\Backend\SupervisorController;
use App\Http\Controllers\Backend\UsefulLinkController;
use App\Http\Controllers\Backend\DurarDiniyaController;
use App\Http\Controllers\Backend\SheikhIntroController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\AudioCategoryController;
use App\Http\Controllers\Backend\VideoCategoryController;
use App\Http\Controllers\Backend\FatawaCategoryController;
use App\Http\Controllers\Frontend\AudioFrontendController;
use App\Http\Controllers\Frontend\VideoFrontendController;
use App\Http\Controllers\Frontend\FatawaFrontendController;
use App\Http\Controllers\Backend\SettingsController;

/*
|--------------------------------------------------------------------------
| Frontend routes
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

Route::prefix('Videos')->group(function () {
    Route::get('/', [VideoFrontendController::class, 'index'])->name('frontend.videos.index');
    Route::get('/{category:slug}', [VideoFrontendController::class, 'category'])->name('frontend.videos.category');
    Route::get('/Topic/{video:slug}', [VideoFrontendController::class, 'show'])->name('frontend.videos.show');

});

Route::prefix('Audios')->group(function () {
    Route::get('/', [AudioFrontendController::class, 'index'])->name('frontend.audios.index');
    Route::get('/{category:slug}', [AudioFrontendController::class, 'category'])->name('frontend.audios.category');
    Route::get('/Topic/{audio:slug}', [AudioFrontendController::class, 'show'])->name('frontend.audios.show');
    Route::get('/download/{audio}', [AudioFrontendController::class, 'download'])->name('frontend.audios.download');

});

Route::prefix('Fatawas')->group(function () {
    Route::get('/', [FatawaFrontendController::class, 'index'])->name('frontend.fatawas.index');
    Route::get('/{category:slug}', [FatawaFrontendController::class, 'category'])->name('frontend.fatawas.category');
    Route::get('/Topic/{fatawa:slug}', [FatawaFrontendController::class, 'show'])->name('frontend.fatawas.show');
    Route::get('/download/{fatawa}', [FatawaFrontendController::class, 'download'])->name('frontend.fatawas.download');
});

Route::prefix('Blogs')->group(function () {
    Route::get('/', [BlogFrontendController::class, 'index'])->name('frontend.blogs.index');
    Route::get('/{category:slug}', [BlogFrontendController::class, 'category'])->name('frontend.blogs.category');
    Route::get('/Topic/{blog:slug}', [BlogFrontendController::class, 'show'])->name('frontend.blogs.show');
});

Route::prefix('durar')->group(function () {
    Route::get('/', [DurarFrontendController::class, 'index'])->name('frontend.durars.index');
    Route::get('/{slug}', [DurarFrontendController::class, 'show'])->name('frontend.durars.show');
});

Route::get('/books', [FrontBookController::class, 'index'])->name('frontend.books.index');
Route::get('/books/{slug}', [FrontBookController::class, 'show'])->name('frontend.books.show');
Route::get('/books/{slug}/download', [FrontBookController::class, 'download'])->name('frontend.books.download');

Route::middleware(['auth', 'roles'])->group(function () {

});

Route::get('/sheikh-intro', [FrontIntroController::class, 'index'])->name('frontend.sheikh-intro');

/*
|--------------------------------------------------------------------------
| Authentication (Laravel)
|--------------------------------------------------------------------------
*/
Auth::routes(['verify' => true]);

/*
|--------------------------------------------------------------------------
| Admin routes (backend)
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    // تسجيل الدخول ونسيان كلمة المرور
    Route::group(['middleware' => 'guest'], function() {
        Route::get('/login',[BackendController::class,'login'])->name('login');
        Route::get('/forgot-password',[BackendController::class,'forgot_password'])->name('forgot_password');
    });

    // الراوتات المحمية لصلاحيات admin|Supervisor
    Route::group(['middleware' => ['roles' , 'role:admin|Supervisor']], function(){

        // الراوتات الاساسية
        Route::get('/',[BackendController::class,'index'])->name('index_route');
        Route::get('/index',[BackendController::class,'index'])->name('index');
        Route::get('/account_settings',[BackendController::class,'account_settings'])->name('account_settings');
        Route::delete('remove-image', [BackendController::class, 'remove_image'])->name('remove_image');

        // ===== Site Settings routes =====

            // Site Main Infos (show + update)
            Route::get('site_setting/site-infos', [SettingsController::class, 'show_main_informations'])->name('settings.site_infos.show');
            Route::post('site_setting/site-infos', [SettingsController::class, 'update_main_informations'])->name('settings.site_infos.edit');

            // remove single image (generic) for site-main-infos (AJAX)
            Route::post('site_setting/site-infos/remove-image', [SettingsController::class, 'remove_image'])->name('settings.site_infos.remove_image');

            // remove album image
            Route::post('site_setting/site-infos/remove-album-image', [SettingsController::class, 'remove_site_settings_albums'])->name('settings.site_infos.remove_album_image');

            // specific logo removers (kept for compatibility)
            Route::post('site_setting/site-infos/remove-logo-large-light', [SettingsController::class, 'remove_site_logo_large_light'])->name('settings.site_infos.remove_logo_large_light');
            Route::post('site_setting/site-infos/remove-logo-small-light', [SettingsController::class, 'remove_site_logo_small_light'])->name('settings.site_infos.remove_logo_small_light');
            Route::post('site_setting/site-infos/remove-logo-large-dark', [SettingsController::class, 'remove_site_logo_large_dark'])->name('settings.site_infos.remove_logo_large_dark');
            Route::post('site_setting/site-infos/remove-logo-small-dark', [SettingsController::class, 'remove_site_logo_small_dark'])->name('settings.site_infos.remove_logo_small_dark');

            // remove-logo with params (if implemented)
            Route::post('site_setting/site-infos/remove-logo/{logo_id}/{logo_type}', [SettingsController::class, 'remove_logo'])->name('settings.site_infos.remove_logo');

            // Site Contacts (show + update)
            Route::get('site_setting/site-contacts', [SettingsController::class, 'show_contact_informations'])->name('settings.site_contacts.show');
            Route::post('site_setting/site-contacts', [SettingsController::class, 'update_contact_informations'])->name('settings.site_contacts.edit');

            // Site Socials (show + update)
            Route::get('site_setting/site-socials', [SettingsController::class, 'show_social_informations'])->name('settings.site_socials.show');
            Route::post('site_setting/site-socials', [SettingsController::class, 'update_social_informations'])->name('settings.site_socials.edit');

            // Site Payment Methods (show + update)
            Route::get('site_setting/site-payment-methods', [SettingsController::class, 'show_payment_method_informations'])->name('settings.site_payment_methods.show');
            Route::post('site_setting/site-payment-methods', [SettingsController::class, 'update_payment_method_informations'])->name('settings.site_payment_methods.edit');

            // Site Counters (show + update)
            Route::get('site_setting/site-counters', [SettingsController::class, 'show_site_counter_informations'])->name('settings.site_counters.show');
            Route::post('site_setting/site-counters', [SettingsController::class, 'update_site_counter_informations'])->name('settings.site_counters.edit');

            // Site SEO / Meta (show + update)
            Route::get('site_setting/site-meta', [SettingsController::class, 'show_meta_informations'])->name('settings.site_meta.show');
            Route::post('site_setting/site-meta', [SettingsController::class, 'update_meta_informations'])->name('settings.site_meta.edit');

            // Site Status (show + update)
            Route::get('site_setting/site-status', [SettingsController::class, 'show_status_informations'])->name('settings.site_status.show');
            Route::post('site_setting/site-status', [SettingsController::class, 'update_status_informations'])->name('settings.site_status.edit');

            // Site Style (Section 5)
            Route::get('site_setting/site-style', [SettingsController::class, 'show_format_informations'])->name('settings.site_style.show');
            Route::post('site_setting/site-style', [SettingsController::class, 'update_format_informations'])->name('settings.site_style.edit');
        // ===== end settings routes =====

        // العملاء
        Route::resource('customers', CustomerController::class);
        Route::post('customers/{customer}/remove-image',[CustomerController::class, 'remove_image'])->name('customers.remove_image');

        // المشرفين
        Route::resource('supervisors', SupervisorController::class);
        Route::post('supervisors/remove-image',[SupervisorController::class, 'remove_image'])->name('supervisors.remove_image');
        Route::patch('/account_settings',[BackendController::class,'update_account_settings'])->name('update_account_settings');
        Route::post('supervisors/toggle-status', [SupervisorController::class, 'toggleStatus'])->name('supervisors.toggleStatus');

        // تصنيفات وباقي الراوتات
        Route::post('video_categories/toggle-status', [VideoCategoryController::class, 'toggleStatus'])->name('video_categories.toggleStatus');
        Route::post('video_categories/toggle-featured', [VideoCategoryController::class, 'toggleFeatured'])->name('video_categories.toggleFeatured');
        Route::resource('video_categories', VideoCategoryController::class);
        Route::post('video-categories/remove-image', [VideoCategoryController::class, 'remove_image'])->name('video_categories.remove_image');

        Route::post('audio_categories/toggle-status', [AudioCategoryController::class, 'toggleStatus'])->name('audio_categories.toggleStatus');
        Route::post('audio_categories/toggle-featured', [AudioCategoryController::class, 'toggleFeatured'])->name('audio_categories.toggleFeatured');
        Route::resource('audio_categories', AudioCategoryController::class);
        Route::post('audio-categories/remove-image', [AudioCategoryController::class, 'remove_image'])->name('audio_categories.remove_image');

        Route::post('fatawa_categories/toggle-status', [FatawaCategoryController::class, 'toggleStatus'])->name('fatawa_categories.toggleStatus');
        Route::post('fatawa_categories/toggle-featured', [FatawaCategoryController::class, 'toggleFeatured'])->name('fatawa_categories.toggleFeatured');
        Route::resource('fatawa_categories', FatawaCategoryController::class);
        Route::post('fatawa_categories/remove-image', [FatawaCategoryController::class, 'remove_image'])->name('fatawa_categories.remove_image');

        Route::post('blog_categories/toggle-status', [BlogCategoryController::class, 'toggleStatus'])->name('blog_categories.toggleStatus');
        Route::post('blog_categories/toggle-featured', [BlogCategoryController::class, 'toggleFeatured'])->name('blog_categories.toggleFeatured');
        Route::resource('blog_categories', BlogCategoryController::class);
        Route::post('blog_categories/remove-image', [BlogCategoryController::class, 'remove_image'])->name('blog_categories.remove_image');
        Route::resource('blog', BlogController::class);

        Route::post('audios/toggle-status', [AudioController::class, 'toggleStatus'])->name('audios.toggleStatus');
        Route::resource('audios', AudioController::class);
        Route::post('audios/remove-image', [AudioController::class, 'remove_image'])->name('audios.remove_image');
        Route::post('audios/remove-audio', [AudioController::class, 'remove_audio'])->name('audios.remove_audio');

        Route::post('fatawa/toggle-status', [FatawaController::class, 'toggleStatus'])->name('fatawa.toggleStatus');
        Route::resource('fatawa', FatawaController::class);
        Route::post('fatawa/remove-image', [FatawaController::class, 'remove_image'])->name('fatawa.remove_image');
        Route::post('fatawa/remove-audio', [FatawaController::class, 'remove_audio'])->name('fatawa.remove_audio');

        Route::post('blogs/toggle-status', [BlogController::class, 'toggleStatus'])->name('blogs.toggleStatus');
        Route::resource('blogs', BlogController::class);
        Route::post('blogs/remove-image', [BlogController::class, 'remove_image'])->name('blogs.remove_image');

        Route::post('videos/toggle-status', [VideoController::class, 'toggleStatus'])->name('videos.toggleStatus');
        Route::post('videos/fetch-youtube-data', [VideoController::class, 'fetchYouTubeData'])->name('videos.fetch_data');
        Route::resource('videos', VideoController::class);

        Route::post('durar_diniya/toggle-status', [DurarDiniyaController::class, 'toggleStatus'])->name('durar_diniya.toggleStatus');
        Route::resource('durar_diniya', DurarDiniyaController::class);
        Route::post('durar_diniya/remove-image', [DurarDiniyaController::class, 'remove_image'])->name('durar_diniya.remove_image');

        Route::post('books/toggle-status', [BookController::class, 'toggleStatus'])->name('books.toggleStatus');
        Route::resource('books', BookController::class);
        Route::post('books/remove-image', [BookController::class, 'remove_image'])->name('books.remove_image');
        Route::post('books/remove-file', [BookController::class, 'remove_file'])->name('books.remove_file');

        Route::post('useful_links/toggle-status', [UsefulLinkController::class, 'toggleStatus'])->name('useful_links.toggleStatus');
        Route::resource('useful_links', UsefulLinkController::class);

        Route::post('sheikh_pages/toggle-status', [SheikhPageController::class, 'toggleStatus'])->name('sheikh_pages.toggleStatus');
        Route::resource('sheikh_pages', SheikhPageController::class);
        Route::post('sheikh_pages/remove-image', [SheikhPageController::class, 'remove_image'])->name('sheikh_pages.remove_image');

        Route::post('sheikh_intro/toggle-status', [SheikhIntroController::class, 'toggleStatus'])->name('sheikh_intro.toggleStatus');
        Route::resource('sheikh_intro', SheikhIntroController::class);
        Route::post('sheikh_intro/remove-image', [SheikhIntroController::class, 'remove_image'])->name('sheikh_intro.remove_image');

        Route::post('slider/toggle-status', [ MainSliderController::class, 'toggleStatus'])->name('slider.toggleStatus');
        Route::resource('main_sliders', MainSliderController::class);
        Route::post('main_sliders/remove-image', [MainSliderController::class, 'remove_image'])->name('main_sliders.remove_image');
    } );

});