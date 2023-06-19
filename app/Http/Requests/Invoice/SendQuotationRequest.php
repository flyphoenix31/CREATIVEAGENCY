<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SendQuotationRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'subject'          => 'required|string|min:1',
            'mail_content'     => 'required|min:10',
            'to_email'         => 'required|email|min:5'
        ];

    }

    public function messages()
    {
        return [
        ];
    }
}

