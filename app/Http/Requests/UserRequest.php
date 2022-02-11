<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'bail|required|email|unique:users,email|max:255',
            'name' => 'required',
            'lastname' => 'required',
            'mothers_lastname' => 'required',
            'phone' => 'required|alpha_num',
            'enrollment' => 'required',
            'address' => 'required',
            'municipality' => 'required',
            'state_id' => 'required|exists:states,id',
            'birthday' => 'required|date',
            'birthplace' => 'required',
            'age' => 'required|numeric|min:1',
            'emergency_phone' => 'required|alpha_num',
            'curp' => 'required',
            'password' => 'required|confirmed',
        ];
    }
}
