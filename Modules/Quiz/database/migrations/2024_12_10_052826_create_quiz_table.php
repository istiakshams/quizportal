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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('slug');
            $table->longText('description')->nullable();
            $table->integer('image')->nullable();
            $table->integer('category_id');
            $table->enum('type', array('trivia','personality'))->default('quiz');
            $table->enum('no_of_results', array('3','4', '5'))->default('4');
            $table->tinyInteger('is_featured')->default(0);
            $table->bigInteger('author_id')->default(1);
            $table->enum('status', array('draft','published','scheduled'))->default('draft');                        
            $table->mediumText('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->integer('meta_img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz');
    }
};
