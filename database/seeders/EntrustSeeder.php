<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        // Roles
        $adminRole      = Role::create([
            'name'          => 'admin',
            'display_name'  => 'Administrator',
            'description'   => 'System Administrator',
            'allowed_route' => 'admin',
        ]);
        $SupervisorRole = Role::create([
            'name'          => 'Supervisor',
            'display_name'  => 'Supervisor',
            'description'   => 'Supervisor',
            'allowed_route' => 'admin',
        ]);
        $customerRole   = Role::create([
            'name'          => 'customer',
            'display_name'  => 'customer',
            'description'   => 'customer',
            'allowed_route' => null,
        ]);

        // Admin user
        $admin = User::create([
            'first_name'        => 'Admin',
            'last_name'         => 'System',
            'username'          => 'admin',
            'email'             => 'admin@ecommerce.test',
            'email_verified_at' => Carbon::now(),
            'mobile'            => '966500000001',
            'password'          => bcrypt('123123123'),
            'status'            => 1,
            'remember_token'    => Str::random(10),
        ]);
        $admin->attachRole($adminRole);

        // Supervisor user
        $Supervisor = User::create([
            'first_name'        => 'Supervisor',
            'last_name'         => 'System',
            'username'          => 'Supervisor',
            'email'             => 'Supervisor@ecommerce.test',
            'email_verified_at' => Carbon::now(),
            'mobile'            => '966500000002',
            'password'          => bcrypt('123123123'),
            'status'            => 1,
            'remember_token'    => Str::random(10),
        ]);
        $Supervisor->attachRole($SupervisorRole);

        // Customer user
        $customer = User::create([
            'first_name'        => 'Waleed',
            'last_name'         => 'Al_shopi',
            'username'          => 'waleed',
            'email'             => 'waleed@ecommerce.test',
            'email_verified_at' => Carbon::now(),
            'mobile'            => '966500000003',
            'password'          => bcrypt('123123123'),
            'status'            => 1,
            'remember_token'    => Str::random(10),
        ]);
        $customer->attachRole($customerRole);

        // Additional random customers
        for ($i = 0; $i <= 20; $i++) {
            $random_customer = User::create([
                'first_name'        => $faker->firstName(),
                'last_name'         => $faker->lastName(),
                'username'          => $faker->userName(),
                'email'             => $faker->unique()->safeEmail(),
                'email_verified_at' => Carbon::now(),
                'mobile'            => '9667' . $faker->numberBetween(770000000, 779999999),
                'password'          => bcrypt('123123123'),
                 'status'            => 1,
                'remember_token'    => Str::random(10),
            ]);
            $random_customer->attachRole($customerRole);
        }

        // Main
        $manageMain = Permission::create([
            'name'           => 'main',
            'display_name'   => 'Main',
            'route'          => 'index',
            'module'         => 'index',
            'as'             => 'index',
            'icon'           => 'fas fa-home',
            'parent'         => '0',
            'parent_original'=> '0',
            'sidebar_link'   => '1',
            'appear'         => '1',
            'ordering'       => '1',
        ]);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();

//-------------------------------------------------------------------------------
// SUPERVISORS
// SUPERVISORS
$manageSupervisors   = Permission::create([
    'name'             => 'manage_supervisors',
    'display_name'     => 'supervisors',
    'route'            => 'supervisors',
    'module'           => 'supervisors',
    'as'               => 'supervisors.index',
    'icon'             => 'fas fa-user-shield',
    'parent'           => '0',
    'parent_original'  => '0',
    'sidebar_link'     => '0',
    'appear'           => '1',
    'ordering'         => '100',
]);
$manageSupervisors->parent_show = $manageSupervisors->id; $manageSupervisors->save();

$showSupervisors     = Permission::create([
    'name'             => 'show_supervisors',
    'display_name'     => 'supervisors',
    'route'            => 'supervisors',
    'module'           => 'supervisors',
    'as'               => 'supervisors.index',
    'icon'             => 'fas fa-shield',
    'parent'           => $manageSupervisors->id,
    'parent_original'  => $manageSupervisors->id,
    'parent_show'      => $manageSupervisors->id,
    'sidebar_link'     => '1',
    'appear'           => '1',
]);

$createSupervisors   = Permission::create([
    'name'             => 'create_supervisors',
    'display_name'     => 'supervisor',
    'route'            => 'supervisors',
    'module'           => 'supervisors',
    'as'               => 'supervisors.create',
    'icon'             => 'fas fa-user-plus',
    'parent'           => $manageSupervisors->id,
    'parent_original'  => $manageSupervisors->id,
    'parent_show'      => $manageSupervisors->id,
    'sidebar_link'     => '1',
    'appear'           => '0',
]);

$displaySupervisors  = Permission::create([
    'name'             => 'display_supervisors',
    'display_name'     => 'supervisor',
    'route'            => 'supervisors',
    'module'           => 'supervisors',
    'as'               => 'supervisors.show',
    'icon'             => 'fas fa-user',
    'parent'           => $manageSupervisors->id,
    'parent_original'  => $manageSupervisors->id,
    'parent_show'      => $manageSupervisors->id,
    'sidebar_link'     => '1',
    'appear'           => '0',
]);

$updateSupervisors   = Permission::create([
    'name'             => 'update_supervisors',
    'display_name'     => 'supervisor',
    'route'            => 'supervisors',
    'module'           => 'supervisors',
    'as'               => 'supervisors.edit',
    'icon'             => 'fas fa-user-edit',
    'parent'           => $manageSupervisors->id,
    'parent_original'  => $manageSupervisors->id,
    'parent_show'      => $manageSupervisors->id,
    'sidebar_link'     => '1',
    'appear'           => '0',
]);

$deleteSupervisors   = Permission::create([
    'name'             => 'delete_supervisors',
    'display_name'     => 'supervisor',
    'route'            => 'supervisors',
    'module'           => 'supervisors',
    'as'               => 'supervisors.destroy',
    'icon'             => 'fas fa-user-times',
    'parent'           => $manageSupervisors->id,
    'parent_original'  => $manageSupervisors->id,
    'parent_show'      => $manageSupervisors->id,
    'sidebar_link'     => '1',
    'appear'           => '0',
]);

  //-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
