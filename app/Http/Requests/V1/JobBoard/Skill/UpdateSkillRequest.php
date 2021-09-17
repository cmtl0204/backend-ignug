<?php

namespace App\Http\Requests\V1\JobBoard\Skill;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSkillRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
           'description' => [
                'required',
                'min:10',
                'max:1000',
            ],
            'typeId' => [
                'required',
                'integer',
            ]
        ];
        return JobBoardFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'description' => 'descripción',
            'typeId' => 'tipo-id',
        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
