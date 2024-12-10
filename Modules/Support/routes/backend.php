<?php

use Illuminate\Support\Facades\Route;
use Modules\Support\Http\Controllers\Backend\SupportController;

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
    Route::resource('support', SupportController::class)->names('admin.support');
});
