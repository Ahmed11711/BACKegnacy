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
        Schema::create('page_images', function (Blueprint $table) {
            $table->id();
            $table->string('page_key'); // hero, about, etc.
            $table->string('image_key'); // hero_background, about_main_image, etc.
            $table->string('image_path');
            $table->string('alt_text_en')->nullable();
            $table->string('alt_text_ar')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['page_key', 'image_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_images');
    }
};
