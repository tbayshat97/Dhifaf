<?php

namespace App\Http\Requests\Customer;

use App\Enums\PaymentMethods;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'products' => 'required',
            'products.*' => 'required',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.qty' => 'required|integer',
        ];
    }
}
