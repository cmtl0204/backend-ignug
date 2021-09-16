<?php

namespace App\Http\Requests\V1\JobBoard\Experience;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;

class IndexExperienceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'experience_id' => [
                'integer',
            ],
        ];
        return JobBoardFormRequest::rules($rules);
    }
    public function attributes()
    {
        $attributes = [
            'experience_id' => 'experiencia-id',
        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
