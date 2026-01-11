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
        Schema::create('page_content', function (Blueprint $table) {
            $table->id();
            $table->string('page_key'); // hero, about, mission, services, portfolio, testimonials, why_us, footer
            $table->string('section_key'); // badge, title1, title2, title3, subtitle, label, etc.
            $table->text('content_en')->nullable();
            $table->text('content_ar')->nullable();
            $table->string('type')->default('text'); // text, image, json
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->softDeletes();
            
            $table->unique(['page_key', 'section_key']);
            $table->index('page_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_content');
    }
};
