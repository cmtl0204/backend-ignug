<?php

namespace App\Http\Requests\V1\Uic\MeshStudentRequeriments;

use App\Http\Requests\V1\Custom\CustomFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMeshStudentRequerimentRequest extends FormRequest
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
            'meshStudent.id' => [
                'required'
            ],

            'requirement.id' => [
                'required'
            ],

            'approved' => [
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
            'meshStudent.id' => 'Malla Estudiantil',
            'requirement.id' => 'Requerimiento',
            'approved' => 'Estado',
            'observations' => 'Observaciones',
        ];

        return CustomFormRequest::attributes($attributes);
    }
}
