<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        // القسم 1: بيانات الموقع
        SiteSetting::create([
            'key' => 'site_name',
            'value' => 'الموقع الرسمي لفضيلة الشيخ ابي الحسن علي بن محمد بن عبده المطري',
            'status' => true,
            'section' => 1,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_description',
            'value' => 'الموقع الرسمي لفضيلة الشيخ ابي الحسن علي بن محمد بن عبده المطري',
            'status' => true,
            'section' => 1,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_keywords',
            'value' => ' الشيخ,  علي, المطري, علي المطري ,اسلامية,  اسلامي',
            'status' => true,
            'section' => 1,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_link',
            'value' => 'http://www.sh-alialmatry.com/',
            'status' => true,
            'section' => 1,
            'published_on' => $faker->dateTime()
        ]);

        // القسم 2: بيانات التواصل
        SiteSetting::create([
            'key' => 'site_address',
            'value' => 'اليمن - اب - ذي السفال',
            'status' => true,
            'section' => 2,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_phone',
            'value' => '04434627',
            'status' => true,
            'section' => 2,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_mobile',
            'value' => '967779531500',
            'status' => true,
            'section' => 2,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_fax',
            'value' => '330059',
            'status' => true,
            'section' => 2,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_email',
            'value' => 'contact@sh-alialmatry.com',
            'status' => true,
            'section' => 2,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_workTime',
            'value' => '#',
            'status' => true,
            'section' => 2,
            'published_on' => $faker->dateTime()
        ]);

        // القسم 3: وسائل التواصل الاجتماعي
        SiteSetting::create([
            'key' => 'site_facebook',
            'value' => 'https://www.facebook.com/shalialmatry',
            'status' => true,
            'section' => 3,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_twitter',
            'value' => '0',
            'status' => true,
            'section' => 3,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_whatsapp',
            'value' => 'https://wa.me/123456789',
            'status' => true,
            'section' => 3,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_linkedin',
            'value' => 'https://linkedin.com/company/yourcompany',
            'status' => true,
            'section' => 3,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_instagram',
            'value' => 'https://www.instagram.com/shalialmatry/',
            'status' => true,
            'section' => 3,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_snapchat',
            'value' => 'https://www.snapchat.com/add/shalialmatry?share_id=71-coE4W4_U&locale=ar-SA',
            'status' => true,
            'section' => 3,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_youtube',
            'value' => 'https://www.youtube.com/@shalialmatry',
            'status' => true,
            'section' => 3,
            'published_on' => $faker->dateTime()
        ]);

        // القسم 4: حالة الموقع
        SiteSetting::create([
            'key' => 'site_status',
            'value' => 'active',
            'status' => true,
            'section' => 4,
            'published_on' => $faker->dateTime()
        ]);

        // القسم 5: تنسيقات الموقع (شعارات)
        SiteSetting::create([
            'key' => 'site_logo_light',
            'value' => 'logo_light.png',
            'status' => true,
            'section' => 5,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_logo_dark',
            'value' => 'logo_dark.png',
            'status' => true,
            'section' => 5,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_favicon',
            'value' => 'favicon.ico',
            'status' => true,
            'section' => 5,
            'published_on' => $faker->dateTime()
        ]);

        // القسم 6: إعدادات محركات البحث (SEO)
        SiteSetting::create([
            'key' => 'site_name_meta',
            'value' => 'الموقع الرسمي لفضيلة الشيخ ابي الحسن علي بن محمد بن عبده المطري',
            'status' => true,
            'section' => 6,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_description_meta',
            'value' => 'الموقع الرسمي لفضيلة الشيخ ابي الحسن علي بن محمد بن عبده المطري',
            'status' => true,
            'section' => 6,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_link_meta',
            'value' => 'https://www.sh-alialmatry.com/',
            'status' => true,
            'section' => 6,
            'published_on' => $faker->dateTime()
        ]);
        SiteSetting::create([
            'key' => 'site_keywords_meta',
            'value' => ' الشيخ,  علي, المطري, علي المطري ,اسلامية,  اسلامي',
            'status' => true,
            'section' => 6,
            'published_on' => $faker->dateTime()
        ]);
    }
}
