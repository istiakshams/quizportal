<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorageSettingsStoreRequest extends FormRequest
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
            'active_storage' => 'required',
            'aws_access_key' => 'required_if:active_storage,s3',
            'aws_secret_key' => 'required_if:active_storage,s3',
            'aws_s3_bucket_name' => 'required_if:active_storage,s3',
            'aws_region' => 'required_if:active_storage,s3',
            
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
            'aws_access_key.required_if' => 'Please enter AWS Access Key!',
            'aws_secret_key.required_if' => 'Please enter AWS Secret Access Key!',
            'aws_s3_bucket_name.required_if' => 'Please enter AWS S3 Bucket Name!',
            'aws_region.required_if' => 'Please enter AWS Region!',
        ];
    }
}
