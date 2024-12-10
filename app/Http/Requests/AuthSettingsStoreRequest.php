<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthSettingsStoreRequest extends FormRequest
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
            'customer_registration' => '',
            'registration_verification' => '',
            'welcome_email' => '',
            'twilio_sid' => '',
            'twilio_auth_token' => '',
            'valid_twilo_number' => '',
            'enable_google_login' => '',            
            'google_client_id' => '', 
            'google_client_secret' => '',
            'enable_facebook_login' => '',
            'faceboo_app_id' => '',
            'faceboo_app_secret' => '',
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