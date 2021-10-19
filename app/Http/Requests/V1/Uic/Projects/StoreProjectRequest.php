<?php

namespace App\Http\Requests\V1\Uic\Projects;

use App\Http\Requests\V1\Custom\CustomFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'enrollment.id' => [
                'required'
            ],

            'projectPlan.id' => [
                'required'
            ],

            'title' => [
                'required'
            ],

            'description' => [
                'required'
            ],

            'tutorAsigned' => [
                'required'
            ],

            'totalAdvance' => [
                'required'
            ],

            'score' => [
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

    public function attributes()
    {
        $attributes = [
            'enrollment.id' => 'Inscripción',
            'projectPlan.id' => 'Plan de Proyecto',
            'title' => 'Titulo del Proyecto',
            'description' => 'Descripción',
            'tutorAsigned' => 'Tutor Asignado',
            'totalAdvance' => 'Avance Total',
            'score' => 'Puntaje',
            'approved' => '¿Esta aprobado?',
            'observations' => 'Observaciones',
        ];

        return CustomFormRequest::attributes($attributes);
    }
}
