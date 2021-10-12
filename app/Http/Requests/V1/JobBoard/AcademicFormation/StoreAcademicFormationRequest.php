<?php

namespace App\Http\Requests\V1\JobBoard\AcademicFormation;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreAcademicFormationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'professionalDegree.id' => [
                'required',
            ],
            'certificated' => [
                'required',
            ],
            'registeredAt' => [
                'required_if:certificated,==,true',
            ],
            'senescytCode' => [
                'required_if:certificated,==,true',
            ]
        ];
        return JobBoardFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'registeredAt' => 'FECHA DE REGISTRO',
            'senescytCode' => 'CÓDIGO SENESCYT',
            'certificated' => '¿ESTÁ TITULADO?',
            'professionalDegree.id' => 'TÍTULO',
        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
