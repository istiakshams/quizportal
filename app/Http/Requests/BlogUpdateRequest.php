<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
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
            'title' => 'required|max:350',
            'description' => 'required',
            'short_description' => '',
            'featured_image' => '',
            'is_featured' => '',
            'author_id' => '',
            'categories' => 'required',
            'tags' => '',
            'author' => '',
            'status' => '',
            'meta_title' => '',
            'meta_description' => '',
            'meta_img' => '',
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
            'title.required' => 'Please enter title!',
            'title.max' => 'Title must not exceed 350 characters!',
            'description.required' => 'Please enter description!',
            'categories.required' => 'Please select blog categories!',
        ];
    }
}