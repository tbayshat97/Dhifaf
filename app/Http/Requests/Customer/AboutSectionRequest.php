<?php

namespace App\Http\Requests\Customer;

use App\Enums\AboutSectionType;
use App\Enums\SectionType;
use Illuminate\Foundation\Http\FormRequest;

class AboutSectionRequest extends FormRequest
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
            'key' => 'required|in:' . implode(',', AboutSectionType::getValues()),
        ];
    }

    public function messages()
    {
        return [
            'key.in' => 'You have entered a wrong section key'
        ];
    }
}
