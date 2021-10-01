<?php

namespace App\Http\Requests\V1\LicenseWork\Applications;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'=>['required'],
            'employee'=>['required'],
            'reason'=>['required'],
            'location'=>['required'],
            'type'=>['required'],
            'dateStartedAt'=>['required'],
            'dateEndedAt'=>['required'],
            'timeStartedAt'=>['required'],
            'timeEndedAt'=>['required'],
            'observations'=>['required'],
        ];
    }
    public function attributes()
    {
        $attributes = [
            'id'=>'id de la solicitud',
            'employee'=>'empleado',
            'reason'=>'razones',
            'location'=>'localización',
            'type'=>'catalogues',
            'dateStartedAt'=>'Fecha de inicio de la Licencia o Permiso',
            'dateEndedAt'=>'Fecha final de la Licencia o Permiso',
            'timeStartedAt'=>'Hora de inicio de la Licencia o Permiso',
            'timeEndedAt'=>'Hora final de la Licencia o Permiso',
            'observations'=>'Listado de observaciones',
        ];
        return $attributes;
    }
}
