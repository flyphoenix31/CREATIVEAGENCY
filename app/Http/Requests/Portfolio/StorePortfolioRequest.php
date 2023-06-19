<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;

class StorePortfolioRequest extends FormRequest
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
            'slug_url'  => 'required|string|max:50|unique:portfolio,slug_url',
            'title'     => 'required|string|min:5|max:60',
            'sub_title' => 'required|string|min:5',
            'content'   => 'required|string|min:5',
            'tag'       => 'nullable',
            'portfolio_image'     => 'required|mimes:jpeg,jpg,png|required|max:10000',
            'portfolio_banner'    => 'required|mimes:jpeg,jpg,png|required|max:10000'
        ];

    }

    public function messages()
    {
        return [
        ];
    }
}

