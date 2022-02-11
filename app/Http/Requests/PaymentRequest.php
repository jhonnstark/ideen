<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'description' => 'required',
            'discount' => 'required|numeric|min:0|max:100',
            'price' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ];
    }
}
