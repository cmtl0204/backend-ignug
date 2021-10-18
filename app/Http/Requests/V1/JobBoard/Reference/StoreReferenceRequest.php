<?php

namespace App\Http\Requests\V1\JobBoard\Reference;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreReferenceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'institution' => [
                'required',
                'min:5',
                'max:30',
            ],
            'position' => [
                'required',
            ],
            'contactName' => [
                'required',
                'max:30',
            ],
            'contactPhone' => [
                'required',
                'numeric',
            ],
            'contactEmail' => [
                'required',
            ]
        ];

        return JobBoardFormRequest::rules($rules);
    }
    public function attributes()
    {
        $attributes = [
            'institution' => 'institución',
            'position' => 'cargo que ocupó',
            'contactName' => 'nombre de contacto',
            'contactPhone' => 'teléfono de contacto',
            'contactEmail' => 'email de contacto',
        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
