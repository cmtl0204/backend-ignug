<?php

namespace App\Http\Requests\V1\JobBoard\AcademicFormation;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAcademicFormationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $rules = [

        ];
        return JobBoardFormRequest::rules($rules);
    }



    public function attributes()
    {
        $attributes = [

        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
