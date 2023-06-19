<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdatePortfolioRequest extends FormRequest
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
            'slug_url'  => 'required|unique:portfolio,slug_url,'.decryptId($request->id),
            'title'     => 'required|string|min:5',
            'sub_title' => 'required|string|min:5',
            'content'   => 'required|string|min:5',
            'tag'       => 'nullable',
            //'portfolio_image'     => 'nullable|mimes:jpeg,jpg,png|required|max:10000',
            //'portfolio_banner'    => 'nullable|mimes:jpeg,jpg,png|required|max:10000'
        ];

    }

    public function messages()
    {
        return [
        ];
    }
}

