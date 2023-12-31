<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateContactRequest extends FormRequest
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
            'name'      => 'required|string|min:1',
            'email'     => 'required|email||unique:contacts,email,'.\Crypt::decryptString($request->id),
            'phone'     => 'nullable',
            'address'   => 'nullable',
        ];

    }

    public function messages()
    {
        return [
        ];
    }
}

