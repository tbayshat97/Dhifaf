<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name_en' => 'required',
            'name_ar' => 'required',
            'division_id' => 'required',
            'image' => 'nullable|mimes:' . config('services.allowed_file_extensions.images'),
            'header' => 'nullable|mimes:' . config('services.allowed_file_extensions.images')
        ];
    }
}
