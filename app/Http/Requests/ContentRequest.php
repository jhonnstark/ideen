<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|max:255|min:3',
            'description' => 'bail|required|max:255|min:10',
            'active' => 'required|in:true,false',
            'material' => 'required|file|max:5000|mimes:jpeg,bmp,png,pdf',
            'course_id' => 'bail|required|exists:courses,id'
        ];
    }
}
