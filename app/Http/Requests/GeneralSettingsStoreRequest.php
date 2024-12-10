<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingsStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'system_title' => 'string|max:350',
            'contact_email' => 'email',
            'contact_phone' => '',
            'tab_separator' => '',
            'enable_preloader' => '',
            'dashboard_light_logo' => '',            
            'dashboard_dark_logo' => '',            
            'favicon' => '',            
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'enable_google_analytics' => '',
            'google_analytics_tracking_id' => '',
            'recaptcha_site_key' => '',
            'recaptcha_secret_key' => '',
            'enable_recaptcha' => '',
            'header_custom_script' => '',
            'footer_custom_script' => '',
            'custom_css' => '',                       
            'enable_cookie_consent' => '',
            'cookie_consent_text' => '',
            'maintenance_mode' => '',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'system_title.required' => 'Please enter a valid system title!',
            'contact_email.email' => 'Please enter a valid email!',
        ];
    }
}