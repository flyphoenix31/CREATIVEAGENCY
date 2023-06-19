<?php

namespace App\Http\Requests\Mail;

use Illuminate\Foundation\Http\FormRequest;

class StoreMailRequest extends FormRequest
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
            'mail_driver'    => 'required',
            'from_address'   => 'required',
            'mail_host'      => 'required',
            'mail_username'  => 'required',
            'mail_password'  => 'required|same:password_confirmation',
            'mail_port'      => 'required|numeric',
            'mail_enc'       => 'required',
            'display_name'   => 'required',
        ];

    }

    public function messages()
    {
        return [
        ];
    }
}

