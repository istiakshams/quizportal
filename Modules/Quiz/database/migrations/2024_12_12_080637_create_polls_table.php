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
        Schema::create('polls', function (Blueprint $table) {
            $table->id();                        
            $table->string('question');
            $table->integer('image')->nullable();
            $table->integer('maxCheck')->default(0);
            $table->boolean('canVisitorsVote')->default(0);
            $table->bigInteger('author_id')->default(1);
            $table->enum('status', array('draft','published','closed'))->default('draft');                        
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
        Schema::dropIfExists('polls');
    }
};
