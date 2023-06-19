<?php

namespace App\Http\Requests\Domain;

use Illuminate\Foundation\Http\FormRequest;
use Axiom\Rules\Domain;

class StoreRequest extends FormRequest
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
            'customer_name'      => 'required|string|min:1',
            'provider_name'      => 'required|string|min:1',
            'reg_at'    => 'required|date',
            'expire_at'      => 'required|date|after:reg_at',
            'name' => ['required', new Domain],

        ];

    }

    public function messages()
    {
        return [
        ];
    }
}

