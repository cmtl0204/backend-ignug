<?php

namespace App\Http\Requests\V1\Uic\ProjectPlans;

use App\Http\Requests\V1\Uic\UicFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectPlanRequest extends FormRequest
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
            'title' => [
                'required'
            ],

            'description' => [
                'required'
            ],

            'actCode' => [
                'required'
            ],

            'approvedAt' => [
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
            'title' => 'Título del Plan',
            'description' => 'Descripción',
            'actCode' => 'Código del Acta',
            'approvedAt' => 'Fecha de aprobación',
            'approved' => '¿Esta aprobado?',
            'observations' => 'Observaciones',
        ];

        return UicFormRequest::attributes($attributes);
    }
}
