<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class AddSliderRequest extends FormRequest
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
            'title_en' => 'required',
            'title_ar' => 'required',
            'image' => 'nullable|mimes:' . config('services.allowed_file_extensions.images'),
            'logo' => 'nullable|mimes:' . config('services.allowed_file_extensions.images'),
            'content_en' => 'max:150',
            'content_ar' => 'max:150',
        ];
    }
}
