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


Route::group( ['prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {
      
  Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

  # blog system      
    
  # blogs      
  Route::resource('blogs', BlogController::class);
  Route::resource('blog-categories', BlogCategoryController::class);
  
  # media manager
  Route::resource('media-manager', MediaManagerController::class);

  # newsletters
  Route::get('newsletters/send-newsletter', [NewsletterController::class, 'showHeaderSettings']);
  Route::get('newsletters/subscribers', [NewsletterController::class, 'storeHeaderSetting']);

  # members

  Route::resource('members/roles', RoleController::class);
  Route::resource('members/permissions', PermissionController::class);
  Route::get('members/admins', [MemberController::class, 'admins']);
  Route::resource('members', MemberController::class);

  # reports
  Route::get('reports/subscription-report', [SubscriptionReportController::class, 'showSubscriptionReport']);

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


        // Route::get('/', [BlogController::class, 'index'])->name('admin.blogs.index');
        // Route::get('/create', [BlogController::class, 'create'])->name('admin.blogs.create');
        // Route::post('/store', [BlogController::class, 'store'])->name('admin.blogs.store');
        // Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('admin.blogs.edit');
        // Route::post('/update', [BlogController::class, 'update'])->name('admin.blogs.update');
        // Route::get('/delete/{id}', [BlogController::class, 'delete'])->name('admin.blogs.delete');

        // Route::post('/update-popular', [BlogController::class, 'updatePopular'])->name('admin.blogs.updatePopular');
        // Route::post('/update-status', [BlogController::class, 'updateStatus'])->name('admin.blogs.updateStatus');

        // # categories
        // Route::get('/categories', [BlogCategoryController::class, 'index'])->name('admin.blogCategories.index');
        // Route::post('/category', [BlogCategoryController::class, 'store'])->name('admin.blogCategories.store')->middleware('demo');
        // Route::get('/categories/edit/{id}', [BlogCategoryController::class, 'edit'])->name('admin.blogCategories.edit');
        // Route::post('/categories/update-category', [BlogCategoryController::class, 'update'])->name('admin.blogCategories.update')->middleware('demo');
        // Route::get('/categories/delete/{id}', [BlogCategoryController::class, 'delete'])->name('admin.blogCategories.delete')->middleware('demo');

   
  # pages
  Route::resource('pages', PageController::class);

  # page system      
  // Route::group(['prefix' => 'pages'], function () {        
  //   Route::get('/', [PageController::class, 'index'])->name('admin.pages.index');        
  //   Route::get('/create', [PageController::class, 'create'])->name('admin.pages.create');        
  //   Route::post('/store', [PageController::class, 'store'])->name('admin.pages.store');        
  //   Route::get('/edit/{id}', [PageController::class, 'edit'])->name('admin.pages.edit');       
  //   Route::post('/update', [PageController::class, 'update'])->name('admin.pages.update');        
  //   Route::get('/delete/{id}', [PageController::class, 'delete'])->name('admin.pages.delete');
  // });
});

