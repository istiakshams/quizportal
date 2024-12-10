<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberStoreRequest extends FormRequest
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
            'name' => 'required|max:350',
            'phone' => '',
            'email' => 'email|required',
            'password' => 'required|min:8',
            'role' => 'required',            
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
            'name.required' => 'Please enter member name!',
            'email.email' => 'Please enter a valid email!',
            'email.required' => 'Please enter member email!',
            'password.required' => 'Please enter member password!',
            'password.min' => 'Password needs to be minimum 8 characters!',
        ];
    }
}
