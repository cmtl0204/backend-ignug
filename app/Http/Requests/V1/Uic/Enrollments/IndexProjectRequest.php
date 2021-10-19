<?php

namespace App\Http\Requests\V1\Custom\Example;

use App\Http\Requests\V1\Custom\CustomFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class IndexCustomRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'field_example' => ['required'],
        ];

        return CustomFormRequest::rules($rules);
    }

    public function attributes(): array
    {
        $attributes = [
            'field_example' => 'campo de ejemplo',
        ];

        return CustomFormRequest::attributes($attributes);
    }
}
