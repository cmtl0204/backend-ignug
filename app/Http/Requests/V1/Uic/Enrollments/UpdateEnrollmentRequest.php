<?php

namespace App\Http\Requests\V1\Uic\Enrollments;

use App\Http\Requests\V1\Custom\CustomFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEnrollmentRequest extends FormRequest
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
            'modality.id' => [
                'required'
            ],

            'schoolPeriod.id' => [
                'required'
            ],

            'meshStudent.id' => [
                'required'
            ],

            'status.id' => [
                'required'
            ],

            'planning.id' => [
                'required'
            ],

            'registeredAt' => [
                'required'
            ],

            'code' => [
                'required'
            ],

            'observations' => [
                'required'
            ],
        ];

        return CustomFormRequest::rules($rules);
    }

    public function attributes(): array
    {
        $attributes = [
            'modality.id' => 'Modalidad',
            'schoolPeriod.id' => 'Periodo Académico',
            'meshStudent' => 'Malla Estudiantil',
            'status' => 'Estado',
            'planning' => 'Planificación',
            'registeredAt' => 'Fecha de registro',
            'code' => 'Código',
            'observations' => 'Observaciones',
        ];

        return CustomFormRequest::attributes($attributes);
    }
}