// ادارة المرئيات Permissions
// Video Categories Permissions
$manageVideoCategories = Permission::create(['name' => 'manage_video_categories','display_name' => 'إدارة المرئيات','route' => 'video_categories','module' => 'video_categories','as' => 'video_categories.index','icon' => 'fas fa-video','parent' => '0','parent_original' => '0','appear' => '1','sidebar_link' => '1','ordering' => '130']);
$manageVideoCategories->parent_show = $manageVideoCategories->id;
$manageVideoCategories->save();
// تصنيف المرئيات Permissions
Permission::create(['name' => 'show_video_categories','display_name' => 'تصنيف المرئيات','route' => 'video_categories','module' => 'video_categories','as' => 'video_categories.index','icon' => 'fas fa-video','parent' => $manageVideoCategories->id,'parent_original' => $manageVideoCategories->id,'parent_show' => $manageVideoCategories->id,'sidebar_link' => '1','appear' => '1']);
Permission::create(['name' => 'create_video_categories','display_name' => 'Create Video Category','route' => 'video_categories/create','module' => 'video_categories','as' => 'video_categories.create','icon' => 'fas fa-plus-circle','parent' => $manageVideoCategories->id,'parent_original' => $manageVideoCategories->id,'parent_show' => $manageVideoCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'display_video_categories','display_name' => 'Show Video Category','route' => 'video_categories/{video_category}','module' => 'video_categories','as' => 'video_categories.show','icon' => 'fas fa-eye','parent' => $manageVideoCategories->id,'parent_original' => $manageVideoCategories->id,'parent_show' => $manageVideoCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'update_video_categories','display_name' => 'Update Video Category','route' => 'video_categories/{video_category}/edit','module' => 'video_categories','as' => 'video_categories.edit','icon' => 'fas fa-edit','parent' => $manageVideoCategories->id,'parent_original' => $manageVideoCategories->id,'parent_show' => $manageVideoCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'delete_video_categories','display_name' => 'Delete Video Category','route' => 'video_categories/{video_category}','module' => 'video_categories','as' => 'video_categories.destroy','icon' => 'fas fa-trash','parent' => $manageVideoCategories->id,'parent_original' => $manageVideoCategories->id,'parent_show' => $manageVideoCategories->id,'sidebar_link' => '0','appear' => '0']);

// دليل المرئيات Permissions
Permission::create(['name' => 'show_videos','display_name' => 'دليل المرئيات','route' => 'videos','module' => 'videos','as' => 'videos.index','icon' => 'fas fa-film','parent' => $manageVideoCategories->id,'parent_original' => $manageVideoCategories->id,'parent_show' => $manageVideoCategories->id,'sidebar_link' => '1','appear' => '1']);
Permission::create(['name' => 'create_videos','display_name' => 'Create Video','route' => 'videos/create','module' => 'videos','as' => 'videos.create','icon' => 'fas fa-plus-circle','parent' => $manageVideoCategories->id,'parent_original' => $manageVideoCategories->id,'parent_show' => $manageVideoCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'display_videos','display_name' => 'Show Video','route' => 'videos/{video}','module' => 'videos','as' => 'videos.show','icon' => 'fas fa-eye','parent' => $manageVideoCategories->id,'parent_original' => $manageVideoCategories->id,'parent_show' => $manageVideoCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'update_videos','display_name' => 'Update Video','route' => 'videos/{video}/edit','module' => 'videos','as' => 'videos.edit','icon' => 'fas fa-edit','parent' => $manageVideoCategories->id,'parent_original' => $manageVideoCategories->id,'parent_show' => $manageVideoCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'delete_videos','display_name' => 'Delete Video','route' => 'videos/{video}','module' => 'videos','as' => 'videos.destroy','icon' => 'fas fa-trash','parent' => $manageVideoCategories->id,'parent_original' => $manageVideoCategories->id,'parent_show' => $manageVideoCategories->id,'sidebar_link' => '0','appear' => '0']);
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
$manageAudioCategories = Permission::create([
    'name' => 'manage_audio_categories',
    'display_name' => 'إدارة الصوتيات',
    'route' => 'audio_categories',
    'module' => 'audio_categories',
    'as' => 'audio_categories.index',
    'icon' => 'fas fa-volume-up',
    'parent' => '0',
    'parent_original' => '0',
    'appear' => '1',
    'sidebar_link' => '1',
    'ordering' => '130'
]);

$manageAudioCategories->parent_show = $manageAudioCategories->id;
$manageAudioCategories->save();

// تصنيفات الصوتيات
Permission::create(['name' => 'show_audio_categories','display_name' => 'تصنيفات الصوتيات','route' => 'audio_categories','module' => 'audio_categories','as' => 'audio_categories.index','icon' => 'fas fa-music','parent' => $manageAudioCategories->id,'parent_original' => $manageAudioCategories->id,'parent_show' => $manageAudioCategories->id,'sidebar_link' => '1','appear' => '1']);
Permission::create(['name' => 'create_audio_categories','display_name' => 'Create Audio Category','route' => 'audio_categories/create','module' => 'audio_categories','as' => 'audio_categories.create','icon' => 'fas fa-plus-circle','parent' => $manageAudioCategories->id,'parent_original' => $manageAudioCategories->id,'parent_show' => $manageAudioCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'display_audio_categories','display_name' => 'Show Audio Category','route' => 'audio_categories/{audio_category}','module' => 'audio_categories','as' => 'audio_categories.show','icon' => 'fas fa-eye','parent' => $manageAudioCategories->id,'parent_original' => $manageAudioCategories->id,'parent_show' => $manageAudioCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'update_audio_categories','display_name' => 'Update Audio Category','route' => 'audio_categories/{audio_category}/edit','module' => 'audio_categories','as' => 'audio_categories.edit','icon' => 'fas fa-edit','parent' => $manageAudioCategories->id,'parent_original' => $manageAudioCategories->id,'parent_show' => $manageAudioCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'delete_audio_categories','display_name' => 'Delete Audio Category','route' => 'audio_categories/{audio_category}','module' => 'audio_categories','as' => 'audio_categories.destroy','icon' => 'fas fa-trash','parent' => $manageAudioCategories->id,'parent_original' => $manageAudioCategories->id,'parent_show' => $manageAudioCategories->id,'sidebar_link' => '0','appear' => '0']);

