<?php

namespace App\Http\Requests\V1\JobBoard\Professional;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Cedula;

class RegistrationProfessionalRequest extends FormRequest
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
                'max:20',
            ],
            'user.password' => [
                'required',
                'min:6',
                'max:16',
            ],
            'password_confirmation' => [
                'same:password'
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
            'user.birthdate' => [
                'required',
                'date',
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
                'required_if:familiarDisabled,==,true'
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
            'user.username' => 'número de documento',
            'user.email' => 'correo electrónico',
            'user.identificationType' => 'tipo de documento ',
            'user.identificationType.code' => 'tipo de documento ',
            'user.sex' => 'sexo ',
            'user.gender' => 'género',
            'user.bloodType' => 'tipo de sangre',
            'user.ethnicOrigin' => 'etnina',
            'user.phone' => 'teléfono',
            'user.birthdate' => 'fecha de nacimiento',
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
