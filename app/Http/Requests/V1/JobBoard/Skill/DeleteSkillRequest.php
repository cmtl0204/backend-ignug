<?php

namespace App\Http\Requests\V1\JobBoard\Skill;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class DeleteSkillRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'ids' => [
                'required',
            ],
        ];
        return JobBoardFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'ids' => 'IDs',
        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
