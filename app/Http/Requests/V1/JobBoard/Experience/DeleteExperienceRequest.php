<?php

namespace App\Http\Requests\V1\JobBoard\Experience;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteExperienceRequest extends FormRequest
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
