<?php

namespace App\Http\Requests\V1\Uic\Students;

use App\Http\Requests\V1\Uic\UicFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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

            'meshStudent.id' => [
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
            'projectPlan.id' => 'Plan del Proyecto',
            'meshStudent.id' => 'Malla Curricular',
            'observations' => 'Observaciones',
        ];

        return UicFormRequest::attributes($attributes);
    }
}
