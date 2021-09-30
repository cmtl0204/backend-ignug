<?php

namespace App\Http\Requests\V1\LicenseWork\States;

use Illuminate\Foundation\Http\FormRequest;

class StoreStateRequest extends FormRequest
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
