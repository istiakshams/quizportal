<?php

use Illuminate\Support\Facades\Route;
use Modules\Quiz\Http\Controllers\Backend\QuizController;
use Modules\Quiz\Http\Controllers\Backend\QuizCategoryController;
use Modules\Quiz\Http\Controllers\Backend\QuestionController;
use Modules\Quiz\Http\Controllers\Backend\PollController;
use Modules\Quiz\Http\Controllers\Backend\PollChoiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group( ['prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {
    Route::resource('quizzes/categories', QuizCategoryController::class)->names('admin.quizzes.categories');
    Route::resource('quizzes', QuizController::class)->names('quizzes');
    Route::get('quizzes/{quiz_id}/questions', [QuestionController::class, 'index'])->name('quizzes.questions');
    Route::resource('questions', QuestionController::class)->names('questions');

    Route::resource('polls', PollController::class)->names('polls');
    Route::resource('pollchoices', PollChoiceController::class)->names('admin.pollchoices');
});



