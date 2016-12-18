<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsumerRequest extends FormRequest
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
            'first_name'  => 'required|alpha_dash',
            'last_name'   => 'required|alpha_dash',
            'birthday'    => 'date_format:Y-m-d',
            'sex'         => 'in:m,f',
            'email'       => 'email',
            'phone'       => '',
            'address'     => '',
            'postal_code' => 'numeric|digits_between:2,5',
            'status_id'   => 'required|exists:consumer_statuses,id',
            'date'        => 'date_format:Y-m-d',
        ];
    }
}
