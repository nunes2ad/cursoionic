<?php

namespace CodeDelivery\Http\Requests;

use CodeDelivery\Http\Requests\Request;

class AdminClientRequest extends Request
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
        /*
        'phone',
        'address',
        'city',
        'state',
        'zipcode'
         */

        return [


        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo :attribute é obrigatório',
        ];
    }
}

