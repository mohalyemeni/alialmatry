<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('imageable_id');
            $table->string('imageable_type');
            $table->string('file_name');
            $table->string('thumb_name')->nullable(); // لإسم الصورة المصغرة
            $table->bigInteger('file_size')->nullable();
            $table->string('file_type')->nullable();
            $table->integer('file_sort')->default(0);
            $table->boolean('file_status')->default(true); // Boolean بدل String
            $table->timestamps();

            $table->index(['imageable_id', 'imageable_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('photos');
    }
};