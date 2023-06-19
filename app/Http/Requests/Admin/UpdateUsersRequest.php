<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class UpdateUsersRequest extends FormRequest
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
            'name'            => 'required',            
            'username'        => 'nullable|min:5|max:30|unique:users,username,'.$request->id,         
            'email'           => 'nullable|email|unique:users,email,'.$request->id,         
            'role'            => 'required',
            'phone'           => 'nullable|string|min:9|max:13|unique:users,phone,'.$request->id,           
            'gender_id'       => 'sometimes',     
        ];

    }

    public function messages()
    {
        return [            
            'gender_id.required'     => trans('error.gender_required'),
        ];
    }
}
