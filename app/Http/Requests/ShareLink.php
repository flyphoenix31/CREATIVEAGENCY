<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\ValidationRules\Rules\Delimited;

class ShareLink extends FormRequest
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
            'new_share_emails' => ['required', new Delimited('email', $this->messages())],
        ];

    }

    public function messages()
    {
        return [
            'new_share_emails.email' => 'Not all the given e-mails are valid.',
        ];
    }
}

