<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
     Schema::create('audios', function (Blueprint $table) {
        $table->id();
        $table->string('title')->unique();
        $table->string('slug')->unique();
        $table->text('description')->nullable();
        $table->string('img');

        $table->unsignedBigInteger('category_id');
        $table->string('audio_file');

        $table->text('meta_keywords')->nullable();
        $table->text('meta_description')->nullable();
        $table->string('meta_slug')->nullable();

        $table->timestamp('published_on')->nullable()->useCurrent();

        $table->unsignedBigInteger('created_by')->nullable();
        $table->unsignedBigInteger('updated_by')->nullable();

        $table->bigInteger('views')->default(0);
        $table->boolean('status')->default(true);

        $table->softDeletes();
        $table->timestamps();

        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audios');
    }
};
