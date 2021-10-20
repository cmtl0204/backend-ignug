<?php

namespace App\Http\Requests\V1\Uic\StudentsInformation;

use App\Http\Requests\V1\Uic\UicFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentInformationRequest extends FormRequest
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
            'student.id' => [
                'required'
            ],

            'relationLaboralCareer.id' => [
                'required'
            ],

            'companyArea.id' => [
                'required'
            ],

            'companyPosition.id' => [
                'required'
            ],

            'companyWork' => [
                'required'
            ],
        ];

        return UicFormRequest::rules($rules);
    }

    public function attributes(): array
    {
        $attributes = [
            'student.id' => 'Estudiante',
            'relationLaboralCareer.id' => 'Relación Laboral',
            'companyArea.id' => 'Área de la Compañía',
            'companyPosition.id' => 'Posición de la Compañía',
            'companyWork' => 'Trabajo de la Compañía',
        ];

        return UicFormRequest::attributes($attributes);
    }
}
