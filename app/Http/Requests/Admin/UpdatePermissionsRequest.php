<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdatePermissionsRequest extends FormRequest
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
            //'name'       => 'required|string|min:2|unique:permissions,name,'.$request->name,
            'name'       => 'required|string|min:2|unique:permissions,name,'.$request->id,
            //'module_id'  => 'required',

        ];
    }

    public function messages()
    {
        return [            
            'module_id.required'  => trans('error.select_module'),
        ];
    }
}
