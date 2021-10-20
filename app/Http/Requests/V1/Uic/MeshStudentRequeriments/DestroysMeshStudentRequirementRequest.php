<?php

namespace App\Http\Requests\V1\Uic\MeshStudentRequeriments;

use App\Http\Requests\V1\Uic\UicFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class DestroysMeshStudentRequerimentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'ids' => ['required'],
        ];

        return UicFormRequest::rules($rules);
    }

    public function attributes(): array
    {
        $attributes = [
            'ids' => 'IDs',
        ];

        return UicFormRequest::attributes($attributes);
    }
}
