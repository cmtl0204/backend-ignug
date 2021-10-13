<?php

namespace App\Http\Requests\V1\JobBoard\Category;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'code' => [
            //     'required',
            //     'min:3',
            //     'max:20',
            ],
            'name' => [
                'required',
                'min:3',
                'max:250',
            ],
            'parent.id' => [
                '',
            ],
        ];
        return JobBoardFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'code' => 'código',
            'name' => 'nombre',
            'parent.id' => 'Área de estudios'
        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
