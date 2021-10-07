<?php

namespace App\Http\Requests\V1\LicenseWork\Holidays;

use App\Http\Requests\V1\LicenseWork\LicenseWorkFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHolidayRequest extends FormRequest
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
            'employee_id'=>['required'],
            'code'=>['required'],
            'numberDays'=>['required'],
            'year'=>['required'],
        ];
    }
    public function attributes()
    {
        $attributes = [
            'employee_id'=>'Empleado',
            'code'=>'Código',
            'numberDays'=>'Número de días',
            'year'=>'Año De vacaciones',
        ];
    }
}

