<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordUsersRequest extends FormRequest
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
            'id'       => 'required',
            //'password' => 'required|string|min:5|max:50|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,50}$/',
            'password' => 'required|string|min:5|max:50|confirmed',

        ];
    }

    public function messages()
    {
        return [
            
            'password.regex'         => trans('auth.password_format_error'),
        ];
    }
}

