<?php

namespace App\Http\Requests\V1\JobBoard\AcademicFormation;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAcademicFormationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $rules = [
            'registrationDate' => [
                'required',
            ],
            'senescytCode' => [
                'required',
            ],
            'certificated' => [
                'required',
            ],
            'professionalDegree.id' => [
                'required',
            ]
        ];
        return JobBoardFormRequest::rules($rules);
    }



    public function attributes()
    {
        $attributes = [
            'registrationDate'=>'Fecha de registro',
            'senescytCode'=>'Codigo de Senescyt',
            'certificated'=>'Tiene certificado',
            'professionalDegree.id'=>'Id de tituto de grado',
        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
