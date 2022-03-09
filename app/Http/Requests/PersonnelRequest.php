<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonnelRequest extends FormRequest
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
            'email' => 'bail|required|email|unique:personnels,email|max:255',
            'name' => 'required',
            'lastname' => 'required',
            'mothers_lastname' => 'required',
            'password' => 'required|confirmed',
        ];
    }
}
