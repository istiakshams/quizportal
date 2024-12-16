<?php

namespace Modules\Quiz\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizStoreRequest extends FormRequest
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
            'image' => '',
            'category_id' => 'required',
            'type' => '',
            'no_of_choices' => '',
            'is_featured' => '',
            'author_id' => '',
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
            'title.required' => 'Please enter quiz title!',
            'title.max' => 'Quiz title must not exceed 350 characters!',
            'description.required' => 'Please enter quiz description!',
            'category_id.required' => 'Please select quiz category!',
        ];
    }
}
