<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'type' => 'required',
            'ordered' => 'required_unless:type,Por alumno',
            'user_id' => 'required_if:type,Por alumno|required_if:ordered,Por alumno',
            'range' => 'required',
        ];
    }
}
