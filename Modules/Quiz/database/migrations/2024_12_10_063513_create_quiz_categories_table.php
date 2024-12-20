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
        Schema::create('quiz_categories', function (Blueprint $table) {
            $table->id();                        
            $table->string('name');
            $table->string('slug');
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
        Schema::dropIfExists('quiz_categories');
    }
};
