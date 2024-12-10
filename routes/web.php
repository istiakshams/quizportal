<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\FrontController;
use App\Http\Controllers\Frontend\Blog\BlogController;
use App\Http\Controllers\Frontend\ProfileController;

use App\Http\Controllers\MediaManagerController;
use App\Http\Controllers\ErrorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

# media files routes
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('/media-manager/get-files', [MediaManagerController::class, 'index'])->name('uppy.index');
    Route::get('/media-manager/get-selected-files', [MediaManagerController::class, 'selectedFiles'])->name('uppy.selectedFiles');
    Route::post('/media-manager/add-files', [MediaManagerController::class, 'store'])->name('uppy.store');
    Route::get('/media-manager/delete-files/{id}', [MediaManagerController::class, 'delete'])->name('uppy.delete');
});

#blogs
Route::get('/blog', [BlogController::class, 'index'])->name('blog.archive');
Route::get('/blog/category/{slug}', [BlogController::class, 'categoryArchive'])->name('blog.category');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

#homepage
Route::get('/', [FrontController::class, 'showHomePage'])->name('home');

#default pages
Route::get('/home-page', [FrontController::class, 'showHomePage'])->name('homepage');
Route::get('/contact-us', [FrontController::class, 'showContactUs'])->name('contact.us');
Route::post('/contact-us', [FrontController::class, 'sendContactUs'])->name('contact.us.send');
Route::get('/contact-us-ajax', [FrontController::class, 'sendContactUsAjax'])->name('contact.us.ajax');
Route::post('/contact-us-ajax', [FrontController::class, 'sendContactUsAjax'])->name('contact.us.getajax');
Route::get('/about-us', [FrontController::class, 'showAboutUs'])->name('about.us');
Route::get('/privacy-policy', [FrontController::class, 'showPrivacyPolicy'])->name('privacy.policy');
Route::get('/terms-and-conditions', [FrontController::class, 'showTOS'])->name('terms.conditions');

#profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/update-profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

#pages
Route::get('/page/{slug}', [FrontController::class, 'showPage'])->name('home.pages.show');

Route::get('404', [ErrorController::class, 'notfound'])->name('error.404');
Route::get('500', [ErrorController::class, 'fatal'])->name('error.fatal');
