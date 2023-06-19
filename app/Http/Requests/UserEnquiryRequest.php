<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEnquiryRequest extends FormRequest
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
            'name'      => 'required|string|max:191|min:1',
            'email'     => 'required|email|min:5',
            'subject'   => 'required|min:3',
            'message'   => 'required|min:5',
        ];

    }

    public function messages()
    {
        return [
            'title.required' => 'A title is required',
        ];
    }
}

