<?php

namespace App\Http\Requests\V1\LicenseWork\DependenceUser;

use App\Http\Requests\V1\LicenseWork\LicenseWorkFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreDependenceUserRequest extends FormRequest
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
        $rules =  [
            'id'=>['required'],
            'dependence'=>['required'],
            'user'=>['required'],
        ];

        return LicenseWorkFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'dependence'=>['fk'],
            'user'=>['fk'],
        ];
        
        return LicenseWorkFormRequest::attributes($attributes);

    }
}