// دليل الصوتيات
Permission::create(['name' => 'show_audios','display_name' => 'دليل الصوتيات','route' => 'audios','module' => 'audios','as' => 'audios.index','icon' => 'fas fa-headphones','parent' => $manageAudioCategories->id,'parent_original' => $manageAudioCategories->id,'parent_show' => $manageAudioCategories->id,'sidebar_link' => '1','appear' => '1']);
Permission::create(['name' => 'create_audios','display_name' => 'Create Audio','route' => 'audios/create','module' => 'audios','as' => 'audios.create','icon' => 'fas fa-plus-circle','parent' => $manageAudioCategories->id,'parent_original' => $manageAudioCategories->id,'parent_show' => $manageAudioCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'display_audios','display_name' => 'Show Audio','route' => 'audios/{audio}','module' => 'audios','as' => 'audios.show','icon' => 'fas fa-eye','parent' => $manageAudioCategories->id,'parent_original' => $manageAudioCategories->id,'parent_show' => $manageAudioCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'update_audios','display_name' => 'Update Audio','route' => 'audios/{audio}/edit','module' => 'audios','as' => 'audios.edit','icon' => 'fas fa-edit','parent' => $manageAudioCategories->id,'parent_original' => $manageAudioCategories->id,'parent_show' => $manageAudioCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'delete_audios','display_name' => 'Delete Audio','route' => 'audios/{audio}','module' => 'audios','as' => 'audios.destroy','icon' => 'fas fa-trash','parent' => $manageAudioCategories->id,'parent_original' => $manageAudioCategories->id,'parent_show' => $manageAudioCategories->id,'sidebar_link' => '0','appear' => '0']);

// ادارى الفتاوى
// --------------------------------------------------------------------
// --------------------------------------------------------------------
// ادارة الفتاوى
$manageFatawaCategories = Permission::create([
    'name' => 'manage_fatawa_categories',
    'display_name' => 'إدارة تصنيفات الفتاوى',
    'route' => 'fatawa_categories',
    'module' => 'fatawa_categories',
    'as' => 'fatawa_categories.index',
    'icon' => 'fas fa-gavel',
    'parent' => '0',
    'parent_original' => '0',
    'appear' => '1',
    'sidebar_link' => '1',
    'ordering' => '130'
]);

$manageFatawaCategories->parent_show = $manageFatawaCategories->id;
$manageFatawaCategories->save();

// تصنيفات الفتاوى
Permission::create(['name' => 'show_fatawa_categories','display_name' => 'تصنيفات الفتاوى','route' => 'fatawa_categories','module' => 'fatawa_categories','as' => 'fatawa_categories.index','icon' => 'fas fa-gavel','parent' => $manageFatawaCategories->id,'parent_original' => $manageFatawaCategories->id,'parent_show' => $manageFatawaCategories->id,'sidebar_link' => '1','appear' => '1']);
Permission::create(['name' => 'create_fatawa_categories','display_name' => 'إنشاء تصنيف فتاوى','route' => 'fatawa_categories/create','module' => 'fatawa_categories','as' => 'fatawa_categories.create','icon' => 'fas fa-plus-circle','parent' => $manageFatawaCategories->id,'parent_original' => $manageFatawaCategories->id,'parent_show' => $manageFatawaCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'display_fatawa_categories','display_name' => 'عرض تصنيف فتاوى','route' => 'fatawa_categories/{fatawa_category}','module' => 'fatawa_categories','as' => 'fatawa_categories.show','icon' => 'fas fa-eye','parent' => $manageFatawaCategories->id,'parent_original' => $manageFatawaCategories->id,'parent_show' => $manageFatawaCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'update_fatawa_categories','display_name' => 'تحديث تصنيف فتاوى','route' => 'fatawa_categories/{fatawa_category}/edit','module' => 'fatawa_categories','as' => 'fatawa_categories.edit','icon' => 'fas fa-edit','parent' => $manageFatawaCategories->id,'parent_original' => $manageFatawaCategories->id,'parent_show' => $manageFatawaCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'delete_fatawa_categories','display_name' => 'حذف تصنيف فتاوى','route' => 'fatawa_categories/{fatawa_category}','module' => 'fatawa_categories','as' => 'fatawa_categories.destroy','icon' => 'fas fa-trash','parent' => $manageFatawaCategories->id,'parent_original' => $manageFatawaCategories->id,'parent_show' => $manageFatawaCategories->id,'sidebar_link' => '0','appear' => '0']);

