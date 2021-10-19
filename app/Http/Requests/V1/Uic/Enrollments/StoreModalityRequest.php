<?php

namespace App\Http\Requests\V1\Custom\Example;

use App\Http\Requests\V1\Custom\CustomFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomRequest extends FormRequest
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
        $rules = [
            'field_example' => ['required']
        ];

        return CustomFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'field_example' => 'campo de ejemplo',
        ];

        return CustomFormRequest::attributes($attributes);
    }
}
