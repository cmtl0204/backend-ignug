<?php

namespace App\Http\Requests\V1\LicenseWork\Applications;

use App\Http\Requests\V1\LicenseWork\LicenseWorkFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationRequest extends FormRequest
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
            'employee'=>['required'],
            'reason'=>['required'],
            'location'=>['required'],
            'type.id'=>['required'],
            'dateStartedAt'=>['required'],
            'dateEndedAt'=>['required'],
            'timeStartedAt'=>['required'],
            'timeEndedAt'=>['required'],
            'observations'=>['required'],
        ];
            return LicenseWorkFormRequest::rules($rules);
    }
    public function attributes()
    {
        $attributes = [
            'employee'=>'empleado',
            'reason'=>'razones',
            'location'=>'localización',
            'type.id'=>'tipo',
            'dateStartedAt'=>'Fecha de inicio de la Licencia o Permiso',
            'dateEndedAt'=>'Fecha final de la Licencia o Permiso',
            'timeStartedAt'=>'Hora de inicio de la Licencia o Permiso',
            'timeEndedAt'=>'Hora final de la Licencia o Permiso',
            'observations'=>'Listado de observaciones',
        ];
        return LicenseWorkFormRequest::attributes($attributes);
    }
}