// دليل الفتاوى (الفتاوى نفسها)
Permission::create(['name' => 'show_fatawa','display_name' => 'دليل الفتاوى','route' => 'fatawa','module' => 'fatawa','as' => 'fatawa.index','icon' => 'fas fa-book-open','parent' => $manageFatawaCategories->id,'parent_original' => $manageFatawaCategories->id,'parent_show' => $manageFatawaCategories->id,'sidebar_link' => '1','appear' => '1']);
Permission::create(['name' => 'create_fatawa','display_name' => 'إنشاء فتوى','route' => 'fatawa/create','module' => 'fatawa','as' => 'fatawa.create','icon' => 'fas fa-plus-circle','parent' => $manageFatawaCategories->id,'parent_original' => $manageFatawaCategories->id,'parent_show' => $manageFatawaCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'display_fatawa','display_name' => 'عرض فتوى','route' => 'fatawa/{fatawa}','module' => 'fatawa','as' => 'fatawa.show','icon' => 'fas fa-eye','parent' => $manageFatawaCategories->id,'parent_original' => $manageFatawaCategories->id,'parent_show' => $manageFatawaCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'update_fatawa','display_name' => 'تحديث فتوى','route' => 'fatawa/{fatawa}/edit','module' => 'fatawa','as' => 'fatawa.edit','icon' => 'fas fa-edit','parent' => $manageFatawaCategories->id,'parent_original' => $manageFatawaCategories->id,'parent_show' => $manageFatawaCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'delete_fatawa','display_name' => 'حذف فتوى','route' => 'fatawa/{fatawa}','module' => 'fatawa','as' => 'fatawa.destroy','icon' => 'fas fa-trash','parent' => $manageFatawaCategories->id,'parent_original' => $manageFatawaCategories->id,'parent_show' => $manageFatawaCategories->id,'sidebar_link' => '0','appear' => '0']);
// -----------------------------------------------------------------------
// -----------------------------------------------------------------------
// إدارة تصنيفات المقالات
$manageBlogCategories = Permission::create([
    'name' => 'manage_blog_categories',
    'display_name' => 'إدارة تصنيفات المقالات',
    'route' => 'blog_categories',
    'module' => 'blog_categories',
    'as' => 'blog_categories.index',
    'icon' => 'fas fa-folder-open',
    'parent' => '0', 'parent_original' => '0', 'appear' => '1', 'sidebar_link' => '1', 'ordering' => '130'
]);

$manageBlogCategories->parent_show = $manageBlogCategories->id;
$manageBlogCategories->save();
// تصنيفات المقالات
Permission::create(['name' => 'show_blog_categories','display_name' => 'تصنيفات المقالات','route' => 'blog_categories','module' => 'blog_categories','as' => 'blog_categories.index','icon' => 'fas fa-folder-open','parent' => $manageBlogCategories->id,'parent_original' => $manageBlogCategories->id,'parent_show' => $manageBlogCategories->id,'sidebar_link' => '1','appear' => '1']);
Permission::create(['name' => 'create_blog_categories','display_name' => 'إنشاء تصنيف مقالات','route' => 'blog_categories/create','module' => 'blog_categories','as' => 'blog_categories.create','icon' => 'fas fa-plus-circle','parent' => $manageBlogCategories->id,'parent_original' => $manageBlogCategories->id,'parent_show' => $manageBlogCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'display_blog_categories','display_name' => 'عرض تصنيف مقالات','route' => 'blog_categories/{blog_category}','module' => 'blog_categories','as' => 'blog_categories.show','icon' => 'fas fa-eye','parent' => $manageBlogCategories->id,'parent_original' => $manageBlogCategories->id,'parent_show' => $manageBlogCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'update_blog_categories','display_name' => 'تحديث تصنيف مقالات','route' => 'blog_categories/{blog_category}/edit','module' => 'blog_categories','as' => 'blog_categories.edit','icon' => 'fas fa-edit','parent' => $manageBlogCategories->id,'parent_original' => $manageBlogCategories->id,'parent_show' => $manageBlogCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'delete_blog_categories','display_name' => 'حذف تصنيف مقالات','route' => 'blog_categories/{blog_category}','module' => 'blog_categories','as' => 'blog_categories.destroy','icon' => 'fas fa-trash','parent' => $manageBlogCategories->id,'parent_original' => $manageBlogCategories->id,'parent_show' => $manageBlogCategories->id,'sidebar_link' => '0','appear' => '0']);
// دليل المقالات
Permission::create(['name' => 'show_blog','display_name' => 'دليل المقالات','route' => 'blog','module' => 'blog','as' => 'blog.index','icon' => 'fas fa-newspaper','parent' => $manageBlogCategories->id,'parent_original' => $manageBlogCategories->id,'parent_show' => $manageBlogCategories->id,'sidebar_link' => '1','appear' => '1']);
Permission::create(['name' => 'create_blog','display_name' => 'إنشاء مقال','route' => 'blog/create','module' => 'blog','as' => 'blog.create','icon' => 'fas fa-plus-circle','parent' => $manageBlogCategories->id,'parent_original' => $manageBlogCategories->id,'parent_show' => $manageBlogCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'display_blog','display_name' => 'عرض مقال','route' => 'blog/{blog}','module' => 'blog','as' => 'blog.show','icon' => 'fas fa-eye','parent' => $manageBlogCategories->id,'parent_original' => $manageBlogCategories->id,'parent_show' => $manageBlogCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'update_blog','display_name' => 'تحديث مقال','route' => 'blog/{blog}/edit','module' => 'blog','as' => 'blog.edit','icon' => 'fas fa-edit','parent' => $manageBlogCategories->id,'parent_original' => $manageBlogCategories->id,'parent_show' => $manageBlogCategories->id,'sidebar_link' => '0','appear' => '0']);
Permission::create(['name' => 'delete_blog','display_name' => 'حذف مقال','route' => 'blog/{blog}','module' => 'blog','as' => 'blog.destroy','icon' => 'fas fa-trash','parent' => $manageBlogCategories->id,'parent_original' => $manageBlogCategories->id,'parent_show' => $manageBlogCategories->id,'sidebar_link' => '0','appear' => '0']);

// إدارة الدرر الدينية
$manageDurarDiniya = Permission::create([
    'name' => 'manage_durar_diniya',
    'display_name' => 'إدارة الدرر الدينية',
    'route' => 'durar_diniya',
    'module' => 'durar_diniya',
    'as' => 'durar_diniya.index',
    'icon' => 'fas fa-gem',
    'parent' => '0',
    'parent_original' => '0',
    'appear' => '1',
    'sidebar_link' => '1',
    'ordering' => '135'
]);

$manageDurarDiniya->parent_show = $manageDurarDiniya->id;
$manageDurarDiniya->save();

