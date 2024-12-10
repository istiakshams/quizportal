<?php

namespace App\Http\Controllers\Backend\SystemSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GeneralSettingsStoreRequest;
use App\Http\Requests\AuthSettingsStoreRequest;
use App\Http\Requests\MailSettingsStoreRequest;
use App\Http\Requests\StorageSettingsStoreRequest;

use Illuminate\Support\Facades\Artisan;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

use App\Models\Blog;
use App\Models\Page;
use App\Models\SystemSettings;

class SystemSettingsController extends Controller
{
    /**
     * Display General Settings Page
     */
    public function showGeneralSettings()
    {
        return view('backend.systemsettings.general-settings');
    }

    /**
     * Save General Settings
     */
    public function storeGeneralSettings(GeneralSettingsStoreRequest $request)
    {
        $attributes = $request->validated();
        $attributes['enable_preloader'] = isset($attributes['enable_preloader']) ? 1 : 0;                
        $attributes['maintenance_mode'] = isset($attributes['maintenance_mode']) ? 1 : 0;
        $attributes['enable_google_analytics'] = isset($attributes['enable_google_analytics']) ? 1 : 0;                
        $attributes['enable_recaptcha'] = isset($attributes['enable_recaptcha']) ? 1 : 0;
        $attributes['enable_cookie_consent'] = isset($attributes['enable_cookie_consent']) ? 1 : 0;
        $attributes['maintenance_mode'] = isset($attributes['maintenance_mode']) ? 1 : 0;        
        // dd($attributes);

        // Flush Settings Cache
        SystemSettings::flushCache();

        // General Info
        SystemSettings::add('system_title', $attributes['system_title']);
        SystemSettings::add('contact_email', $attributes['contact_email']);
        SystemSettings::add('contact_phone', $attributes['contact_phone']);
        SystemSettings::add('tab_separator', $attributes['tab_separator']);
        SystemSettings::add('enable_preloader', $attributes['enable_preloader']);
        
        // Logo & Favicon
        SystemSettings::add('dashboard_light_logo', $attributes['dashboard_light_logo']);
        SystemSettings::add('dashboard_dark_logo', $attributes['dashboard_dark_logo']);
        SystemSettings::add('favicon', $attributes['favicon']);

        // SEO Settings
        SystemSettings::add('meta_title', $attributes['meta_title']);
        SystemSettings::add('meta_description', $attributes['meta_description']);
        SystemSettings::add('meta_keywords', $attributes['meta_keywords']);
        
        // Google Analytics Settings
        SystemSettings::add('enable_google_analytics', $attributes['enable_google_analytics']);
        SystemSettings::add('google_analytics_tracking_id', $attributes['google_analytics_tracking_id']);

        // Recaptcha Settings
        SystemSettings::add('enable_recaptcha', $attributes['enable_recaptcha']);
        SystemSettings::add('recaptcha_site_key', $attributes['recaptcha_site_key']);
        SystemSettings::add('recaptcha_secret_key', $attributes['recaptcha_secret_key']);

        // Code Settings
        SystemSettings::add('header_custom_script', $attributes['header_custom_script']);
        SystemSettings::add('footer_custom_script', $attributes['footer_custom_script']);
        SystemSettings::add('custom_css', $attributes['custom_css']);

        // Cookie Consent Settings
        SystemSettings::add('enable_cookie_consent', $attributes['enable_cookie_consent']);
        SystemSettings::add('cookie_consent_text', $attributes['cookie_consent_text']);
        
        // Maintenance Settings
        SystemSettings::add('maintenance_mode', $attributes['maintenance_mode']);

        // Update .env                
        writeToEnvFile('APP_NAME', $attributes['system_title']);
        writeToEnvFile('RECAPTCHAV3_SITEKEY', $attributes['recaptcha_site_key']);
        writeToEnvFile('RECAPTCHAV3_SECRET', $attributes['recaptcha_secret_key']);


        return redirect()->back()->with('message', 'Settings updated successfully!');
    }

    /**
     * Display Auth Settings Page
     */
    public function showAuthSettings()
    {
        return view('backend.systemsettings.auth-settings');
    }

