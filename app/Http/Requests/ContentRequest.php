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
            'material' => [
                'required',
                'file',
                'max:500000',
                'mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.ms-powerpoint,application/msword,video/avi,video/mpeg,video/x-matroska,video/mp4,video/x-msvideo,video/mpeg,video/quicktime,video/mp4,image/jpeg,image/png,image/bmp,image/gif,image/webp,image/tiff,application/pdf,audio/mp4,audio/mpeg,audio/x-ms-wma,audio/x-wav',
            ],
            'module_id' => 'bail|required|exists:modules,id'
        ];
    }
}
