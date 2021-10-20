<?php

namespace App\Http\Requests\V1\Uic\TutorShips;

use App\Http\Requests\V1\Uic\UicFormRequest;
use Illuminate\Foundation\Http\FormRequest;
class IndexTutorShipRequest extends FormRequest
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

        return UicFormRequest::rules($rules);
    }

    public function attributes(): array
    {
        $attributes = [
            'field_example' => 'campo de ejemplo',
        ];

        return UicFormRequest::attributes($attributes);
    }
}
