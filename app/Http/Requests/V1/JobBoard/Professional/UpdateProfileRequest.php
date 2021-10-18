<?php

namespace App\Http\Requests\V1\JobBoard\Professional;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'user.identificationType' => [
                'required'
            ],
            'user.gender' => [
                'required',
            ],
            'user.sex' => [
                'required',
            ],
            'user.bloodType' => [
                'required',
            ],
            'user.ethnicOrigin' => [
                'required',
            ],
            'user.username' => [
                'required',
                'min:9',
                'max:15',
            ],
            'user.name' => [
                'required',
            ],
            'user.lastname' => [
                'required',
            ],
            'user.email' => [
                'required',
                'email',
            ],
            'user.phone' => [
                'required',
                'min:10',
            ],
            'traveled' => [
                'required',
                'boolean',
            ],
            'disabled' => [
                'required',
                'boolean',
            ],
            'familiarDisabled' => [
                'required',
                'boolean',
            ],
            'identificationFamiliarDisabled' => [
                'required_if:familiarDisabled,==,true',
                'string',
            ],
            'catastrophicDiseased' => [
                'required',
                'boolean',
            ],
            'familiarCatastrophicDiseased' => [
                'required',
                'boolean',
            ],
            'aboutMe' => [
                'required',
                'min:100',
                'max:300',
            ]
        ];
        return JobBoardFormRequest::rules($rules);
    }


    public function attributes()
    {
        $attributes = [
//            'user.address.main_street' => 'calle principal',
//            'user.address.secondary_street' => 'calle secundaria',
            'user.name' => 'nombres',
            'user.lastname' => 'apellidos',
            'user.identification' => 'número de documento',
            'user.email' => 'correo electrónico',
            'user.identificationType' => 'tipo de documento ',
            'user.sex' => 'sexo ',
            'user.gender' => 'género',
            'user.bloodType' => 'tipo de sangre',
            'user.ethnicOrigin' => 'etnina',
            'user.phone' => 'teléfono',
            'traveled' => 'disponibidad para viajar',
            'disabled' => 'tiene discapacidad',
            'familiarDisabled' => 'tiene discapacidad algún familiar',
            'identificationFamiliarDisabled' => 'identificación de discapacidad del familiar',
            'catastrophicDiseased' => 'tiene una enfermedad catastrófica',
            'familiarCatastrophicDiseased' => 'tiene un  familiar con enfermedad catastrófica ',
            'aboutMe' => 'acerca de mí',
        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
