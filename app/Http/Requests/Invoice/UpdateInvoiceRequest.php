<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateInvoiceRequest extends FormRequest
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
            'company_name'      => 'required|string|min:1',
            'company_email'     => 'required|email|min:5',
            'company_phone'     => 'nullable',
            'company_address'   => 'required',
            'client_name'       => 'required',
            'client_email'      => 'required|email',
            'client_phone'      => 'nullable',
            'client_address'    => 'required',
            'invoice_date'      => 'required',
            'due_date'          => 'required',
            'currency'          => 'nullable',
            'invoice_number'    => 'required|unique:invoice_master,invoice_number,'.\Crypt::decryptString($request->id),
            'unit_price.*'      => 'required|numeric',
            'description.*'     => 'required',
            'quantity.*'        => 'required|numeric',
            //'tax_per_item'      => 'required_if:tax_type,tax_per_item|nullable|numeric',
            //'tax_on_total'      => 'required_if:tax_type,tax_on_total|numeric|between:1,99.99',
            //'discount_rate'     => 'required_if:discount_type:discount_rate|numeric|between:0,99.99',

            //'discount_percentage'   => 'required_if:discount_type:discount_percentage|numeric|between:0,99.99',

            //lt:

            //|
        ];

    }

    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'unit_price.*.required' => 'Price is required',
            'unit_price.*.numeric' => 'Price is invalid',
            'description.*.required' => 'description is required',
            'quantity.*.required' => 'quantity is required',
            'quantity.*.numeric' => 'quantity is invalid',
        ];
    }
}

