<?php

namespace App\Http\Requests\Job;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateJobRequest extends FormRequest
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
            'title'      => 'required|string|min:5',
            'full_description'     => 'required|string|min:10',
            'delivery_day'     => 'required|numeric|min:1',
            'budget'     => 'required|numeric|min:1',
        ];

    }

    public function messages()
    {
        return [
        ];
    }
}

