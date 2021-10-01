<?php

namespace App\Http\Requests\V1\LicenseWork\States;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStateRequest extends FormRequest
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
            'id'=>['required'],
            'name'=>['required'],
        ];
    }
    public function attributes()
    {
        $attributes = [
            'id'=>'id del estado',
            'name'=>'nombre del estado',

        ];
        return $attributes;
    }
}
