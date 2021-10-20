
<?php

namespace App\Http\Requests\V1\Uic\MeshStudents;

use App\Http\Requests\V1\Uic\UicFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreMeshStudentRequest extends FormRequest
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

            'mesh.id' => [
                'required'
            ],

            'startCohort' => [
                'required'
            ],

            'endCohort' => [
                'required'
            ],

            'isGraduated' => [
                'required'
            ],
        ];

        return UicFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'student.id' => 'Estudiante',
            'mesh.id' => 'Malla curricular',
            'startCohort' => 'Inicio del Grupo',
            'endCohort' => 'Fin del grupo',
            'isGraduated' => '¿Esta graduado?',
        ];

        return UicFormRequest::attributes($attributes);
    }
}
