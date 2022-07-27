<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'product_ids' => 'required|array',
            'quantities' => 'required|array',
            'customer_id' => 'required|integer|exists:customers,id',
            'product_ids.*' => 'required|integer|exists:products,id',
        ];
    }
}
