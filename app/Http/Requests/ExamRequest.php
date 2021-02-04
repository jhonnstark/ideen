<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
            'name' => 'bail|required|max:255',
            'description' => 'bail|required|max:255',
            'course_id' => 'bail|required|exists:courses,id',
            'module_id' => 'bail|required|exists:modules,id'
        ];
    }
}