Permission::create(['name'=>'show_durar_diniya','display_name'=>'عرض الدرر الدينية','route'=>'durar_diniya','module'=>'durar_diniya','as'=>'durar_diniya.index','icon'=>'fas fa-book','parent'=>$manageDurarDiniya->id,'parent_original'=>$manageDurarDiniya->id,'parent_show'=>$manageDurarDiniya->id,'sidebar_link'=>0,'appear'=>0]);
Permission::create(['name'=>'create_durar_diniya','display_name'=>'إنشاء درّة دينية','route'=>'durar_diniya/create','module'=>'durar_diniya','as'=>'durar_diniya.create','icon'=>'fas fa-plus-circle','parent'=>$manageDurarDiniya->id,'parent_original'=>$manageDurarDiniya->id,'parent_show'=>$manageDurarDiniya->id,'sidebar_link'=>'0','appear'=>'0']);
Permission::create(['name'=>'display_durar_diniya','display_name'=>'عرض الدرة','route'=>'durar_diniya/{durar_diniya}','module'=>'durar_diniya','as'=>'durar_diniya.show','icon'=>'fas fa-eye','parent'=>$manageDurarDiniya->id,'parent_original'=>$manageDurarDiniya->id,'parent_show'=>$manageDurarDiniya->id,'sidebar_link'=>'0','appear'=>'0']);
Permission::create(['name'=>'update_durar_diniya','display_name'=>'تحديث الدرة','route'=>'durar_diniya/{durar_diniya}/edit','module'=>'durar_diniya','as'=>'durar_diniya.edit','icon'=>'fas fa-edit','parent'=>$manageDurarDiniya->id,'parent_original'=>$manageDurarDiniya->id,'parent_show'=>$manageDurarDiniya->id,'sidebar_link'=>'0','appear'=>'0']);
Permission::create(['name'=>'delete_durar_diniya','display_name'=>'حذف الدرة','route'=>'durar_diniya/{durar_diniya}','module'=>'durar_diniya','as'=>'durar_diniya.destroy','icon'=>'fas fa-trash','parent'=>$manageDurarDiniya->id,'parent_original'=>$manageDurarDiniya->id,'parent_show'=>$manageDurarDiniya->id,'sidebar_link'=>'0','appear'=>'0']);





// إدارة الكتب والمؤلفات
$manageBooks = Permission::create([
    'name' => 'manage_books',
    'display_name' => 'إدارة الكتب والمؤلفات',
    'route' => 'books',
    'module' => 'books',
    'as' => 'books.index',
    'icon' => 'fas fa-book-open',
    'parent' => '0',
    'parent_original' => '0',
    'appear' => '1',
    'sidebar_link' => '1',
    'ordering' => '140'
]);

$manageBooks->parent_show = $manageBooks->id;
$manageBooks->save();

Permission::create(['name'=>'show_books','display_name'=>'عرض الكتب والمؤلفات','route'=>'books','module'=>'books','as'=>'books.index','icon'=>'fas fa-book','parent'=>$manageBooks->id,'parent_original'=>$manageBooks->id,'parent_show'=>$manageBooks->id,'sidebar_link'=>0,'appear'=>0]);
Permission::create(['name'=>'create_book','display_name'=>'إنشاء كتاب/مؤلف','route'=>'books/create','module'=>'books','as'=>'books.create','icon'=>'fas fa-plus-circle','parent'=>$manageBooks->id,'parent_original'=>$manageBooks->id,'parent_show'=>$manageBooks->id,'sidebar_link'=>'0','appear'=>'0']);
Permission::create(['name'=>'display_book','display_name'=>'عرض الكتاب/المؤلف','route'=>'books/{book}','module'=>'books','as'=>'books.show','icon'=>'fas fa-eye','parent'=>$manageBooks->id,'parent_original'=>$manageBooks->id,'parent_show'=>$manageBooks->id,'sidebar_link'=>'0','appear'=>'0']);
Permission::create(['name'=>'update_book','display_name'=>'تحديث الكتاب/المؤلف','route'=>'books/{book}/edit','module'=>'books','as'=>'books.edit','icon'=>'fas fa-edit','parent'=>$manageBooks->id,'parent_original'=>$manageBooks->id,'parent_show'=>$manageBooks->id,'sidebar_link'=>'0','appear'=>'0']);
Permission::create(['name'=>'delete_book','display_name'=>'حذف الكتاب/المؤلف','route'=>'books/{book}','module'=>'books','as'=>'books.destroy','icon'=>'fas fa-trash','parent'=>$manageBooks->id,'parent_original'=>$manageBooks->id,'parent_show'=>$manageBooks->id,'sidebar_link'=>'0','appear'=>'0']);

// إدارة روابط تهمك
$manageUsefulLinks = Permission::create([
    'name' => 'manage_useful_links',
    'display_name' => ' روابط تهمك',
    'route' => 'useful_links',
    'module' => 'useful_links',
    'as' => 'useful_links.index',
    'icon' => 'fas fa-link',
    'parent' => '0',
    'parent_original' => '0',
    'appear' => '1',
    'sidebar_link' => '1',
    'ordering' => '145'
]);

$manageUsefulLinks->parent_show = $manageUsefulLinks->id;
$manageUsefulLinks->save();

