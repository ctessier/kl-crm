<?php

namespace App\Http\Requests;

use App\ConsumerStatus;
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
            'first_name'        => 'required|alpha_dash',
            'last_name'         => 'required|alpha_dash',
            'sex'               => 'required|in:m,f',
            'email'             => 'email',
            'phone'             => 'min:10|max:15|regex:/[0-9+\(\)]/',
            'address'           => 'max:255',
            'postal_code'       => 'numeric|digits_between:2,5',
            'status_id'         => 'required|exists:consumer_statuses,id',
            'date'              => 'required|date_format:d/m/Y',
            //'membership_number' => '',
            'break'             => 'boolean',
            'main_consumer_id'  => 'required_if:status_id,'.ConsumerStatus::DEPENDANT_MEMBER.'|exists:consumers,id',
        ];
    }
}
