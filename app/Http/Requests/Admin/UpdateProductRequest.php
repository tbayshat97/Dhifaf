<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class UpdateProductRequest extends FormRequest
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
            'category.*' => 'required|exists:categories,id',
            'brand' => 'required|exists:brands,id',
            'sale_price_from' => 'required_with:sale_price',
            'sale_price_to' => 'required_with:sale_price',
            //'qty' => 'numeric',
            'title_en' => 'required',
            'title_ar' => 'required',
            //'description_en' => 'required',
            //'description_ar' => 'required',
            'image' => new RequiredIf($this['fileuploader-list-image'] == json_encode([])) . '|mimes:' . config('services.allowed_file_extensions.images'),
            'gallery.*' => 'nullable|mimes:' . config('services.allowed_file_extensions.images'),
        ];
    }
}