Permission::create(['name'=>'show_useful_links','display_name'=>'عرض روابط تهمك','route'=>'useful_links','module'=>'useful_links','as'=>'useful_links.index','icon'=>'fas fa-link','parent'=>$manageUsefulLinks->id,'parent_original'=>$manageUsefulLinks->id,'parent_show'=>$manageUsefulLinks->id,'sidebar_link'=>0,'appear'=>0]);
Permission::create(['name'=>'create_useful_link','display_name'=>'إنشاء رابط','route'=>'useful_links/create','module'=>'useful_links','as'=>'useful_links.create','icon'=>'fas fa-plus-circle','parent'=>$manageUsefulLinks->id,'parent_original'=>$manageUsefulLinks->id,'parent_show'=>$manageUsefulLinks->id,'sidebar_link'=>'0','appear'=>'0']);
Permission::create(['name'=>'display_useful_link','display_name'=>'عرض الرابط','route'=>'useful_links/{useful_link}','module'=>'useful_links','as'=>'useful_links.show','icon'=>'fas fa-eye','parent'=>$manageUsefulLinks->id,'parent_original'=>$manageUsefulLinks->id,'parent_show'=>$manageUsefulLinks->id,'sidebar_link'=>'0','appear'=>'0']);
Permission::create(['name'=>'update_useful_link','display_name'=>'تحديث الرابط','route'=>'useful_links/{useful_link}/edit','module'=>'useful_links','as'=>'useful_links.edit','icon'=>'fas fa-edit','parent'=>$manageUsefulLinks->id,'parent_original'=>$manageUsefulLinks->id,'parent_show'=>$manageUsefulLinks->id,'sidebar_link'=>'0','appear'=>'0']);
Permission::create(['name'=>'delete_useful_link','display_name'=>'حذف الرابط','route'=>'useful_links/{useful_link}','module'=>'useful_links','as'=>'useful_links.destroy','icon'=>'fas fa-trash','parent'=>$manageUsefulLinks->id,'parent_original'=>$manageUsefulLinks->id,'parent_show'=>$manageUsefulLinks->id,'sidebar_link'=>'0','appear'=>'0']);


// إدارة صفحات الشيخ
$manageSheikhPages = Permission::create([
    'name' => 'manage_sheikh_pages',
    'display_name' => ' صفحات الشيخ',
    'route' => 'sheikh_pages',
    'module' => 'sheikh_pages',
    'as' => 'sheikh_pages.index',
    'icon' => 'fas fa-file-alt',
    'parent' => '0',
    'parent_original' => '0',
    'appear' => '1',
    'sidebar_link' => '1',
    'ordering' => '5'
]);

$manageSheikhPages->parent_show = $manageSheikhPages->id;
$manageSheikhPages->save();

Permission::create(['name'=>'show_sheikh_pages','display_name'=>'عرض صفحات الشيخ','route'=>'sheikh_pages','module'=>'sheikh_pages','as'=>'sheikh_pages.index','icon'=>'fas fa-book','parent'=>$manageSheikhPages->id,'parent_original'=>$manageSheikhPages->id,'parent_show'=>$manageSheikhPages->id,'sidebar_link'=>0,'appear'=>0]);
Permission::create(['name'=>'create_sheikh_page','display_name'=>'إنشاء صفحة الشيخ','route'=>'sheikh_pages/create','module'=>'sheikh_pages','as'=>'sheikh_pages.create','icon'=>'fas fa-plus-circle','parent'=>$manageSheikhPages->id,'parent_original'=>$manageSheikhPages->id,'parent_show'=>$manageSheikhPages->id,'sidebar_link'=>'0','appear'=>'0']);
Permission::create(['name'=>'display_sheikh_page','display_name'=>'عرض صفحة الشيخ','route'=>'sheikh_pages/{sheikh_page}','module'=>'sheikh_pages','as'=>'sheikh_pages.show','icon'=>'fas fa-eye','parent'=>$manageSheikhPages->id,'parent_original'=>$manageSheikhPages->id,'parent_show'=>$manageSheikhPages->id,'sidebar_link'=>'0','appear'=>'0']);
Permission::create(['name'=>'update_sheikh_page','display_name'=>'تحديث صفحة الشيخ','route'=>'sheikh_pages/{sheikh_page}/edit','module'=>'sheikh_pages','as'=>'sheikh_pages.edit','icon'=>'fas fa-edit','parent'=>$manageSheikhPages->id,'parent_original'=>$manageSheikhPages->id,'parent_show'=>$manageSheikhPages->id,'sidebar_link'=>'0','appear'=>'0']);
Permission::create(['name'=>'delete_sheikh_page','display_name'=>'حذف صفحة الشيخ','route'=>'sheikh_pages/{sheikh_page}','module'=>'sheikh_pages','as'=>'sheikh_pages.destroy','icon'=>'fas fa-trash','parent'=>$manageSheikhPages->id,'parent_original'=>$manageSheikhPages->id,'parent_show'=>$manageSheikhPages->id,'sidebar_link'=>'0','appear'=>'0']);



// إدارة نبذة عن الشيخ
$manageSheikhIntro = Permission::create([
    'name' => 'manage_sheikh_intro',
    'display_name' => 'نبذة عن الشيخ',
    'route' => 'sheikh_intro',
    'module' => 'sheikh_intro',
    'as' => 'sheikh_intro.index',
    'icon' => 'fas fa-user-tie',
    'parent' => '0',
    'parent_original' => '0',
    'appear' => '1',
    'sidebar_link' => '1',
    'ordering' => '10'
]);

$manageSheikhIntro->parent_show = $manageSheikhIntro->id;
$manageSheikhIntro->save();

