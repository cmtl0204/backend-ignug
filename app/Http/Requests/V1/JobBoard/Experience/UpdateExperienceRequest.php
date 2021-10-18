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
                'required_if:worked,==,true',
                'nullable',
                'date',
                'after_or_equal:startedAt',
            ],
            'activities' => [
                'required',
                'array',
            ],
            'reasonLeave' => [
                'required_if:worked,==,true'
            ],
            'worked' => [
                'boolean',
            ],

        ];
        return JobBoardFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'area.id' => 'area de estudios',
            'employer' => 'nombre de empleador o empresa',
            'position' => 'cargo',
            'startedAt' => 'fecha de inicio',
            'endedAt' => 'fecha de fin',
            'activities' => 'actividades realizadas',
            'reasonLeave' => 'razon de salida',
            'worked' => 'ya no trabaja',
        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
