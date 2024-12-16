<?php

namespace Modules\Quiz\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionStoreRequest extends FormRequest
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
            'quiz_id' => 'required',
            'question' => 'required',
            'answer_1_text' => 'required|max:256',
            'answer_1_image' => '',
            'answer_2_text' => 'required',
            'answer_2_image' => '',
            'answer_3_text' => 'required',
            'answer_3_image' => '',
            'answer_4_text' => '',
            'answer_4_image' => '',
            'answer_5_text' => '',
            'answer_5_image' => '',                        
            'correct_answer' => '',
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
            'question.required' => 'Please enter question!',
            'answer_1_text.required' => 'Please enter answer 1!',
            'answer_1_text.max' => 'Answer cannot be more than 256 characters!',
        ];
    }
}