Permission::create(['name'=>'show_sheikh_intro','display_name'=>'عرض نبذة الشيخ','route'=>'sheikh_intro','module'=>'sheikh_intro','as'=>'sheikh_intro.index','icon'=>'fas fa-book','parent'=>$manageSheikhIntro->id,'parent_original'=>$manageSheikhIntro->id,'parent_show'=>$manageSheikhIntro->id,'sidebar_link'=>0,'appear'=>0]);
Permission::create(['name'=>'create_sheikh_intro','display_name'=>'إنشاء نبذة الشيخ','route'=>'sheikh_intro/create','module'=>'sheikh_intro','as'=>'sheikh_intro.create','icon'=>'fas fa-plus-circle','parent'=>$manageSheikhIntro->id,'parent_original'=>$manageSheikhIntro->id,'parent_show'=>$manageSheikhIntro->id,'sidebar_link'=>0,'appear'=>0]);
Permission::create(['name'=>'display_sheikh_intro','display_name'=>'عرض نبذة الشيخ','route'=>'sheikh_intro/{sheikh_intro}','module'=>'sheikh_intro','as'=>'sheikh_intro.show','icon'=>'fas fa-eye','parent'=>$manageSheikhIntro->id,'parent_original'=>$manageSheikhIntro->id,'parent_show'=>$manageSheikhIntro->id,'sidebar_link'=>0,'appear'=>0]);
Permission::create(['name'=>'update_sheikh_intro','display_name'=>'تحديث نبذة الشيخ','route'=>'sheikh_intro/{sheikh_intro}/edit','module'=>'sheikh_intro','as'=>'sheikh_intro.edit','icon'=>'fas fa-edit','parent'=>$manageSheikhIntro->id,'parent_original'=>$manageSheikhIntro->id,'parent_show'=>$manageSheikhIntro->id,'sidebar_link'=>0,'appear'=>0]);
Permission::create(['name'=>'delete_sheikh_intro','display_name'=>'حذف نبذة الشيخ','route'=>'sheikh_intro/{sheikh_intro}','module'=>'sheikh_intro','as'=>'sheikh_intro.destroy','icon'=>'fas fa-trash','parent'=>$manageSheikhIntro->id,'parent_original'=>$manageSheikhIntro->id,'parent_show'=>$manageSheikhIntro->id,'sidebar_link'=>0,'appear'=>0]);




$manageSlider = Permission::create([
    'name' => 'manage_main_sliders',
    'display_name' => 'إدارة عارض الشرائح',
    'route' => 'main_sliders',
    'module' => 'main_sliders',
    'as' => 'main_sliders.index',
    'icon' => 'fas fa-images',
    'parent' => 0,
    'parent_original' => 0,
    'appear' => 1,
    'sidebar_link' => 1,
    'ordering' => 11,
]);

$manageSlider->parent_show = $manageSlider->id;
$manageSlider->save();


Permission::create([
    'name' => 'show_main_sliders',
    'display_name' => 'عرض قائمة السلايدر',
    'route' => 'main_sliders',
    'module' => 'main_sliders',
    'as' => 'main_sliders.index',
    'icon' => 'fas fa-book',
    'parent' => $manageSlider->id,
    'parent_original' => $manageSlider->id,
    'parent_show' => $manageSlider->id,
    'sidebar_link' => 0,
    'appear' => 0
]);

Permission::create([
    'name' => 'create_main_sliders',
    'display_name' => 'إنشاء سلايدر',
    'route' => 'main_sliders/create',
    'module' => 'main_sliders',
    'as' => 'main_sliders.create',
    'icon' => 'fas fa-plus-circle',
    'parent' => $manageSlider->id,
    'parent_original' => $manageSlider->id,
    'parent_show' => $manageSlider->id,
    'sidebar_link' => 0,
    'appear' => 0
]);

Permission::create([
    'name' => 'display_main_sliders',
    'display_name' => 'عرض سلايدر (تفاصيل)',
    'route' => 'main_sliders/{main_sliders}',
    'module' => 'main_sliders',
    'as' => 'main_sliders.show',
    'icon' => 'fas fa-eye',
    'parent' => $manageSlider->id,
    'parent_original' => $manageSlider->id,
    'parent_show' => $manageSlider->id,
    'sidebar_link' => 0,
    'appear' => 0
]);

Permission::create([
    'name' => 'update_main_sliders',
    'display_name' => 'تعديل سلايدر',
    'route' => 'main_sliders/{main_sliders}/edit',
    'module' => 'main_sliders',
    'as' => 'main_sliders.edit',
    'icon' => 'fas fa-edit',
    'parent' => $manageSlider->id,
    'parent_original' => $manageSlider->id,
    'parent_show' => $manageSlider->id,
    'sidebar_link' => 0,
    'appear' => 0
]);

Permission::create([
    'name' => 'delete_main_sliders',
    'display_name' => 'حذف سلايدر',
    'route' => 'main_sliders/{main_sliders}',
    'module' => 'main_sliders',
    'as' => 'main_sliders.destroy',
    'icon' => 'fas fa-trash',
    'parent' => $manageSlider->id,
    'parent_original' => $manageSlider->id,
    'parent_show' => $manageSlider->id,
    'sidebar_link' => 0,
    'appear' => 0
]);


Permission::create([
    'name' => 'toggle_status_main_sliders',
    'display_name' => 'تبديل حالة السلايدر',
    'route' => 'main_sliders/toggle-status',
    'module' => 'main_sliders',
    'as' => 'main_sliders.toggleStatus',
    'icon' => 'fas fa-exchange-alt',
    'parent' => $manageSlider->id,
    'parent_original' => $manageSlider->id,
    'parent_show' => $manageSlider->id,
    'sidebar_link' => 0,
    'appear' => 0
]);

Permission::create([
    'name' => 'remove_image_main_sliders',
    'display_name' => 'حذف صورة السلايدر',
    'route' => 'main_sliders/remove-image',
    'module' => 'main_sliders',
    'as' => 'main_sliders.remove_image',
    'icon' => 'fas fa-image',
    'parent' => $manageSlider->id,
    'parent_original' => $manageSlider->id,
    'parent_show' => $manageSlider->id,
    'sidebar_link' => 0,
    'appear' => 0
]);
// Site Settings Holder
$manageSiteSettings = Permission::create([
    'name' => 'manage_site_settings',
    'display_name' => 'الاعدادات العامة',
    'route' => 'settings',
    'module' => 'settings',
    'as' => 'settings.index',
    'icon' => 'fa fa-cog',
    'parent' => 0,
    'parent_original' => 0,
    'sidebar_link' => 1,
    'appear' => 1,
    'ordering' => 180
]);
$manageSiteSettings->parent_show = $manageSiteSettings->id;
$manageSiteSettings->save();

// Site Infos
$displaySiteInfos = Permission::create([
    'name' => 'display_site_infos',
    'display_name' => 'إدارة بيانات الموقع',
    'route' => 'settings.site_infos',
    'module' => 'settings',
    'as' => 'settings.site_infos.show',
    'icon' => 'fa fa-info-circle',
    'parent' => $manageSiteSettings->id,
    'parent_original' => $manageSiteSettings->id,
    'parent_show' => $manageSiteSettings->id,
    'sidebar_link' => 1,
    'appear' => 1,
    'ordering' => 1
]);

