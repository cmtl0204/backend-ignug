<?php

namespace App\Http\Requests\V1\LicenseWork\Forms;

use App\Http\Requests\V1\LicenseWork\LicenseWorkFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFormRequest extends FormRequest
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
        return [
            'employer_id'=>['required'],
            'code'=>['required'],
            'description'=>['required'],
            'regime'=>['required'],
            'daysConst'=>['required'],
            'approvedLevel'=>['required'],
            'state'=>['required'],
        ];
        return LicenseWorkFormRequest::rules($rules);
    }
    public function attributes()
    {
        $attributes = [
            'employer_id'=>['required'],
            'code'=>'Código',
            'description'=>'Descripción',
            'regime'=>'Región',
            'daysConst'=>'Días Constantes',
            'approvedLevel'=>'Nivel Aprobado',
            'state'=>'Estado',
        ];
        return LicenseWorkFormRequest::attributes($attributes);
    }
}
