<?php

namespace App\Http\Requests\V1\JobBoard\Experience;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreExperienceRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'area.id' => ['required'],
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
            'startAt' => [
                'required',
                'date',
            ],
            'endAt' => [],
            'activities' => [
                'required',
                'array',
            ],
            'reasonLeave' => ['required',],
            'worked' => [
                'required',
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
            'startAt' => 'fecha inicio',
            'endAt' => 'fercha fin',
            'activities' => 'ocupaciones',
            'reasonLeave' => 'razon por la que se fue del trabajo',
            'worked' => 'está trabajando',

        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
