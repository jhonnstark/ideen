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
            'material' => [
                'required',
                'file',
                'max:10000',
                'mimetypes:video/avi,video/mpeg,video/x-matroska,video/mp4,video/x-msvideo,video/mpeg,video/quicktime,video/mp4,image/jpeg,image/png,image/bmp,image/gif,image/webp,image/tiff,application/pdf,audio/mp4,audio/mpeg,audio/x-ms-wma,audio/x-wav',
            ],
            'course_id' => 'bail|required|exists:courses,id'
        ];
    }
}