$updateSiteInfos = Permission::create([
    'name' => 'update_site_infos',
    'display_name' => 'تعديل بيانات الموقع',
    'route' => 'settings.site_infos',
    'module' => 'settings',
    'as' => 'settings.site_infos.edit',
    'icon' => null,
    'parent' => $manageSiteSettings->id,
    'parent_original' => $manageSiteSettings->id,
    'parent_show' => $manageSiteSettings->id,
    'sidebar_link' => 0,
    'appear' => 0
]);

// Site Contacts
$displaySiteContacts = Permission::create([
    'name' => 'display_site_contacts',
    'display_name' => 'إدارة بيانات الاتصال',
    'route' => 'settings.site_contacts',
    'module' => 'settings',
    'as' => 'settings.site_contacts.show',
    'icon' => 'fa fa-address-book',
    'parent' => $manageSiteSettings->id,
    'parent_original' => $manageSiteSettings->id,
    'parent_show' => $manageSiteSettings->id,
    'sidebar_link' => 1,
    'appear' => 1,
    'ordering' => 2
]);

$updateSiteContacts = Permission::create([
    'name' => 'update_site_contacts',
    'display_name' => 'تعديل بيانات الاتصال',
    'route' => 'settings.site_contacts',
    'module' => 'settings',
    'as' => 'settings.site_contacts.edit',
    'icon' => null,
    'parent' => $manageSiteSettings->id,
    'parent_original' => $manageSiteSettings->id,
    'parent_show' => $manageSiteSettings->id,
    'sidebar_link' => 0,
    'appear' => 0
]);

// Site Socials
$displaySiteSocials = Permission::create([
    'name' => 'display_site_socials',
    'display_name' => 'إدارة حسابات التواصل',
    'route' => 'settings.site_socials',
    'module' => 'settings',
    'as' => 'settings.site_socials.show',
    'icon' => 'fas fa-rss',
    'parent' => $manageSiteSettings->id,
    'parent_original' => $manageSiteSettings->id,
    'parent_show' => $manageSiteSettings->id,
    'sidebar_link' => 1,
    'appear' => 1,
    'ordering' => 3
]);

$updateSiteSocials = Permission::create([
    'name' => 'update_site_socials',
    'display_name' => 'تعديل حسابات التواصل',
    'route' => 'settings.site_socials',
    'module' => 'settings',
    'as' => 'settings.site_socials.edit',
    'icon' => null,
    'parent' => $manageSiteSettings->id,
    'parent_original' => $manageSiteSettings->id,
    'parent_show' => $manageSiteSettings->id,
    'sidebar_link' => 0,
    'appear' => 0
]);

// Site Status & Maintenance (Section 4)
$displaySiteStatus = Permission::create([
    'name' => 'display_site_status',
    'display_name' => 'إدارة حالة الموقع',
    'route' => 'settings.site_status',
    'module' => 'settings',
    'as' => 'settings.site_status.show',
    'icon' => 'fa fa-power-off',
    'parent' => $manageSiteSettings->id,
    'parent_original' => $manageSiteSettings->id,
    'parent_show' => $manageSiteSettings->id,
    'sidebar_link' => 1,
    'appear' => 1,
    'ordering' => 4
]);

$updateSiteStatus = Permission::create([
    'name' => 'update_site_status',
    'display_name' => 'تعديل حالة الموقع',
    'route' => 'settings.site_status',
    'module' => 'settings',
    'as' => 'settings.site_status.edit',
    'icon' => null,
    'parent' => $manageSiteSettings->id,
    'parent_original' => $manageSiteSettings->id,
    'parent_show' => $manageSiteSettings->id,
    'sidebar_link' => 0,
    'appear' => 0
]);

// Site Style (Section 5)
$displaySiteStyle = Permission::create([
    'name' => 'display_site_style',
    'display_name' => 'إدارة ستايل الموقع',
    'route' => 'settings.site_style',
    'module' => 'settings',
    'as' => 'settings.site_style.show',
    'icon' => 'fa fa-paint-brush',
    'parent' => $manageSiteSettings->id,
    'parent_original' => $manageSiteSettings->id,
    'parent_show' => $manageSiteSettings->id,
    'sidebar_link' => 1,
    'appear' => 1,
    'ordering' => 5
]);

$updateSiteStyle = Permission::create([
    'name' => 'update_site_style',
    'display_name' => 'تعديل ستايل الموقع',
    'route' => 'settings.site_style',
    'module' => 'settings',
    'as' => 'settings.site_style.edit',
    'icon' => null,
    'parent' => $manageSiteSettings->id,
    'parent_original' => $manageSiteSettings->id,
    'parent_show' => $manageSiteSettings->id,
    'sidebar_link' => 0,
    'appear' => 0
]);

// Site SEO
$displaySiteMetas = Permission::create([
    'name' => 'display_site_meta',
    'display_name' => 'إدارة SEO',
    'route' => 'settings.site_meta',
    'module' => 'settings',
    'as' => 'settings.site_meta.show',
    'icon' => 'fa fa-tag',
    'parent' => $manageSiteSettings->id,
    'parent_original' => $manageSiteSettings->id,
    'parent_show' => $manageSiteSettings->id,
    'sidebar_link' => 1,
    'appear' => 1,
    'ordering' => 6
]);

$updateSiteMetas = Permission::create([
    'name' => 'update_site_meta',
    'display_name' => 'تعديل SEO',
    'route' => 'settings.site_meta',
    'module' => 'settings',
    'as' => 'settings.site_meta.edit',
    'icon' => null,
    'parent' => $manageSiteSettings->id,
    'parent_original' => $manageSiteSettings->id,
    'parent_show' => $manageSiteSettings->id,
    'sidebar_link' => 0,
    'appear' => 0
]);


}
}