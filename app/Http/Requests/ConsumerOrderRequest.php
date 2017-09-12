<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsumerOrderRequest extends FormRequest
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
            'reference'   => 'max:25',
            'consumer_id' => 'required_without:stock|exists:consumers,id',
            'order_id'    => 'exists:orders,id',
            'month'       => 'required|date_format:m/Y',
            'stock'       => 'boolean',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'consumer_id.required_without' => 'Le champ :attribute est obligatoire.',
        ];
    }
}
