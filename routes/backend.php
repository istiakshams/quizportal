<?php
# Backend Routes
use App\Http\Controllers\Backend\Dashboard\DashboardController;

use App\Http\Controllers\Backend\Blog\BlogController;
use App\Http\Controllers\Backend\Blog\BlogCategoryController;
use App\Http\Controllers\Backend\Page\PageController;
use App\Http\Controllers\Backend\MediaManager\MediaManagerController;
use App\Http\Controllers\Backend\Newsletter\NewsletterController;

use App\Http\Controllers\Backend\Members\MemberController;
use App\Http\Controllers\Backend\Members\PermissionController;
use App\Http\Controllers\Backend\Members\RoleController;

use App\Http\Controllers\Backend\Report\SubscriptionReportController;
use App\Http\Controllers\Backend\Appearance\ThemeSettingsController;
use App\Http\Controllers\Backend\SystemSettings\SystemSettingsController;
use App\Http\Controllers\Backend\Language\LanguageController;
use App\Http\Controllers\Backend\Advertisement\AdvertisementController;
use App\Http\Controllers\Backend\Module\ModuleController;
use App\Http\Controllers\Backend\Utility\UtilityController;


Route::group( ['prefix' => 'admin', 'middleware' => ['auth', 'role:Admin|Staff|Teacher']], function () {
      
  Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

});

Route::group( ['prefix' => 'admin', 'middleware' => ['auth', 'role:Admin|Staff']], function () {
      
  # blogs      
  Route::resource('blogs', BlogController::class);
  Route::post('blog-categories/set-default/{id}', [BlogCategoryController::class, 'setDefault']);
  Route::resource('blog-categories', BlogCategoryController::class);
  
  # pages
  Route::resource('pages', PageController::class);

  # media manager
  Route::resource('media-manager', MediaManagerController::class);

  # reports
  Route::get('reports/subscription-report', [SubscriptionReportController::class, 'showSubscriptionReport']);
});

Route::group( ['prefix' => 'admin', 'middleware' => ['auth', 'role:Admin']], function () {

  # newsletters
  Route::get('newsletters/send-newsletter', [NewsletterController::class, 'showHeaderSettings']);
  Route::get('newsletters/subscribers', [NewsletterController::class, 'storeHeaderSetting']);

  # members
  Route::resource('members/roles', RoleController::class);
  Route::resource('members/permissions', PermissionController::class);
  Route::get('members/list/{role}', [MemberController::class, 'list']);
  Route::resource('members', MemberController::class);

  # appearance
  Route::get('appearance/theme-settings', [ThemeSettingsController::class, 'showThemeSettings']);
  Route::post('appearance/theme-settings', [ThemeSettingsController::class, 'updateThemeSetting']);
  Route::get('appearance/header-settings', [ThemeSettingsController::class, 'showHeaderSettings']);
  Route::post('appearance/header-settings', [ThemeSettingsController::class, 'updateeHeaderSetting']);
  Route::get('appearance/footer-settings', [ThemeSettingsController::class, 'showFooterSettings']);
  Route::post('appearance/footer-settings', [ThemeSettingsController::class, 'updateFooterSetting']);

  # system settings
  Route::get('settings/general-settings', [SystemSettingsController::class, 'showGeneralSettings']);
  Route::post('settings/general-settings', [SystemSettingsController::class, 'storeGeneralSettings']);
  Route::get('settings/auth-settings', [SystemSettingsController::class, 'showAuthSettings']);
  Route::post('settings/auth-settings', [SystemSettingsController::class, 'storeAuthSettings']);
  Route::get('settings/mail-settings', [SystemSettingsController::class, 'showMailSettings']);
  Route::post('settings/mail-settings', [SystemSettingsController::class, 'storeMailSettings']);
  Route::get('settings/storage-settings', [SystemSettingsController::class, 'showStorageSettings']);
  Route::post('settings/storage-settings', [SystemSettingsController::class, 'storeStorageSettings']);
  Route::get('settings/cronjob-settings', [SystemSettingsController::class, 'showCronJobSettings']);
  Route::get('settings/sitemap-settings', [SystemSettingsController::class, 'showSitemapSettings']);
  Route::post('settings/sitemap-settings', [SystemSettingsController::class, 'storeSitemapSettings']);
  
  # language settings
  Route::get('settings/language-settings', [LanguageController::class, 'index']);               
  Route::post('settings/store-language', [LanguageController::class, 'store'])->name('admin.languages.store');
  Route::get('/settings/languages/{id}/edit', [LanguageController::class, 'edit'])->name('admin.languages.edit');
  Route::post('/settings/languages/{id}', [LanguageController::class, 'update'])->name('admin.languages.update');

  Route::post('/settings/default-language', [LanguageController::class, 'defaultLanguage'])->name('admin.languages.defaultLanguage');
  Route::post('/settings/update-language-status', [LanguageController::class, 'updateStatus'])->name('admin.languages.updateStatus');
  Route::post('/settings/update-language-template-status', [LanguageController::class, 'updateTemplateStatus'])->name('admin.languages.updateTemplateStatus');                
  Route::get('/settings/languages/localizations/{id}', [LanguageController::class, 'showLocalizations'])->name('admin.languages.localizations');                
  Route::post('/settings/languages/localizations/{id}', [LanguageController::class, 'storeLocalizations'])->name('admin.languages.localizations.store');

  # ads settings
  // Route::get('settings/ads-settings', [AdvertisementController::class, 'index'])->name('admin.ads.index');
  // Route::post('settings/ads-settings', [AdvertisementController::class, 'store'])->name('admin.ads.store');
  // Route::delete('settings/ads-settings/{$id}', [AdvertisementController::class, 'destroy'])->name('admin.ads.delete');
  Route::resource('settings/ads-settings', AdvertisementController::class)->names('admin.ads');

  # module settings
  Route::get('modules', [ModuleController::class, 'index'])->name('admin.modules');                
  Route::post('modules', [ModuleController::class, 'update'])->name('admin.modules.update');
  
  # utilities
  Route::get('utilities', [UtilityController::class, 'index']);                
  Route::post('utilities/clear-cache', [UtilityController::class, 'clearCache'])->name('admin.clearCache');                
  Route::post('utilities/optimize', [UtilityController::class, 'optimize'])->name('admin.optimize');                
  Route::post('utilities/clear-log', [UtilityController::class, 'clearLog'])->name('admin.clearLog');                
  Route::post('utilities/debug', [UtilityController::class, 'debug'])->name('admin.debug');
});

