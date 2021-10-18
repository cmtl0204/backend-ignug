<?php

namespace App\Http\Requests\V1\LicenseWork\Dependence;

use Illuminate\Foundation\Http\FormRequest;

class AprovedDependenceRequest extends FormRequest
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
        return LicenseWorkFormRequest::rules($rules);
    }


    public function attributes()
    {
        $attributes = [
            'user'=>'usuario',
            'level'=>'nivel',
        ];
        return LicenseWorkFormRequest::attributes($attributes);

    }
}
