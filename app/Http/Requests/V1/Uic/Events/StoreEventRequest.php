<?php

namespace App\Http\Requests\V1\Uic\Events;

use App\Http\Requests\V1\Uic\UicFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'planning.id' => [
                'required'
            ],

            'name.id' => [
                'required'
            ],

            'startedAt' => [
                'required'
            ],

            'endedAt' => [
                'required'
            ],
        ];

        return UicFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'planning.id' => 'Planificación',
            'name.id' => 'Nombre del Evento',
            'startedAt' => 'Fecha de Inicio',
            'endedAt' => 'Fecha de Fin',
        ];

        return UicFormRequest::attributes($attributes);
    }
}