    /**
     * Save Auth Settings
     */
    public function storeAuthSettings(AuthSettingsStoreRequest $request)
    {
        $attributes = $request->validated();
        $attributes['welcome_email'] = isset($attributes['welcome_email']) ? 1 : 0;                
        $attributes['enable_google_login'] = isset($attributes['enable_google_login']) ? 1 : 0;
        $attributes['enable_facebook_login'] = isset($attributes['enable_facebook_login']) ? 1 : 0;      
        
        // dd($attributes);

        // Flush Settings Cache
        // SystemSettings::flushCache();

        // Login & Registration
        SystemSettings::add('customer_registration', $attributes['customer_registration']);
        SystemSettings::add('registration_verification', $attributes['registration_verification']);
        SystemSettings::add('welcome_email', $attributes['welcome_email']);
        
        // OTP Settings
        SystemSettings::add('twilio_sid', $attributes['twilio_sid']);
        SystemSettings::add('twilio_auth_token', $attributes['twilio_auth_token']);
        SystemSettings::add('valid_twilo_number', $attributes['valid_twilo_number']);

        // Google Login Settings
        SystemSettings::add('enable_google_login', $attributes['enable_google_login']);
        SystemSettings::add('google_client_id', $attributes['google_client_id']);
        SystemSettings::add('google_client_secret', $attributes['google_client_secret']);
        
        // Facebook Login Settings
        SystemSettings::add('enable_facebook_login', $attributes['enable_facebook_login']);
        SystemSettings::add('faceboo_app_id', $attributes['faceboo_app_id']);
        SystemSettings::add('faceboo_app_secret', $attributes['faceboo_app_secret']);

        return redirect()->back()->with('message', 'Settings updated successfully!');
    }

    /**
     * Display Mail Settings Page
     */
    public function showMailSettings()
    {
        return view('backend.systemsettings.mail-settings');
    }

    /**
     * Save Mail Settings
     */
    public function storeMailSettings(MailSettingsStoreRequest $request)
    {
        $attributes = $request->validated();
        // dd($attributes);

        // Flush Settings Cache
        // SystemSettings::flushCache();

        // Mail Settings
        SystemSettings::add('mail_type', $attributes['mail_type']);
        SystemSettings::add('smtp_host', $attributes['smtp_host']);
        SystemSettings::add('smtp_port', $attributes['smtp_port']);
        SystemSettings::add('mail_username', $attributes['mail_username']);
        SystemSettings::add('mail_password', $attributes['mail_password']);
        SystemSettings::add('mail_from_address', $attributes['mail_from_address']);
        SystemSettings::add('mail_from_name', $attributes['mail_from_name']);

        // Update .env
        writeToEnvFile('MAIL_HOST', $attributes['smtp_host']);
        writeToEnvFile('MAIL_PORT', $attributes['smtp_port']);
        writeToEnvFile('MAIL_USERNAME', $attributes['mail_username']);
        writeToEnvFile('MAIL_PASSWORD', $attributes['mail_password']);
        writeToEnvFile('MAIL_FROM_ADDRESS', $attributes['mail_from_address']);
        writeToEnvFile('MAIL_FROM_NAME', $attributes['mail_from_name']);

        return redirect()->back()->with('message', 'Mail settings updated successfully!');
    }
    
    /**
     * Display Storage Settings Page
     */
    public function showStorageSettings()
    {
        return view('backend.systemsettings.storage-settings');
    }

    /**
     * Save Storage Settings
     */
    public function storeStorageSettings(StorageSettingsStoreRequest $request)
    {
        $attributes = $request->validated();
        // dd($attributes);

        // Flush Settings Cache
        SystemSettings::flushCache();

        // Storage Settings
        SystemSettings::add('active_storage', $attributes['active_storage']);
        SystemSettings::add('aws_access_key', $attributes['aws_access_key']);
        SystemSettings::add('aws_secret_key', $attributes['aws_secret_key']);
        SystemSettings::add('aws_s3_bucket_name', $attributes['aws_s3_bucket_name']);
        SystemSettings::add('aws_region', $attributes['aws_region']);

        // Update .env
        writeToEnvFile('AWS_ACCESS_KEY_ID', $attributes['aws_access_key']);
        writeToEnvFile('AWS_SECRET_ACCESS_KEY', $attributes['aws_secret_key']);
        writeToEnvFile('AWS_BUCKET', $attributes['aws_s3_bucket_name']);
        writeToEnvFile('AWS_DEFAULT_REGION', $attributes['aws_region']);

        return redirect()->back()->with('message', 'Settings updated successfully!');
    }

    /**
     * Display Cron Job Settings Page
     */
    public function showCronJobSettings()
    {
        return view('backend.systemsettings.cronjob-settings');
    }

   
    /**
     * Display Language Settings Page
     */
    public function showLanguageSettings()
    {
        return view('backend.systemsettings.language-settings');
    }

    /**
     * Save Language Settings
     */
    public function storeLanguageSettings()
    {
        return redirect()->back()->with('message', 'Settings updated successfully!');
    }    

    /**
     * Display Sitemap Settings Page
     */
    public function showSitemapSettings()
    {
        return view('backend.systemsettings.sitemap-settings');
    }

    /**
     * Save Sitemap Settings
     */
    public function storeSitemapSettings()
    {
        Sitemap::create()
            ->add(Url::create(config('app.url'))
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.1))
            ->add(Page::all())
            ->add(Blog::all())
            ->writeToFile(public_path('sitemap.xml'));

        return redirect()->back()->with('message', 'Settings updated successfully!');
    }
}
