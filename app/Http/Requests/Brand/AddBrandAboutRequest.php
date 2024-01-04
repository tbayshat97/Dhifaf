<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class AddBrandAboutRequest extends FormRequest
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
            'description_en' => 'required|max:70',
            'description_ar' => 'required|max:70',
            'image' => 'nullable|mimes:' . config('services.allowed_file_extensions.images'),

        ];
    }
}
