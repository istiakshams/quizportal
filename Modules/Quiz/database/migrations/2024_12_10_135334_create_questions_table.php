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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();                        
            $table->integer('quiz_id')->nullable();
            $table->text('question');
            $table->text('answer_1_text');
            $table->integer('answer_1_image')->nullable();
            $table->text('answer_2_text');
            $table->integer('answer_2_image')->nullable();
            $table->text('answer_3_text');
            $table->integer('answer_3_image')->nullable();
            $table->text('answer_4_text')->nullable();
            $table->integer('answer_4_image')->nullable();
            $table->text('answer_5_text')->nullable();
            $table->integer('answer_5_image')->nullable();
            $table->enum('correct_answer', array('1','2','3','4', '5'))->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
