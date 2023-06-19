<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsersRequest extends FormRequest
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
        $messages = array('email.regex' => 'allow_only_reg_email');

        return [
            'name'          => 'required|min:3|max:200',
            'email'         => 'nullable|email|unique:users,email',
            'username'      => 'nullable|string|min:5|max:30|unique:users,username',
            'phone'         => 'nullable|string|min:9|max:11|unique:users,phone',
            'gender_id'     => 'sometimes',
            'role'          => 'required',
            'password'      => 'required|string|min:5|max:50|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'password.regex'         => trans('auth.password_format_error'),
            'gender_id.required'     => trans('error.gender_required'),
        ];
    }
}

