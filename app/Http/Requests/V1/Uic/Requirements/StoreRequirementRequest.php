<?php

namespace App\Http\Requests\V1\Uic\Requirements;

use App\Http\Requests\V1\Uic\UicFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequirementRequest extends FormRequest
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

            'required' => [
                'required'
            ],

            'solicited' => [
                'required'
            ],
        ];

        return UicFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'career.id' => 'Carrera',
            'name' => 'Nombre del Requerimiento',
            'required' => '¿Es requerido?',
            'solicited' => 'Solicitar requerimiento',
        ];

        return UicFormRequest::attributes($attributes);
    }
}
