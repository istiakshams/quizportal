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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();            
            $table->text('title');
            $table->text('slug');
            $table->longText('content')->nullable();
            $table->text('thumbnail_image')->nullable();
            $table->enum('status', array('draft','published'))->default('draft');
            $table->mediumText('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->text('meta_img')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
