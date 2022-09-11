<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            'name' => 'bail|required|max:255',
            'quarter' => 'required|numeric|max:9|min:1',
            'period' => 'required|numeric|max:3|min:1',
            'program_id' => 'bail|required|exists:programs,id',
            'cycle_id' => 'bail|required|exists:cycles,id',
        ];
    }
}
