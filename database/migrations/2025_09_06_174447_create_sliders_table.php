<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();

            // محتويات متعددة اللغات مخزنة كـ JSON
            $table->json('title');
            $table->string('slug')->nullable()->unique();
            $table->json('subtitle')->nullable();
            $table->json('description')->nullable();

            // صورة ورمز
            $table->string('img')->nullable();
            $table->string('icon')->nullable();

            // زر — نص + رابط (قد تُرجَع لاحقًا إلى JSON بعدة لغات)
            $table->json('btn_title')->nullable();
            $table->json('url')->nullable();
            $table->boolean('show_btn_title')->default(true);

            // سلوك الرابط
            $table->string('target')->default('_self');

            // Section: 1 = main slider, 2 = advertiser, ...
            $table->unsignedTinyInteger('section')->default(1);

            $table->boolean('show_info')->default(true);

            // SEO
            $table->json('metadata_title')->nullable();
            $table->json('metadata_description')->nullable();
            $table->json('metadata_keywords')->nullable();

            // الحقول الأساسية
            $table->boolean('status')->default(true);

            // تاريخ النشر: nullable — إن أردت أن يتم عرضه فور الإنشاء ضع useCurrent()
            $table->timestamp('published_on')->nullable();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            // فهارس مهمة لتحسين البحث/الترتيب
            $table->index('section');
            $table->index('status');
            $table->index('published_on');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};