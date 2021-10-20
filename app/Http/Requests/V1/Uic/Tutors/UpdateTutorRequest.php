<?php

namespace App\Http\Requests\V1\Uic\Tutors;

use App\Http\Requests\V1\Uic\UicFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTutorRequest extends FormRequest
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
            'projectPlan.id' => [
                'required'
            ],

            'teacher.id' => [
                'required'
            ],

            'type.id' => [
                'required'
            ],

            'observations' => [
                'required'
            ],
        ];
    }

    public function attributes(): array
    {
        $attributes = [
            'projectPlan.id' => 'Plan del Proyecto',
            'teacher.id' => 'Profesor@',
            'type.id' => 'Cargo',
            'observations' => 'Observaciones',
        ];

        return UicFormRequest::attributes($attributes);
    }
}
