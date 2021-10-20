<?php

namespace App\Http\Requests\V1\Uic\RequirementsRequest;

use App\Http\Requests\V1\Uic\UicFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequirementRequestmRequest extends FormRequest
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
            'requirement.id' => [
                'required'
            ],

            'meshStudent.id' => [
                'required'
            ],

            'registeredAt' => [
                'required'
            ],

            'approved' => [
                'required'
            ],

            'observations' => [
                'required'
            ],
        ];

        return UicFormRequest::rules($rules);
    }

    public function attributes(): array
    {
        $attributes = [
            'requirement.id' => '¿Es requerido?',
            'meshStudent.id' => 'Malla Estudiantil',
            'registeredAt' => 'Fecha de Registro',
            'approved' => '¿Esta aprobado?',
            'observations' => 'Observaciones',
        ];

        return UicFormRequest::attributes($attributes);
    }
}
