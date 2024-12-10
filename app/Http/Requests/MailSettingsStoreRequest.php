<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailSettingsStoreRequest extends FormRequest
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
            'mail_type' => 'required',
            'smtp_host' => 'required_if:mail_type,smtp',
            'smtp_port' => 'required_if:mail_type,smtp',
            'mail_username' => 'required_if:mail_type,smtp',
            'mail_password' => 'required_if:mail_type,smtp',
            'mail_from_address' => 'required|email|max:256',
            'mail_from_name' => 'required|max:256',
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
            'smtp_host.required_if' => 'SMTP Host is required when mail type is SMTP!',
            'smtp_port.required_if' => 'SMTP Port is required when mail type is SMTP!',
            'mail_username.required_if' => 'Mail username is required when mail type is SMTP!',
            'mail_password.required_if' => 'Mail password is required when mail type is SMTP!',
            'mail_from_address.required' => 'Please enter mail from address!',
            'mail_from_address.email' => 'Please enter a valid email for mail from address!',
            'mail_from_address.max' => 'Maximum allowed length for email is 256 characters!',
            'mail_from_name.required' => 'Please enter mail from name!',
            'mail_from_name.max' => 'Maximum allowed length for name is 256 characters!',
        ];
    }
}