<?php

namespace Modules\Quiz\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollUpdateRequest extends FormRequest
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
            'question' => 'required|max:512',
            'image' => '',
            'maxCheck' => '',
            'canVisitorsVote' => '',
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
            'question.required' => 'Please enter poll question!',
            'question.max' => 'Poll question must not exceed 512 characters!',
        ];
    }
}