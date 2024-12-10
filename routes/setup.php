<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Setup\SetupController;

/*
|--------------------------------------------------------------------------
| Setup Routes
|--------------------------------------------------------------------------
|
| These routes are responsible for handling the setup process
| 
*/

Route::get('/', [SetupController::class, 'index'])->name('installation.index');
Route::get('/checklist', [SetupController::class, 'checklist'])->name('installation.checklist');

Route::get('/database-setup/{error?}', [SetupController::class, 'databaseSetup'])->name('installation.dbSetup');
Route::post('/database-setup', [SetupController::class, 'storeDatabaseSetup'])->name('installation.storeDbSetup');

Route::get('/db-migration', [SetupController::class, 'dbMigration'])->name('installation.migration');
Route::get('/run-db-migration/{demo?}', [SetupController::class, 'runDbMigration'])->name('installation.runMigration');

Route::get('/admin-configuration', [SetupController::class, 'storeAdminForm'])->name('installation.storeAdminForm');
Route::post('/admin-configuration', [SetupController::class, 'storeAdmin'])->name('installation.storeAdmin');
