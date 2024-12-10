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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();            
            $table->text('title');
            $table->text('slug');
            $table->longText('description')->nullable();
            $table->mediumText('short_description')->nullable();
            $table->integer('featured_image')->nullable(); 
            $table->tinyInteger('is_featured')->default(0);
            $table->bigInteger('author_id')->default(1);
            $table->enum('status', array('draft','published'))->default('draft');
            $table->mediumText('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->integer('meta_img')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
