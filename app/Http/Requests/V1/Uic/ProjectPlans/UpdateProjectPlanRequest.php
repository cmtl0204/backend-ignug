<?php

namespace App\Http\Requests\V1\Uic\ProjectPlans;

use App\Http\Requests\V1\Custom\CustomFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectPlanRequest extends FormRequest
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

        return CustomFormRequest::rules($rules);
    }

    public function attributes(): array
    {
        $attributes = [
            'title' => 'Título del Plan',
            'description' => 'Descripción',
            'actCode' => 'Código del Acta',
            'approvedAt' => 'Fecha de aprobación',
            'approved' => 'Estado',
            'observations' => 'Observaciones',
        ];

        return CustomFormRequest::attributes($attributes);
    }
}
