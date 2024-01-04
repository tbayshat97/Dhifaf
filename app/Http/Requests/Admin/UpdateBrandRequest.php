<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class UpdateBrandRequest extends FormRequest
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
            'username' => new RequiredIf($this['status'] == 2).'|'.(isset($this['username'])) ? 'unique:brands' : '',
            'password' => ($this['password']) ? 'confirmed|min:6' : 'nullable',
            'username' => 'nullable',
            'name_en' => 'required',
            'name_ar' => 'required',
            'image' => 'nullable|mimes:' . config('services.allowed_file_extensions.images'),
            'header' => 'nullable|mimes:' . config('services.allowed_file_extensions.images')
        ];
    }
}
