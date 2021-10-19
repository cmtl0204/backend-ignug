<?php

namespace App\Http\Requests\V1\Uic\Modalities;

use App\Http\Requests\V1\Custom\CustomFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreModalityRequest extends FormRequest
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
            'parent.id' => [
                'required'
            ],

            'status.id' => [
                'required'
            ],

            'career.id' => [
                'required'
            ],

            'name' => [
                'required'
            ],

            'description' => [
                'required'
            ],
        ];

        return CustomFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'parent.id' => 'Modalidad Padre',
            'status.id' => 'Estado',
            'career.id' => 'Carrera',
            'name' => 'Nombre de la Modalidad',
            'description' => 'Descripción',
        ];

        return CustomFormRequest::attributes($attributes);
    }
}
