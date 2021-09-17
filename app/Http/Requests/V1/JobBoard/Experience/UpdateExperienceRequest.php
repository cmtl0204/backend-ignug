<?php

namespace App\Http\Requests\V1\JobBoard\Experience;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateExperienceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'areaId' => [
                'required',
            ],
            'employer' => [
                'required',
                'min:2',
                'max:250',
            ],
            'position' => [
                'required',
                'min:3',
                'max:250',
            ],
            'startDate' => [
                'required',
                'date',
            ],
            'endDate' => [],
            'activities' => [
                'required',
                'array',
            ],
            'reasonLeave' => [],
            'isWorking' => [
                'boolean',
            ],
            'isDisability' => []
        ];
        return JobBoardFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'areaId' => 'area-ID',
            'employer' => 'nombre de empleadora',
            'position' => 'posicion',
            'startDate' => 'fecha inicio',
            'endDate' => 'fercha fin',
            'activities' => 'ocupaciones',
            'reasonLeave' => 'razon que se fue',
            'isWorking' => 'está trabajando',
            'isDisability' => 'es discapacitado',

        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
