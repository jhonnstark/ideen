<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
            'name' => 'bail|required|max:255|min:3',
            'description' => 'bail|required|max:255|min:10',
            'active' => 'required|in:true,false',
            'material' => [
                'required',
                'file',
                'max:10000',
                'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4,image/jpeg,image/png,image/bmp,image/gif,image/webp,image/tiff,application/pdf,audio/mp4,audio/mpeg,video/mpeg,video/mp4,video/x-msvideo',
                ],
            'course_id' => 'bail|required|exists:courses,id'
        ];
    }
}
