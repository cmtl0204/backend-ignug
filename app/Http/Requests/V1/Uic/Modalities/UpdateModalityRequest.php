<?php

namespace App\Http\Requests\V1\Uic\Modalities;

use App\Http\Requests\V1\Uic\UicFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateModalityRequest extends FormRequest
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
            'parent.id' => [
                'required'
            ],

            'state.id' => [
                'required'
            ],

            'career.id' => [
                'required'
            ],

            'name' => [
                'required'
            ],

            'description' => [
                'required'
            ],
        ];

        return UicFormRequest::rules($rules);
    }

    public function attributes(): array
    {
        $attributes = [
            'parent.id' => 'Modalidad Padre',
            'state.id' => '¿Esta vigente?',
            'career.id' => 'Carrera',
            'name' => 'Nombre de la Modalidad',
            'description' => 'Descripción',
        ];

        return UicFormRequest::attributes($attributes);
    }
}
