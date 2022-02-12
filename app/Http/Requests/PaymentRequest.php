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
            'invoice' => 'required_if:signing_up,0|numeric|nullable',
            'signing_up' => 'required_if:invoice,null|numeric|min:0',
            'discount' => 'required|numeric|min:0|max:40',
            'scholarship' => 'required|numeric|min:0|max:40',
            'price' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ];
    }
}
