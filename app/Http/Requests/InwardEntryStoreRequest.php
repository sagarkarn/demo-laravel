<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InwardEntryStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        //dd($this->all());

        return [
            "from" => 'required|in:from_company,from_employee',
            "products.*" => 'required|numeric',
            "quantity.*" => 'required|numeric',
            "employee" => 'required_if:from,from_employee|exists:users,id',
            "bill_no" => 'required_if:from,from_company',
            "bill_amount" => 'required_if:from,from_company',
        ];
    }
}
