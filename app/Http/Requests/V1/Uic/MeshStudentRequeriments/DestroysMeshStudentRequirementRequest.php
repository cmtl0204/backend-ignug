<?php

namespace App\Http\Requests\V1\Uic\MeshStudentRequeriments;

use App\Http\Requests\V1\Custom\CustomFormRequest;
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

        return CustomFormRequest::rules($rules);
    }

    public function attributes(): array
    {
        $attributes = [
            'ids' => 'IDs',
        ];

        return CustomFormRequest::attributes($attributes);
    }
}
