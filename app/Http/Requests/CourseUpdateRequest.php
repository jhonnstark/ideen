<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'bail|required|exists:categories,id',
            'level_id' => 'bail|required|exists:levels,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'name' => 'bail|required|exists:courses,name|max:255',
            'active' => 'required|boolean',
        ];
    }
}
