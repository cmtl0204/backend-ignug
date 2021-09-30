<?php

namespace App\Http\Requests\V1\LicenseWork\Applications;

use Illuminate\Foundation\Http\FormRequest;

class IndexApplicationRequest extends FormRequest
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


        ];
    }
    public function attributes()
    {
        $attributes = [

        ];
        return $attributes;
    }
}
