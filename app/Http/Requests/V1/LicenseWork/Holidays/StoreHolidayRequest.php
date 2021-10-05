<?php

namespace App\Http\Requests\V1\LicenseWork\Holidays;

use Illuminate\Foundation\Http\FormRequest;

class StoreHolidayRequest extends FormRequest
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
            'employee'=>['required'],
            'code'=>['required'],
            'numberDays'=>['required'],
            'year'=>['required'],
        ];
    }
    public function attributes()
    {
        $attributes = [
            'employee'=>'Empleado',
            'code'=>'Código',
            'numberDays'=>'Número de días',
            'year'=>'Año De vacaciones',
        ];
    }
}
