<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnquiryReplyRequest extends FormRequest
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
            'to_email'     => 'required|email|min:5',
            'subject'   => 'required|min:3',
            'mail_content'   => 'required|min:5',
        ];

    }

    public function messages()
    {
        return [
        ];
    }
}

