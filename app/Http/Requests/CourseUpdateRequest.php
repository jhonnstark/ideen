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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'active' => $this->active === 'true',
        ]);
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
            'teacher_id' => 'required|exists:teachers,id',
            'name' => 'required|max:255',
            'active' => 'required|boolean',
            'poster' => 'bail|sometimes|mimetypes:image/jpeg,image/png,image/bmp,image/gif,image/webp,image/tiff',
        ];
    }
}
