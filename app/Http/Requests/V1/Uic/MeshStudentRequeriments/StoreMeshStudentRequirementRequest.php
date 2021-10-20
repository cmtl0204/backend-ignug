<?php

namespace App\Http\Requests\V1\Uic\MeshStudentRequeriments;

use App\Http\Requests\V1\Uic\UicFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomRequest extends FormRequest
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

        return UicFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'meshStudent.id' => 'Malla Estudiantil',
            'requirement.id' => 'Requerimiento',
            'approved' => '¿Usted ha aprobado?',
            'observations' => 'Observaciones',
        ];

        return UicFormRequest::attributes($attributes);
    }
}
