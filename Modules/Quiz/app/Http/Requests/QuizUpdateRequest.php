<?php

namespace Modules\Quiz\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuizUpdateRequest extends FormRequest
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
            'result_1' => 'required_if:type,personality',
            'result_1_image' => '',
            'result_2' => 'required_if:type,personality',
            'result_2_image' => '',
            'result_3' => 'required_if:type,personality',
            'result_3_image' => '',
            'result_4' => Rule::requiredIf(function () {
                            if($this->type=='personality' && ($this->no_of_choices=='4' || $this->no_of_choices=='5')) {
                                return true;
                            }
                            return false;
                        }),
            'result_4_image' => '',
            'result_5' => Rule::requiredIf(function () {
                            if($this->type=='personality' && $this->no_of_choices=='5') {                            
                                return true;
                            }
                            return false;
                        }),
            'result_5_image' => '',
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
            'result_1.required_if' => 'Please enter result 1 for personality quiz!',
            'result_2.required_if' => 'Please enter result 2 for personality quiz!',
            'result_3.required_if' => 'Please enter result 3 for personality quiz!',
            'result_4.required' => 'Please enter result 4 for personality quiz!',
            'result_5.required' => 'Please enter result 5 for personality quiz!',
        ];
    }
}
