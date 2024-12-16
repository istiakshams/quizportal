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
        Schema::create('poll_choices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('poll_id');
            $table->integer('votes')->default(0);
            $table->timestamps();
            
            $table->foreign('poll_id')->references('id')->on('polls');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poll_choices');
    }
};
