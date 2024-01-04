<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverRequest extends FormRequest
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
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'phone' => 'required',
            'email' => 'nullable',
            'image' => 'nullable|mimes:' . config('services.allowed_file_extensions.images'),
            'birthdate' => 'nullable|date|date_format:d/m/Y',
            'gender' => 'nullable',
        ];
    }
}
