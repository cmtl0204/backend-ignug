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
            'area.id' => [
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
            'startedAt' => [
                'required',
                'date',
            ],
            'endedAt' => [
                'date',
                'nullable',
                'required_if:worked,==,true',
            ],
            'activities' => [
                'required',
                'array',
            ],
            'reasonLeave' => [],
            'worked' => [
                'boolean',
            ],
           
        ];
        return JobBoardFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'area.id' => 'area-ID',
            'employer' => 'nombre de empleadora',
            'position' => 'posicion',
            'startedAt' => 'fecha inicio',
            'endedAt' => 'fecha fin',
            'activities' => 'ocupaciones',
            'reasonLeave' => 'razon que se fue',
            'worked' => 'está trabajando',
           

        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
