<?php

namespace App\Http\Requests\V1\LicenseWork\Reasons;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReasonRequest extends FormRequest
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
            //
            'id'=>['required'],
            'name'=>['required'],
            'descriptionOne'=>['required'],
            'descriptionTwo'=>['required'],
            'discountableHolidays'=>['required'],
            'daysMin'=>['required'],
            'daysMax'=>['required'],

        ];
    }

    public function attributes()
    {
        $attributes = [
            'name'=>'nombre',
            'descriptionOne'=>'descripcion uno',
            'descriptionTwo'=>'descripcion dos',
            'discountableHolidays'=>'vacaciones descontables',
            'daysMin'=>'dias minimos',
            'daysMax'=>'dias maximos',
        ];
    }


}
