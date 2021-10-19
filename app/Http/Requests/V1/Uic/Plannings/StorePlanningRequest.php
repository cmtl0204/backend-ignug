<?php

namespace App\Http\Requests\V1\Uic\Plannings;

use App\Http\Requests\V1\Custom\CustomFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StorePlanningRequest extends FormRequest
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
            'career.id' => [
                'required'
            ],

            'name' => [
                'required'
            ],

            'description' => [
                'required'
            ],

            'startedAt' => [
                'required'
            ],

            'endedAt' => [
                'required'
            ],
        ];

        return CustomFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'career.id' => 'Carrera',
            'name' => 'Nombre de la Planificación',
            'description' => 'Descripción',
            'startedAt' => 'Fecha de Inicio',
            'endedAt' => 'Fecha de fin',
        ];

        return CustomFormRequest::attributes($attributes);
    }
}
